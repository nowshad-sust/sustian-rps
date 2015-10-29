<?php

class ChartController extends \BaseController {
    public function showcoursegrade(){

        //sort all results by their semester
        //plot course vs grade graph
        $user_id = Auth::user()->id;
        $results = Result::where('user_id',$user_id)->get();
        $results = $results->sortBy('id');
        $resultsArray = array();
        $courseArray  = array();
        $countArray = array();
        foreach($results as $result){
            $resultsArray[] = (float) $result->grade_point;
            $courseArray[] = $result->course_id;
        }

        $courseInfo = Course::whereIn('id',$courseArray)->get();
        $courseList = $courseInfo->sortBy('course_semester')->lists('course_number');

        return View::make('chart.course-grade')->with(['title'=>'Chart',
                                                'courseList'=>$courseList,
                                                'grades'=>$resultsArray
                                                ]);
    }

    public function showcoursecgpa(){
        //plot course vs CGPA graph
        try{
            $user_id = Auth::user()->id;
            $results = Result::where('user_id',$user_id)->get();
            $results = $results->sortBy('id');
            $courseArray  = array();
            foreach($results as $result){
                $resultsArray[] = (float) $result->grade_point;
                $courseArray[] = $result->course_id;
            }
            $taken_courses = Course::whereIn('id',$courseArray)->get();
            $taken_courses = $taken_courses->sortBy('course_semester');
            $taken_courses_id = $taken_courses->lists('id');
            $taken_courses_number = $taken_courses->lists('course_number');
            $results = Result::where('user_id',$user_id)->whereIn('course_id',$taken_courses_id)->with('Course')->get();
            $progressiveCGPA = $this->getProgressiveCGPA($results);

            return View::make('chart.course-cgpa')->with(['title'=>'Chart',
                'courseList'=>$taken_courses_number,
                'cgpa'=>$progressiveCGPA
            ]);
        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'Error generating subject vs CGPA graph']);
        }
    }

    public function calculateGPA(){
        return $this->calculateSemesterGPA(1);
    }

    private function getProgressiveCGPA($results){
        try{
            $total_credits = 0;
            $TGP = 0;
            $course_id_list = array();
            $progressiveCGPA = array();
            foreach($results as $result){
                $total_credits += $result->course->course_credit;
                $TGP += $result->grade_point*$result->course->course_credit;

                $course_id_list[] = $result->course->id;
                $progressiveCGPA[] = $TGP/$total_credits;
            }
            return $progressiveCGPA;

        }catch (Exception $ex){
            return Redirect::back()->with('error','Error generating subject vs CGPA graph');
        }
    }

    private function calculateSemesterGPA($semester){
        $user_id = Auth::user()->id;
        //GPA: (course_credit X obtained_grade_point)/total_credits
        //total course_credit = add all course_credit from each result
        $semester_courses = Course::where('course_semester', $semester)->lists('id');
        $results = Result::where('user_id',$user_id)->whereIn('course_id',$semester_courses)->with('Course')->get();

        $total_credits = 0;
        $TGP = 0;
        foreach($results as $result){
            $total_credits += $result->course->course_credit;
            $TGP += $result->grade_point*$result->course->course_credit;
        }
        $gpa = $TGP/$total_credits;
        return $gpa;

    }
}