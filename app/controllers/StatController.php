<?php

class StatController extends \BaseController {

    public function showResultsDataTable(){
        //find all results the user_id got
        //grab results info with their corresponding course info
        $results = Result::where('user_id',Auth::user()->id)
                            ->with('Course')->get();
        return View::make('stat.resultsDataTable')->with(['title'=>'Results','resultsInfo'=>$results]);
    }

    public function showResultEditForm($id){
        try{
            if($id != null){
                return $result = Result::where('id',$id)->first();
                return View::make('stat.resultEditForm')->with(['title'=>'Edit Result','resultInfo'=>$result]);
            }
        }catch(Exception $ex){

        }
    }

    public function addResultForm(){
        //get a courseList without the user have already added
        //after dept table added - get only the courses under user's
        //dept & courses that are not added already
        $courseList = Course::lists('course_number');
        $gradesList = [
            2.00,
            2.25,
            2.50,
            2.75,
            3.00,
            3.25,
            3.50,
            3.75,
            4.00
        ];

        return View::make('stat.resultForm')->with(['title'=>'Add Result','courseList'=>$courseList, 'gradeList'=>$gradesList]);
    }

    public function validateResult(){
        $rules =[
            'course_number'  =>  'required',

            'grade_point'   => 'required'
        ];
        return $data =  Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
            $user_id = Auth::user()->id;
            return $course_id = Course::where('course_number',$data['course_number'])->get();

            $result = new Result();
            $result->user_id = $user_id;
            $result->course_id = $course_id;

            if($result->save()){
                return Redirect::route('addNotification')->with(['success'=>'notification added']);
            }else{
                return Redirect::back()->with(['error'=>'error adding notification']);
            }
        }
    }
}