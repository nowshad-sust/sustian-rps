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
                $gradesList = [
                    '2.00'    =>  'C-',
                    '2.25'    =>  'C',
                    '2.50'    =>  'C+',
                    '2.75'    =>  'B-',
                    '3.00'    =>  'B',
                    '3.25'    =>  'B+',
                    '3.50'    =>  'A-',
                    '3.75'    =>  'A',
                    '4.00'    =>  'A+'
                ];
                $result = Result::where('id',$id)->with('Course')->first();
                return View::make('stat.resultEditForm')->with(['title'=>'Edit Result',
                                                                'resultInfo'=>$result,
                                                                'gradesList'=>$gradesList]);
            }
        }catch(Exception $ex){

        }
    }

    public function updateResult(){
        $rules =[
            'grade_point'   => 'required'
        ];
        $data =  Input::all();
        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
            $grade_point = (float) $data['grade_point'];
            $grade_letter = $this->getGradeLetter($grade_point);

            $result = Result::find($data['id']);

            if($result->update([
                'grade_point' => $grade_point,
                'grade_letter'   => $grade_letter
                ])){
                return Redirect::route('resultsDataTable')->with(['success'=>'Result updated']);
            }else{
                return Redirect::back()->withInput()->with(['error'=>'error update result']);
            }
        }
    }

    public function deleteResult($id = null){

            try{
                if($id != null){
                    $result = Result::find($id);
                    if($result->delete()){
                        return Redirect::route('showResult')->with(['success'=>'Result deleted']);
                    }else{
                        return Redirect::route('showResult')->with(['error'=>'could not find result to delete']);
                    }
                }

            }catch (Exception $ex){
                return Redirect::route('showResult')->with(['error'=>'could not delete!']);
            }

    }

    public function addResultForm(){
        //get a courseList without the user have already added
        //after dept table added - get only the courses under user's
        //dept & courses that are not added already
        $userDeptId = Auth::user()->userinfo->dept_id;
        $userBatchId = Auth::user()->userinfo->batch_id;
        $courseList = Course::where('dept_id',$userDeptId)
            ->where('batch_id',$userBatchId)->lists('course_number','id');

        $gradesList = [
            '2.00'    =>  'C-',
            '2.25'    =>  'C',
            '2.50'    =>  'C+',
            '2.75'    =>  'B-',
            '3.00'    =>  'B',
            '3.25'    =>  'B+',
            '3.50'    =>  'A-',
            '3.75'    =>  'A',
            '4.00'    =>  'A+'
        ];

        return View::make('stat.resultForm')->with(['title'=>'Add Result','courseList'=>$courseList, 'gradeList'=>$gradesList]);
    }

    public function validateResult(){
        $rules =[
            'course_id'  =>  'required',

            'grade_point'   => 'required'
        ];
        $data =  Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{



            $user_id = Auth::user()->id;
            $course_id = Course::where('id',$data['course_id'])->first()->id;
            $grade_point = (float) $data['grade_point'];
            $grade_letter = $this->getGradeLetter($grade_point);

            $result = new Result();
            $result->user_id = $user_id;
            $result->course_id = $course_id;
            $result->grade_point = $grade_point;
            $result->grade_letter   = $grade_letter;

            if($result->save()){
                return Redirect::route('resultsDataTable')->with(['success'=>'Result added']);
            }else{
                return Redirect::back()->withInput()->with(['error'=>'error adding result']);
            }
        }
    }

    private function getGradeLetter($grade_point){
        switch ($grade_point) {
            case 2.00:
                $grade_letter = 'C-';
                break;

            case 2.25:
                $grade_letter = 'C';
                break;

            case 2.50:
                $grade_letter = 'C+';
                break;

            case 2.75:
                $grade_letter = 'B-';
                break;
            case 3.00:
                $grade_letter = 'B';
                break;

            case 3.25:
                $grade_letter = 'B+';
                break;

            case 3.50:
                $grade_letter = 'A-';
                break;

            case 3.75:
                $grade_letter = 'A';
                break;
            case 3.00:
                $grade_letter = 'A+';
                break;

        }
        return  $grade_letter;
    }
}