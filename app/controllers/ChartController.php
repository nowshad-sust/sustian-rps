<?php

class ChartController extends \BaseController {

    public function showcoursegrade(){

        try{
            $user_id = Auth::user()->userInfo->user_id;
            $results = Result::where('user_id',$user_id)->get();
            $taken_courses_id = $results->lists('course_id');
            $taken_courses = Course::whereIn('id',$taken_courses_id)->get();
            $taken_courses = $taken_courses->sortBy('course_semester');
            $taken_courses_sorted_id = $taken_courses->lists('id');
            $taken_courses_sorted_number = $taken_courses->lists('course_number');

            //sort results as the $taken_courses__sorted_id
            $resultsArray = array();
            foreach($taken_courses_sorted_id as $taken_courses_sorted_id){
                $resultsArray[] = (float) Result::where('user_id', $user_id)
                                                    ->where('course_id',$taken_courses_sorted_id)
                                                    ->pluck('grade_point');
            }

            $list = $this->getCourseList();
            if(count($resultsArray)<=0){
                return View::make('chart.course-grade')->with(['title'=>'Chart',
                    'courseList'=>null,
                    'grades'=>null,
                    'lists'=>$list
                ])->with('error','not enough data to generate graph');
            }
            return View::make('chart.course-grade')->with(['title'=>'Chart',
                'courseList'=>$taken_courses_sorted_number,
                'grades'=>$resultsArray,
                'lists'=>$list
            ]);
        }catch (Exception $ex){
            return Redirect::back()->with(['error'=>'could not find data to calculate']);
        }

       }

    public function showcoursecgpa(){
        ///plot course vs CGPA graph
        try{
            $user_id = Auth::user()->id;
            $results = Result::where('user_id',$user_id)
                                ->where('grade_point','!=',0)
                                ->get();
            $taken_courses_id = $results->lists('course_id');
            $taken_courses = Course::whereIn('id',$taken_courses_id)
                                    ->orderBy('course_semester','asc')
                                    ->orderBy('course_number','asc')
                                    ->get();
            $taken_courses_sorted_id = $taken_courses->lists('id');
            $taken_courses_sorted_number = $taken_courses->lists('course_number');

            $gradesArray = array();
            $resultsArray = array();
            $corresponding_courses = array();

            $i=0;
            //sort results as the $taken_courses__sorted_id
            foreach($taken_courses_sorted_id as $taken_course_sorted_id){
                $temp = Result::where('user_id', $user_id)
                    ->where('course_id',$taken_course_sorted_id)
                    ->where('grade_point','!=',0.00)
                    ->with('Course')
                    ->first();
                if( $temp != null) {
                    $corresponding_courses[] = Course::where('id',$taken_course_sorted_id)->pluck('course_number');
                    $resultsArray[] = $temp;
                    $gradesArray[]  = (float) $temp->grade_point;
                }
                ++$i;
            }

            $progressiveCGPA = $this->getProgressiveCGPA($resultsArray);

            $list = $this->getCourseList();

            if(count($resultsArray)<=0){
                return View::make('chart.course-cgpa')->with(['title'=>'Chart',
                    'courseList'=>null,
                    'cgpa'=>null,
                    'grades'=>null,
                    'lists'=>$list
                ]);
            }

            return View::make('chart.course-cgpa')->with(['title'=>'Chart',
                'courseList'=>$corresponding_courses,
                'cgpa'=>$progressiveCGPA,
                'grades'=>$gradesArray,
                'lists'=>$list
            ]);
        }catch(Exception $ex){
            return Log::error($ex);
            return Redirect::back()->with(['error'=>'Error generating CGPA graph']);
        }
    }

    private function getProgressiveCGPA($results){
        try{
            $total_credits = 0;
            $TGP = 0;
            $progressiveCGPA = array();
            $resultArray = array();

            foreach($results as $result){
                $resultArray[] = $result;
                $total_credits += $result->course->course_credit;
                $TGP += $result->grade_point*$result->course->course_credit;
                $progressiveCGPA[] = (float) $TGP/$total_credits;
            }
            return $progressiveCGPA;

        }catch (Exception $ex){
            return Redirect::back()->with('error','Error generating subject vs CGPA graph function');
        }
    }

