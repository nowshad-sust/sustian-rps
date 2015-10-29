<?php

class ChartController extends \BaseController {
    public function showChart(){
        $user_id = Auth::user()->id;
        $results = Result::where('user_id',$user_id)->get();
        $i = 0;
        $resultsArray = array();
        $countArray = array();
        foreach($results as $result){
            $resultsArray[] = (float) $result->grade_point;
            $countArray[] = (int) ++$i;
        }

        return View::make('chart.chart')->with(['title'=>'Chart','counts'=>$countArray,'grades'=>$resultsArray]);
    }

    public function calculateGPA(){
        $user_id = Auth::user()->id;
        $results = Result::where('user_id',$user_id)->with('Course')->get();
        return $results = $results->sortBy($results->course->course_semester);
    }
}