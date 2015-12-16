<?php

class ManagerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /manager
	 * show all the courses available
	 * @return Response
	 */
	public function index()
	{
		$userInfo = UserInfo::where('user_id',Auth::user()->id)
							->first();

		$dept = $userInfo->dept;
		$batch = Batch::where('batch',2012)->first();

		$courseDetails = Course::where('dept_id', $dept->id)
							->where('batch_id', $batch->id)
							->orderBy('course_semester')
							->orderBy('course_number')
							->get();

		$courseList = $courseDetails->lists('course_number','id');

		return View::make('manager.index')->with('title','Manager')
										  ->with('courseList',$courseList)
										  ->with('courseDetails',$courseDetails);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /manager/create
	 *
	 * @return Response
	 */
	public function addCourseResultForm($course_id)
	{
		$courseInfo = Course::find($course_id);
		$studentList = UserInfo::where('dept_id',Auth::user()->userInfo->dept->id)
								->where('batch_id',Auth::user()->userInfo->batch->id)
								->with('user')
								->orderBy('reg_no')
								->get();
		
		$totalResults = array();
		foreach ($studentList as $student) {
			$temp = Result::where('course_id',$course_id)
									->where('user_id',$student->user_id)
									->with('user')
									->first();
			if($temp == null){
				$totalResults[]= array(
					'id'		=> 	null,
					'user_id'	=>	$student->user_id,
					'course_id'	=>	$course_id,
					'grade_point'	=> null,
					'grade_letter'	=> null,
					'user'			=> array(
										'id'	=>	$student->user_id,
										'user_info'	=>	array(
														'reg_no'   => $student->reg_no,
														'fullName' => $student->fullName
														)
											)
					);
			}else{
				$totalResults[] = $temp;
			}
		}


		//return $totalResults;
		//now for new entries
		//show students who do not have entered this subjetcs result

		return View::make('manager.addCourseResult')->with('title','Add course data')
													->with('courseInfo',$courseInfo)
													->with('studentList',$studentList)
													->with('existingResults',$totalResults);
	}

	public function addCourseResultForOneUser($result_id){

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

            $result = Result::find($result_id);

            if($result->update([
                'grade_point' => $grade_point,
                'grade_letter'   => $grade_letter
                ])){
                return Redirect::back()->with(['success'=>'Result updated']);
            }else{
                return Redirect::back()->withInput()->with(['error'=>'error update result']);
            }
        }
	}

	public function addNewCourseResultForOneUser(){

		$rules =[
            'grade_point'   => 'required',
        ];

        $data =  Input::all();
        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
        	$user_id = $data['user_id'];
        	$course_id = $data['course_id'];
            $grade_point = (float) $data['grade_point'];
            $grade_letter = $this->getGradeLetter($grade_point);

            $result = new Result();
            $result->user_id = $user_id;
            $result->course_id = $course_id;
            $result->grade_point = $grade_point;
            $result->grade_letter = $grade_letter;

            if($result->save()){
                return Redirect::back()->with(['success'=>'Result added']);
            }else{
                return Redirect::back()->with(['error'=>'error adding result']);
            }
        }
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /manager
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /manager/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /manager/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /manager/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /manager/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteCourseResult($result_id = null)
	{
		try{
                if($result_id != null){
                    $result = Result::find($result_id);
                    if($result->delete()){
                        return Redirect::back()->with(['success'=>'Result deleted']);
                    }else{
                        return Redirect::back()->with(['error'=>'could not find result to delete']);
                    }
                }

            }catch (Exception $ex){
                return Redirect::back()->with(['error'=>'could not delete!']);
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

}