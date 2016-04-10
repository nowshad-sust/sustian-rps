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

    public function showAllResults(){
        try{
            
            //show semesterwise results table

            //find all results the user_id got
            //grab results info with their corresponding course info
            $results = Result::where('user_id',Auth::user()->id)
                ->with('Course')->get();

            //group the results by course semester
            $result = array();
            foreach ($results as $data) {
              $id = $data['course']->course_semester;
              if (isset($result[$id])) {
                 $result[$id][] = $data;
              } else {
                 $result[$id] = array($data);
              }
            }

            //return $result;

            return View::make('stat.allResults')
                ->with(['title'=>'Results',
                    'resultsInfo'=>$result]);
        }catch (Exception $ex){
            return View::make('stat.allResults')
                ->with(['title'=>'Results',
                    'resultsInfo'=>[],'error'=>'error generating data table']);
        }   
    }

    public function showResultsTab(){

        try{

            $user_dept = Auth::user()->userInfo->dept->id;
            $user_batch = Auth::user()->userInfo->batch->id; 

            return $courses = Course::where('dept_id',$dept_id)
                                ->where('batch_id',$batch_id)
                                ->with('result')
                                ->get();

            return View::make('stat.resultsTab')->with(['title'=>'Results Tab'])
                                                ->with('dropInfo',[]);
        }catch (Exception $ex){
            return View::make('stat.resultsTab')->with(['title'=>'Results Tab'])
                                                ->with('dropInfo',[]);;
        }
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

        $taken_courses_id = Result::where('user_id',$user_id)
                                    //->where('grade_point','!=',0)
                                    ->lists('course_id');
        $courseList = Course::where('dept_id', Auth::user()->userInfo->dept->id)
                            ->where('batch_id',Auth::user()->userInfo->batch->id)
                            ->whereNotIn('id',$taken_courses_id)
                            ->orderBy('course_semester','asc')
                            ->lists('course_number','id');

        $newCourseList = array();
        
        foreach($courseList as $id=>$number){
            $title = Course::where('dept_id', Auth::user()->userInfo->dept->id)
                            ->where('batch_id',Auth::user()->userInfo->batch->id)
                            ->where('course_number',$number)
                            ->pluck('course_title');
                            
            $newCourseList[$id] = $number.' - '.$title;
        }

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

        return View::make('stat.resultForm')->with(['title'=>'Add Result','courseList'=>$newCourseList, 'gradeList'=>$gradesList]);
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
            $result = Result::where('course_id',$course_id)
                            ->where('user_id', $user_id)
                            ->first();

            if($result != null || !empty($result)){
              $update = $result->update([
                  'grade_point' => $grade_point,
                  'grade_letter'   => $grade_letter
              ]);
                if($update){
                    return Redirect::route('resultsDataTable')->with(['success'=>'Drop course result updated']);
                }else{
                    return Redirect::back()->withInput()->with(['error'=>'error adding drop course result']);
                }
            }else{
                $result = new Result();
                $result->user_id = $user_id;
                $result->course_id = $course_id;
                $result->grade_point = $grade_point;
                $result->grade_letter = $grade_letter;

                if($result->save()){
                    return Redirect::route('addResult')->with(['success'=>'Result added']);
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

            //check user has valid data to calculate
            $user_cgpa = $this->calculateUserCGPA(Auth::user()->id);
            if($user_cgpa == null || $user_cgpa <= 0){
                return 'you have not given us enough data to get your position!';
            }

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

    public function getStanding2(){

        try{

            //check user has valid data to calculate
            $user_cgpa = $this->calculateUserCGPA(Auth::user()->id);
            if($user_cgpa == null || $user_cgpa <= 0){
                return 'you have not given us enough data to get your position!';
            }

            //get cgpa list of each of your batch & dept
            //sort them by cgpa
            //get your position
            $classmates_id = UserInfo::where('batch_id',Auth::user()->userInfo->batch_id)
                                    ->where('dept_id',Auth::user()->userInfo->dept_id)
                                    ->lists('user_id');

            //calculate cgpa of each user
            $classmates_cgpa = array();
            $classmates_passed_credits = array();
            foreach($classmates_id as $classmate_id){
                $classmates_cgpa[$classmate_id]['cgpa'] = $this->calculateUserCGPA($classmate_id);
                $classmates_cgpa[$classmate_id]['credits'] = $this->getPassedCredits($classmate_id);
            }

            //return $classmates_cgpa;
            //$combinedArray = array_combine($classmates_id, $classmates_cgpa);

            $combinedArray = array_filter($classmates_cgpa);

            foreach ($combinedArray as $key => $value) {
                if($value['cgpa'] == null){
                    unset($combinedArray[$key]);
                }
            }
            
            uasort($combinedArray, function($a, $b) { 
                $rdiff = $b['credits'] - $a['credits'];
                if ($rdiff) return $rdiff; 
                return $a['cgpa'] <= $b['cgpa']; 
            });

            return $combinedArray;
            
            $position = 1;
            $userposition = 1;
            $RankingDetails = array();

            foreach ($combinedArray as $id => $value) {
                $RankingDetails[$id]['info'] = UserInfo::where('user_id',$id)->first();
                $RankingDetails[$id]['cgpa'] = $value['cgpa'];
                $RankingDetails[$id]['credits'] = $value['credits'];
                $RankingDetails[$id]['rank'] = $position;
                if($id == Auth::user()->id){
                    $userposition = $position;
                }
                $position++;
            }

            return $RankingDetails;

            $comparedWith = count($combinedArray);
            
            if($comparedWith < 1){

                return View::make('stat.classStanding')->with(['title'=>'Class Standing',
                    'standing'=>'not found',
                    'comparison'=>$comparedWith]);
            }else{

                $classStanding = array_search(Auth::user()->userinfo->user_id,array_keys($combinedArray)) + 1;
                return View::make('stat.classStanding')->with(['title'=>'Class Standing',
                    'standing'=>$userposition,
                    'ranking'=>$combinedArray,
                    'RankingDetails'=>$RankingDetails,
                    'comparison'=>$comparedWith]);
            }

        }catch (Exception $ex){
            return Redirect::back()->with(['error'=>'standing could not be counted']);
        }

    }

    public function getPassedCredits($user_id){
        try{
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
