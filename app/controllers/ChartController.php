<?php

class ChartController extends \BaseController {

    public function showcoursegrade(){

        try{
            $user_id = Auth::user()->id;
            $results = Result::where('user_id',$user_id)->get();
            $taken_courses_id = $results->lists('course_id');
            $taken_courses = Course::whereIn('id',$taken_courses_id)->get();
            $taken_courses = $taken_courses->sortBy('course_semester');
            $taken_courses_sorted_id = $taken_courses->lists('id');
            $taken_courses_sorted_number = $taken_courses->lists('course_number');

            //sort results as the $taken_courses__sorted_id
            $resultsArray = array();
            foreach($taken_courses_sorted_id as $taken_courses_sorted_id){
                $resultsArray[] = (float) Result::where('course_id',$taken_courses_sorted_id)->pluck('grade_point');
            }

            if(count($resultsArray)<=0){
                return View::make('chart.course-grade')->with(['title'=>'Chart',
                    'courseList'=>null,
                    'grades'=>null
                ])->with('error','not enough data to generate graph');
            }
            return View::make('chart.course-grade')->with(['title'=>'Chart',
                'courseList'=>$taken_courses_sorted_number,
                'grades'=>$resultsArray
            ]);
        }catch (Exception $ex){
            return Redirect::back()->with(['error'=>'could not find data to calculate']);
        }

       }