    public function showclasscgpa(){

        try{
            $classmates_id = UserInfo::where('batch_id',Auth::user()->userInfo->batch_id)
                ->where('dept_id',Auth::user()->userInfo->dept_id)
                ->lists('user_id');

            //calculate cgpa of each user
            $classmates_cgpa = array();

            foreach($classmates_id as $classmate_id){
                $classmates_cgpa[] = $this->calculateUserCGPA($classmate_id);
            }

            $finalData =  $this->cgpaToPie($classmates_cgpa, $classmate_id);
            $list = $this->getCourseList();
            if((is_null($classmates_cgpa[0])&&count($classmates_cgpa)<=1) || $finalData == null){
                return View::make('chart.class-cgpa')->with(['title'=>'Class-CGPA',
                    'data'  =>  null,
                    'categories'=>null,
                    'user_number'=>null,
                    'lists'=>$list
                ]);
            }

            $chartData = $this->pieChartFormat($finalData);


            return View::make('chart.class-cgpa')->with(['title'=>'Class-CGPA',
                                                        'data'  =>  $chartData,
                                                        'categories'=>$finalData[0],
                                                        'user_number'=>$finalData[1],
                                                        'lists'=>$list]);
        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'Error generating subject vs CGPA graph']);
        }
    }


    public function showsemestercgpa(){
        //get semesterwise GPA list
        //with total cgpa list
        try{
            $user_id = Auth::user()->id;
            $taken_courses_id = Result::where('user_id',$user_id)
                ->where('grade_point','!=',0.00)
                ->lists('course_id');

            $results = Result::where('user_id',$user_id)
                ->where('grade_point','!=',0.00)
                ->whereIn('course_id',$taken_courses_id)
                ->with('Course')
                ->get();

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

            $list = $this->getCourseList();

            return View::make('chart.semester-cgpa')->with(['title'=>'Semester-CGPA',
                'semesters'=>$available_semesters,
                'semestersGPA'=>$semestersGPA,
                'cgpa'=>$semestersCGPA,
                'lists'=>$list]);

        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'could not count CGPA']);
        }

    }

    private function grade_point_to_letter($gradePoint){
        switch ($gradePoint) {
            case 0.00:
                return 'F';
                break;
            case 2.00:
                return 'C-';
                break;
            case 2.25:
                return 'C';
                break;
            case 2.50:
                return 'C+';
                break;
            case 2.75:
                return 'B-';
                break;
            case 3.00:
                return 'B';
                break;
            case 3.25:
                return 'B+';
                break;
            case 3.50:
                return 'A-';
                break;
            case 3.75:
                return 'A';
                break;
            case 4.00:
                return 'A+';
                break;
        };
    }

    private function getCGPATillSemester($semester){
        try{
            $user_id = Auth::user()->id;
            $user_dept_id   = Auth::user()->userInfo->dept_id;
            $user_batch_id  = Auth::user()->userInfo->batch_id;
            //GPA: (course_credit X obtained_grade_point)/total_credits
            //total course_credit = add all course_credit from each result
            $semester_courses = Course::where('dept_id', $user_dept_id)
                ->where('batch_id', $user_batch_id)
                ->where('course_semester', '<=' ,$semester)
                ->lists('id');

            $results = Result::where('user_id',$user_id)
                ->where('grade_point','!=',0.00)
                ->whereIn('course_id',$semester_courses)
                ->with('Course')->get();

            $semester_course_list = array();

            foreach($results as $result){
                $semester_course_list[] = $result->course_id;
            }

            if($semester_courses==null||$results==null){
                return 'course or semester data not found';
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

    private function getCourseList(){
        $userInfo = Auth::user()->userInfo;

        $courseInfo = Course::where(['dept_id'=>$userInfo->dept_id, 'batch_id'=>$userInfo->batch_id])->get();
        $courseList = $courseInfo->sortBy('course_semester')->lists('course_number','id');

        return $courseList;

    }
    public function coursewisestat($course_id = null){

        try{
            $list = $this->getCourseList();
            if($course_id==null)
                return 'null given';
            else{
                try{
                    $userInfo = Auth::user()->userinfo;
                    $courseInfo = Course::where('dept_id', Auth::user()->userInfo->dept->id)
                                        ->where('batch_id',Auth::user()->userInfo->batch->id)
                                        ->find($course_id);
                    //for unauthorised access
                    //check user has access to that course info
                    if($courseInfo){
                        if($courseInfo->batch->batch == $userInfo->batch->batch
                        && $courseInfo->dept->dept == $userInfo->dept->dept){

                            $CourseName = $courseInfo->course_title;
                            //get all results of that course by id
                            $results = Result::where('course_id',$course_id)
                                                ->lists('grade_point');

                            $counts = array_count_values($results);
                            $data =  $this->pieChartFormatOfCourseWiseData($counts,$results);
                        }else{
                            throw new Exception;
                        }

                    }else{
                        throw new Exception;
                    }
                }catch (Exception $exc){

                    return View::make('chart.coursewise-stat')->with([
                        'title' =>  'Coursewise Statistics',
                        'course_title'  =>  null,
                        'data'  =>  null,
                        'lists'=>$list
                    ]);
                }


                return View::make('chart.coursewise-stat')->with([
                    'title' =>  'Coursewise Statistics',
                    'course_title'  =>  $CourseName,
                    'data'  =>  $data,
                    'lists'    =>  $list,
                ]);

            }
        }catch (Exception $ex){

        }
    }

    private function pieChartFormatOfCourseWiseData($counts,$results){
        $data = array();
        $colours = [
            "#bf616a",
            "#5B90BF",
            "#d08770",
            "#ebcb8b",
            "#a3be8c",
            "#96b5b4",
            "#8fa1b3",
            "#b48ead",
            "#ab7967"
        ];
        $i=0;
        foreach($counts as $key => $value){

            $data[] = [
                'value'=> $value,
                'color'=> $colours[$i],
                'highlight'=> $colours[$i],
                //convert the grade_point to grade_letter
                'label'=> $this->grade_point_to_letter((float) $key)
                ];
            ++$i;
        }
        return $data;
    }

    private function pieChartFormat($finalData){
        $categories = $finalData[0];
        $user_numbers = $finalData[1];
        $colours = [
        "#bf616a",
		    "#5B90BF",
		    "#d08770",
		    "#ebcb8b",
		    "#a3be8c",
		    "#96b5b4",
		    "#8fa1b3",
		    "#b48ead",
		    "#ab7967"
        ];

        $data = array();
        $i=0;
        foreach($categories as $category){
            $data[] = [
                'value'=> $user_numbers[$i],
                'color'=>$colours[$i],
                //'highlight'=> "#ab7967",
                'label'=> $category
            ];
            ++$i;
        }
        return $data;

    }

    private function Colour($col, $amt) {

        $usePound = false;

        if($col[0] == "#") {
            return $col = substr($col,1);
            $usePound = true;
        }

		$num = intval($col,16);

		$r = ($num >> 16) + $amt;

		if ($r > 255) $r = 255;
        else if  ($r < 0) $r = 0;

		$b = (($num >> 8) & 0x00FF) + $amt;

		if ($b > 255) $b = 255;
        else if  ($b < 0) $b = 0;

		$g = ($num & 0x0000FF) + $amt;

		if ($g > 255) $g = 255;
        else if ($g < 0) $g = 0;

		return (string)($usePound?"#":"") + ($g | ($b << 8) | ($r << 16));

	}

    private function cgpaToPie($classmates_cgpa, $classmates_id){
        //now divide the cgpa into 6 categories
        $user_number_in_categories = array();
        $user_categories = [
                '2.00-2.5',
                '2.5-3.0',
                '3.00-3.25',
                '3.25-3.5',
                '3.5-3.75',
                '3.75-4.00'
            ];

        for($i=0;$i<6;++$i){
            $user_number_in_categories[] = 0;
        }

        foreach($classmates_cgpa as $cgpa){
            if($cgpa<2.0){

            }elseif($cgpa<2.5){
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


    private function calculateSemesterGPA($semester){
        try{
            $user_id = Auth::user()->id;
            $user_dept_id   = Auth::user()->userInfo->dept_id;
            $user_batch_id  = Auth::user()->userInfo->batch_id;
            //GPA: (course_credit X obtained_grade_point)/total_credits
            //total course_credit = add all course_credit from each result
            $semester_courses = Course::where('dept_id', $user_dept_id)
                ->where('batch_id', $user_batch_id)
                ->where('course_semester',$semester)
                ->lists('id');

            $results = Result::where('user_id',$user_id)
                ->where('grade_point','!=',0.00)
                ->whereIn('course_id',$semester_courses)
                ->with('Course')->get();

            $semester_course_list = array();

            foreach($results as $result){
                $semester_course_list[] = $result->course_id;
            }

            if($semester_courses==null||$results==null){
                return 'course or semester data not found';
            }

            try{
                $total_credits = 0;
                $TGP = 0;
                foreach($results as $result){
                    $total_credits += $result->course->course_credit;
                    $TGP += $result->grade_point*$result->course->course_credit;
                }
                $gpa = $TGP/$total_credits;

                return $gpa;

            }catch (Exception $ex){
                return null;
            }
        }catch (Exception $ex){
            return null;
        }
    }

    private function calculateUserCGPA($classmate_id)
    {
        try{
            $user_id = $classmate_id;
            $taken_courses_id = Result::where('user_id',$user_id)
                ->where('grade_point','!=',0.00)
                ->lists('course_id');
            $results = Result::where('user_id',$user_id)
                ->whereIn('course_id',$taken_courses_id)
                ->where('grade_point','!=',0.00)
                ->with('Course')
                ->get();

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
