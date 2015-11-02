<?php

class StatController extends \BaseController {

    public function showResultsDataTable(){
        try{
            //find all results the user_id got
            //grab results info with their corresponding course info
            $results = Result::where('user_id',Auth::user()->id)
                ->with('Course')->get();
            return View::make('stat.resultsDataTable')
                ->with(['title'=>'Results',
                    'resultsInfo'=>$results]);
        }catch (Exception $ex){
            return View::make('stat.resultsDataTable')
                ->with(['title'=>'Results',
                    'resultsInfo'=>[],'error'=>'error generating data table']);
        }
    }

    public function showResultsTab(){
        return View::make('stat.resultsTab')->with(['title'=>'Results Tab']);
    }

    public function showResultEditForm($id){
        try{
            if($id != null){
                $gradesList = [
                    '0.00'    =>  'F',
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
                return Redirect::back()
                    ->with(['error','error generating the edit form']);
        }
    }
    public function gpaBySemester($semester){
        try{
            $user_id = Auth::user()->id;
            $semester_courses = Course::where('course_semester', $semester)->lists('id');
            $semesterGPA = $this->calculateSemesterGPA($semester);
            if($semesterGPA==0){
                return Redirect::back()->with(['warning'=>'no semester data added yet']);
            }
            $results = Result::where('user_id',$user_id)->whereIn('course_id',$semester_courses)->with('Course')->get();
            return View::make('stat.semesterGPA')->with(['title'=>'Semester GPA',
                'semesterGPA'=>$semesterGPA,
                'resultsInfo'=>$results,
                'semester'=>$semester]);
        }catch (Exception $ex){
            return Redirect::back()->with(['error'=>'semester data not found']);
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
                return Redirect::back()->with(['warning'=>'not enough data to count your CGPA']);
            }
            //enlist all avaiable semester GPA
            //available semesters
            $available_semesters = array();
            $semestersGPA = array();
            foreach($results as $result){
                if(!in_array($result->course->course_semester, $available_semesters)){
                    $available_semesters[]= $result->course->course_semester;
                    $semestersGPA[] = $this->calculateSemesterGPA($result->course->course_semester);
                }

            }
            return View::make('stat.CGPA')->with(['title'=>'CGPA',
                'semesters'=>$available_semesters,
                'semestersGPA'=>$semestersGPA,
                'cgpa'=>$CGPA]);

        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'could not count CGPA']);
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
                        return Redirect::route('resultsDataTable')->with(['success'=>'Result deleted']);
                    }else{
                        return Redirect::route('resultsDataTable')->with(['error'=>'could not find result to delete']);
                    }
                }

            }catch (Exception $ex){
                return Redirect::route('resultsDataTable')->with(['error'=>'could not delete!']);
            }

    }

    public function showDropList(){

        $user_id = Auth::user()->id;

        $drop_courses_info = Result::where('user_id',$user_id)
            ->where('grade_point',0.00)
            ->with('Course')
            ->get();

        return View::make('stat.dropList')->with([
            'title' =>  'Drop Courses',
            'dropInfo'  =>  $drop_courses_info
        ]);
    }

    public function addResultForm(){
        //get a courseList without the user have already added
        //after dept table added - get only the courses under user's
        //dept & courses that are not added already
        $userDeptId = Auth::user()->userinfo->dept_id;
        $userBatchId = Auth::user()->userinfo->batch_id;
        $user_id = Auth::user()->id;

        $taken_courses_id = Result::where('user_id',$user_id)->where('grade_point','!=',0)->lists('course_id');
        $courseList = Course::whereNotIn('id',$taken_courses_id)->lists('course_number','id');

        $gradesList = [
            '0.00'    =>  'F',
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

            //if result already exists then instead of creating a new one, just update the older one
            if($result = Result::where('course_id',$course_id)->first()){
                if($result->update([
                    'grade_point' => $grade_point,
                    'grade_letter'   => $grade_letter
                ])){
                    return Redirect::route('resultsDataTable')->with(['success'=>'Drop course result updated']);
                }else{
                    return Redirect::back()->withInput()->with(['error'=>'error adding drop course result']);
                }
            }else{
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
    }

    private function getGradeLetter($grade_point){
        switch ($grade_point) {

            case 0.00:
                $grade_letter = 'F';
                break;

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
            case 4.00:
                $grade_letter = 'A+';
                break;

        }
        return  $grade_letter;
    }
    private function calculateSemesterGPA($semester){
        try{
            $user_id = Auth::user()->id;
            //GPA: (course_credit X obtained_grade_point)/total_credits
            //total course_credit = add all course_credit from each result
            $semester_courses = Course::where('course_semester', $semester)->lists('id');
            $results = Result::where('user_id',$user_id)
                ->where('grade_point','!=',0.00)
                ->whereIn('course_id',$semester_courses)
                ->with('Course')
                ->get();

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


    public function getStanding(){

        try{
            //get cgpa list of each of your batch & dept
            //sort them by cgpa
            //get your position
            $classmates_id = UserInfo::where('batch_id',Auth::user()->userInfo->batch_id)
                ->where('dept_id',Auth::user()->userInfo->dept_id)->lists('user_id');

            //calculate cgpa of each user
            $classmates_cgpa = array();
            foreach($classmates_id as $classmate_id){
                $classmates_cgpa[] = $this->calculateUserCGPA($classmate_id);
            }

            $combinedArray = array_combine($classmates_id, $classmates_cgpa);


            arsort($combinedArray);
            $combinedArray = array_filter($combinedArray);
            $compared_with = count($combinedArray);



            if($compared_with <= 0){

                return View::make('stat.classStanding')->with(['title'=>'Class Standing',
                    'standing'=>'not found',
                    'comparison'=>$compared_with]);
            }else{

                $classStanding = array_search(Auth::user()->userinfo->user_id,array_keys($combinedArray)) + 1;
                return View::make('stat.classStanding')->with(['title'=>'Class Standing',
                    'standing'=>$classStanding,
                    'comparison'=>$compared_with]);
            }

        }catch (Exception $ex){
            return Redirect::back()->with(['error'=>'standing could not be counted']);
        }

    }
    private function calculateUserCGPA($classmate_id)
    {
        try{
            $user_id = $classmate_id;
            $taken_courses_id = Result::where('user_id',$user_id)->lists('course_id');
            $results = Result::where('user_id',$user_id)
                ->where('grade_point','!=',0.00)
                ->whereIn('course_id',$taken_courses_id)
                ->with('Course')->get();

            return $CGPA = $this->calculateSingleCGPA($results);

        }catch (Exception $ex){
            return Redirect::back()->with(['error'=>'error calculating cgpa']);
        }
    }

    private function calculateSingleCGPA($results){
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