    public function showcoursecgpa(){
        //plot course vs CGPA graph
        try{
            $user_id = Auth::user()->id;
            $results = Result::where('user_id',$user_id)->get();
            $taken_courses_id = $results->lists('course_id');
            $taken_courses = Course::whereIn('id',$taken_courses_id)->get();
            $taken_courses = $taken_courses->sortBy('course_semester');
            $taken_courses_sorted_id = $taken_courses->lists('id');
            $taken_courses_sorted_number = $taken_courses->lists('course_number');

            $gradesArray = array();
            $resultsArray = array();
            $i=0;
            //sort results as the $taken_courses__sorted_id
            foreach($taken_courses_sorted_id as $taken_courses_sorted_id){
                $resultsArray[] = Result::where('course_id',$taken_courses_sorted_id)->with('Course')->first();
                $gradesArray[]  = (float) $resultsArray[$i]->grade_point;
                ++$i;
            }

            if(count($resultsArray)<=0){
                return View::make('chart.course-cgpa')->with(['title'=>'Chart',
                    'courseList'=>null,
                    'cgpa'=>null,
                    'grades'=>null
                ]);
            }

            $progressiveCGPA = $this->getProgressiveCGPA($resultsArray);


            return View::make('chart.course-cgpa')->with(['title'=>'Chart',
                'courseList'=>$taken_courses_sorted_number,
                'cgpa'=>$progressiveCGPA,
                'grades'=>$gradesArray
            ]);
        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'Error generating subject vs CGPA graph']);
        }
    }

    public function showclasscgpa(){

        try{
                $classmates_id = UserInfo::where('batch_id',Auth::user()->userInfo->batch_id)
                ->where('dept_id',Auth::user()->userInfo->dept_id)->lists('user_id');

            //calculate cgpa of each user
            $classmates_cgpa = array();
            foreach($classmates_id as $classmate_id){
                $classmates_cgpa[] = $this->calculateUserCGPA($classmate_id);
            }
            $finalData =  $this->cgpaToPie($classmates_cgpa, $classmate_id);

            if((is_null($classmates_cgpa[0])&&count($classmates_cgpa)<=1) || $finalData == null){
                return View::make('chart.class-cgpa')->with(['title'=>'Class-CGPA',
                    'data'  =>  null,
                    'categories'=>null,
                    'user_number'=>null]);
            }

            $chartData = $this->pieChartFormat($finalData);
            return View::make('chart.class-cgpa')->with(['title'=>'Class-CGPA',
                                                        'data'  =>  $chartData,
                                                        'categories'=>$finalData[0],
                                                        'user_number'=>$finalData[1]]);
        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'Error generating subject vs CGPA graph']);
        }
    }


    public function showsemestercgpa(){
        //get semesterwise GPA list
        //with total cgpa list
        try{
            $user_id = Auth::user()->id;
            $taken_courses_id = Result::where('user_id',$user_id)->lists('course_id');
            $results = Result::where('user_id',$user_id)->whereIn('course_id',$taken_courses_id)->with('Course')->get();
            $CGPA = $this->calculateTotalCGPA($results);

            /*if($CGPA==null){
                return Redirect::back()->with(['warning'=>'not enough data to count your CGPA']);
            }*/
            //enlist all avaiable semester GPA
            //available semesters
            $available_semesters = array();
            $semestersGPA = array();
            $semestersCGPA = array();
            foreach($results as $result){
                if(!in_array($result->course->course_semester, $available_semesters)){
                    $available_semesters[]= $result->course->course_semester;
                    $semestersGPA[] = $this->calculateSemesterGPA($result->course->course_semester);
                    $semestersCGPA[] = $this->getCGPATillSemester($result->course->course_semester);
                }

            }

            /*if($semestersCGPA==null){
                return Redirect::back()->with(['error'=>'could not calculate your data']);
            }*/

            return View::make('chart.semester-cgpa')->with(['title'=>'Semester-CGPA',
                'semesters'=>$available_semesters,
                'semestersGPA'=>$semestersGPA,
                'cgpa'=>$semestersCGPA]);

        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'could not count CGPA']);
        }

    }

    public function coursewisestat($course_id = null){
        try{
            if($course_id==null)
                return 'null given';
            else{
                $CourseName = Course::find($course_id)->pluck('course_title');
                $results = Result::where('course_id',$course_id)->lists('grade_point');
                $counts = array_count_values($results);

                $data =  $this->pieChartFormatOfCourseWiseData($counts,$results);

                return View::make('chart.coursewise-stat')->with([
                    'title' =>  'Coursewise Statistics',
                    'course_title'  =>  $CourseName,
                    'data'  =>  $data
                ]);

            }
        }catch (Exception $ex){

        }
    }

    private function getCGPATillSemester($semester){
        try{
            $user_id = Auth::user()->id;
            //GPA: (course_credit X obtained_grade_point)/total_credits
            //total course_credit = add all course_credit from each result
            $semester_courses = Course::where('course_semester','<=',$semester)->lists('id');
            $results = Result::where('user_id',$user_id)->whereIn('course_id',$semester_courses)->with('Course')->get();
            if($semester_courses==null||$results==null){
                return null;
            }
            try{
                $total_credits = 0;
                $TGP = 0;
                foreach($results as $result){
                    $total_credits += $result->course->course_credit;
                    $TGP += $result->grade_point*$result->course->course_credit;
                }
                $cgpa = $TGP/$total_credits;

                return $cgpa;

            }catch (Exception $ex){
                return null;
            }
        }catch (Exception $ex){
            return null;
        }
    }

    private function pieChartFormatOfCourseWiseData($counts,$results){
        $data = array();
        $i=0;
        foreach($counts as $count){
            $data[] = [
                'value'=> $count,
                'color'=>"#F7464A",
                'highlight'=> "#FF5A5E",
                'label'=> (float) $results[$i]
            ];
            ++$i;
        }
        return $data;

    }

    private function pieChartFormat($finalData){
        $categories = $finalData[0];
        $user_numbers = $finalData[1];
        $data = [
            [
                'value'=> $user_numbers[0],
                'color'=>"#F7464A",
                'highlight'=> "#FF5A5E",
                'label'=> $categories[0]
            ],
            [
                'value'=> $user_numbers[1],
                'color'=> "#46BFBD",
                'highlight'=> "#5AD3D1",
                'label'=> $categories[1]
            ],
            [
                'value'=> $user_numbers[2],
                'color'=> "#FDB45C",
                'highlight'=> "#FFC870",
                'label'=> $categories[2]
            ],
            [
                'value'=> $user_numbers[3],
                'color'=>"#3cb475",
                'highlight'=> "#3cb475",
                'label'=> $categories[3]
            ],
            [
                'value'=> $user_numbers[4],
                'color'=> "#7b4e8c",
                'highlight'=> "#7b4e8c",
                'label'=> $categories[4]
            ],
            [
                'value'=> $user_numbers[5],
                'color'=> "#742f81",
                'highlight'=> "#742f81",
                'label'=> $categories[5]
            ]
        ];
        return $data;

    }

    private function cgpaToPie($classmates_cgpa, $classmates_id){
        //now divide the cgpa into 6 categories
        $user_number_in_categories = array();
        $user_categories = array('<2.5','<3.0','<3.25','<3.5','<3.75','>=3.75');
        for($i=0;$i<6;++$i){
            $user_number_in_categories[] = 0;
        }

        foreach($classmates_cgpa as $cgpa){
            if($cgpa<2.5){
                ++$user_number_in_categories[0];

            }elseif($cgpa<3.00){
                ++$user_number_in_categories[1];

            }elseif($cgpa<3.25){
                ++$user_number_in_categories[2];

            }elseif($cgpa<3.50){
                ++$user_number_in_categories[3];

            }elseif($cgpa<3.75){
                ++$user_number_in_categories[4];

            }elseif($cgpa>=3.75){
                ++$user_number_in_categories[5];

            }
        }
        $finalArray[] = $user_categories;
        $finalArray[] = $user_number_in_categories;

        return $finalArray;
    }

    private function getProgressiveCGPA($results){
        try{
            $total_credits = 0;
            $TGP = 0;
            $progressiveCGPA = array();
            foreach($results as $result){
                $total_credits += $result->course->course_credit;
                $TGP += $result->grade_point*$result->course->course_credit;
                $progressiveCGPA[] = $TGP/$total_credits;
            }
            return $progressiveCGPA;

        }catch (Exception $ex){
            return Redirect::back()->with('error','Error generating subject vs CGPA graph');
        }
    }

    private function calculateSemesterGPA($semester){
        try{
            $user_id = Auth::user()->id;
            //GPA: (course_credit X obtained_grade_point)/total_credits
            //total course_credit = add all course_credit from each result
            $semester_courses = Course::where('course_semester', $semester)->lists('id');
            $results = Result::where('user_id',$user_id)->whereIn('course_id',$semester_courses)->with('Course')->get();
            if($semester_courses==null||$results==null){
                return 0;
            }

            $total_credits = 0;
            $TGP = 0;
            foreach($results as $result){
                $total_credits += $result->course->course_credit;
                $TGP += $result->grade_point*$result->course->course_credit;
            }
            $gpa = $TGP/$total_credits;
            return $gpa;
        }catch (Exception $ex){

        }
    }

    private function calculateUserCGPA($classmate_id)
    {
        try{
            $user_id = $classmate_id;
            $taken_courses_id = Result::where('user_id',$user_id)->lists('course_id');
            $results = Result::where('user_id',$user_id)->whereIn('course_id',$taken_courses_id)->with('Course')->get();

            return $CGPA = $this->calculateTotalCGPA($results);

        }catch (Exception $ex){
            return Redirect::back()->with(['error'=>'error calculating cgpa']);
        }
    }

    private function calculateTotalCGPA($results){
        try{
            $total_credits = 0;
            $TGP = 0;
            foreach($results as $result){
                $total_credits += $result->course->course_credit;
                $TGP += $result->grade_point*$result->course->course_credit;
            }
            $cgpa = $TGP/$total_credits;
            return $cgpa;

        }catch (Exception $ex){

        }
    }
}