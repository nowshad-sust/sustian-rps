<?php

class DashboardController extends \BaseController{


    public static function adminDashboard(){
        //get admin view info
        //total activated user number
        $totalUserNumber = UserInfo::where('activation',true)->count();

        //total results added
        $totalResultNumber = Result::count();

        return View::make('admindashboard')
            ->with([
                'title'             =>      'Dashboard',
                'totalUserNumber'   =>      $totalUserNumber,
                'totalResultNumber' =>      $totalResultNumber
            ]);
    }

    public static function userDashboard(){

        $obj = new DashboardController();
        
        //cgpa chart
        $chartData = $obj->showcoursecgpa();
        
        //current cgpa
        $current_cgpa = round($obj->calculateCGPA(),2);

        //total drop credits
        $drop_credits  = $obj->getDropCredits();

        //credits left
        $left_credits = $obj->getLeftCredits();
        
        //passed credits
        $passed_credits = $obj->getPassedCredits();

        return View::make('userdashboard')
            ->with([
                'title'             =>      'Dashboard',
                'current_cgpa'      =>      $current_cgpa,
                'passed_credits'    =>      $passed_credits,
                'left_credits'      =>      $left_credits,
                'drop_credits'      =>      $drop_credits,
                'chartData'         =>      $chartData
            ]);
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
            $corresponding_courses = array();

            $i=0;
            //sort results as the $taken_courses__sorted_id
            foreach($taken_courses_sorted_id as $taken_course_sorted_id){
                $temp = Result::where('course_id',$taken_course_sorted_id)
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

                return $chartData = [
                    'courseList'=>null,
                    'cgpa'=>null,
                    'grades'=>null,
                    'lists'=>$list
                ];
            }

            return $chartData = [
                    'courseList'=>$corresponding_courses,
                    'cgpa'=>$progressiveCGPA,
                    'grades'=>$gradesArray,
                    'lists'=>$list
                ];

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

       private function getCourseList(){
        $userInfo = Auth::user()->userInfo;

        $courseInfo = Course::where(['dept_id'=>$userInfo->dept_id, 'batch_id'=>$userInfo->batch_id])->get();
        $courseList = $courseInfo->sortBy('course_semester')->lists('course_number','id');

        return $courseList;

    }

    public function getDropCredits(){
        try{
                $user_id = Auth::user()->id;
                $taken_courses_id = Result::where('user_id',$user_id)->lists('course_id');
                $drop_courses = Result::where('user_id',$user_id)
                    ->where('grade_point',0.00)
                    ->whereIn('course_id',$taken_courses_id)
                    ->with('Course')
                    ->get(['course_id']);
                
                $drop_credits = 0;

                foreach ($drop_courses as $course) {
                    $drop_credits += (float) $course->course->course_credit;
                }

                return $drop_credits;
            
            }catch(Exception $ex){
                return Redirect::back()->with(['error'=>'could not count CGPA']);
            }
    }

    public function getLeftCredits(){
        try{
                $user = Auth::user();
                $offered_courses = Course::where('dept_id',$user->userInfo->dept_id)
                                            ->where('batch_id',$user->userInfo->batch_id)
                                            ->lists('course_credit');
                $offered_credits = 0;

                foreach ($offered_courses as $course) {
                    $offered_credits += (float) $course;
                }

                $passed_credits = $this->getPassedCredits();

                $credits_left = $offered_credits - $passed_credits;

                return $credits_left;
            
            }catch(Exception $ex){
                return Redirect::back()->with(['error'=>'could not count CGPA']);
            }
    }

    public function getPassedCredits(){
        try{
                $user_id = Auth::user()->id;
                $taken_courses_id = Result::where('user_id',$user_id)->lists('course_id');
                $passed_courses = Result::where('user_id',$user_id)
                    ->where('grade_point','!=',0.00)
                    ->whereIn('course_id',$taken_courses_id)
                    ->with('Course')
                    ->get(['course_id']);
                
                $passed_credits = 0;

                foreach ($passed_courses as $course) {
                    $passed_credits += (float) $course->course->course_credit;
                }

                return $passed_credits;
            
            }catch(Exception $ex){
                return Redirect::back()->with(['error'=>'could not count CGPA']);
            }
    }

    public function calculateCGPA(){
            try{
                $user_id = Auth::user()->id;
                $taken_courses_id = Result::where('user_id',$user_id)->lists('course_id');
                $results = Result::where('user_id',$user_id)
                    ->where('grade_point','!=',0.00)
                    ->whereIn('course_id',$taken_courses_id)
                    ->with('Course')
                    ->get();
                $CGPA = $this->calculateTotalCGPA($results);

                if($CGPA==0){
                    return 'not enough data to count your CGPA';
                }else
                    return $CGPA;

            }catch(Exception $ex){
                return Redirect::back()->with(['error'=>'could not count CGPA']);
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
?>