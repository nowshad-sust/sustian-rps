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
        return View::make('stat.resultForm')->with(['title'=>'Add Result']);
    }
    public function validateResult(){
        return 'validated';
    }
}