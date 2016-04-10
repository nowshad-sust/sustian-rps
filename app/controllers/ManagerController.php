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
		$batch = Auth::user()->userInfo->batch;

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


    public function showCourseList(){

        $courseInfo = Course::where('dept_id', Auth::user()->userInfo->dept->id)
        					->where('batch_id',Auth::user()->userInfo->batch->id)
        					->with('dept')
        					->with('batch')
        					->get();
        					
        return View::make('manager.course.courseList')->with(['title'=>'Courses','courseInfo'=>$courseInfo]);
    }


    public function showCourseAddForm(){

    	$semesterList = array(

            1   =>  '1/1',
            2   =>  '1/2',
            3   =>  '2/1',
            4   =>  '2/2',
            5   =>  '3/1',
            6   =>  '3/2',
            7   =>  '4/1',
            8   =>  '4/2',
            9   =>  '5/1',
            10  =>  '5/2'

        );

    	return View::make('manager.course.courseForm')->with('title', 'Add Course')
    													->with('semesterList',$semesterList);
    }
    public function addCourse(){
        try{

            $rules =[
                'course_semester'   =>  'required',
                'course_number'     =>  'required',
                'course_title'      =>  'required',
                'course_credit'     =>  'required|numeric'
            ];

            $data = Input::all();

            $validation = Validator::make($data,$rules);

            if($validation->fails()){
                return Redirect::back()->withErrors($validation)->withInput();
            }else{

                $Course = new Course();
                $Course->dept_id = Auth::user()->userInfo->dept_id;
                $Course->batch_id = Auth::user()->userInfo->batch_id;
                $Course->course_semester = $data['course_semester'];
                $Course->course_number = $data['course_number'];
                $Course->course_title = $data['course_title'];
                $Course->course_credit = $data['course_credit'];

                if($Course->save()){
                    return Redirect::back()->with(['success'=>'Course added']);
                }else{
                    return Redirect::back()->withInput()->with(['error'=>'Course adding failed']);
                }
            }

        }catch(Exception $ex){
            return Redirect::back()->withInput()->with(['error'=>'Course adding failed!']);
        }
    }

    public function showCourseEditForm($id=null){
        try{
            $semesterList = array(

                1   =>  '1/1',
                2   =>  '1/2',
                3   =>  '2/1',
                4   =>  '2/2',
                5   =>  '3/1',
                6   =>  '3/2',
                7   =>  '4/1',
                8   =>  '4/2',
                9   =>  '5/1',
                10  =>  '5/2'

            );

            if($id != null){
            	$course = Course::find($id);
                if($course){
                    return View::make('manager.course.courseEditForm')->with(['title'=>'Edit Course Info',
                                                                        'courseInfo'=>$course,
                                                                        'semesterList'=>$semesterList]);
                }else{
                    return Redirect::back()->with(['error'=>'could not find course']);
                }
            }

        }catch (Exception $ex){
            return Redirect::route('data.entry')->with(['error'=>'could not find anything!']);
        }

    }

    public function editCourse($id){
        try{

            $rules =[
                'course_semester'   =>  'required',
                'course_number'     =>  'required',
                'course_title'      =>  'required',
                'course_credit'     =>  'required|numeric'
            ];
            $data = Input::all();

            $validation = Validator::make($data,$rules);

            if($validation->fails()){
                return Redirect::back()->withErrors($validation)->withInput();
            }else{

                $Course = Course::find($id);
				$update = $Course->update([
                    'course_semester' => $data['course_semester'],
                    'course_number' => $data['course_number'],
                    'course_title' => $data['course_title'],
                    'course_credit' => $data['course_credit']
                	]);

                if($update){
                    return Redirect::back()->with(['success'=>'Course info update']);
                }else{
                    return Redirect::back()->withInput()->with(['error'=>'Course update failed']);
                }
            }

        }catch(Exception $ex){
            return Redirect::back()->withInput()->with(['error'=>'Course update failed!']);
        }
    }

    public function deleteCourse($id = null){
        try{
            if($id != null){
                $course = Course::find($id);
                if($course->delete()){
                    return Redirect::route('data.entry')->with(['success'=>'Course deleted']);
                }else{
                    return Redirect::back()->with(['error'=>'could not find course to delete']);
                }
            }

        }catch (Exception $ex){
            return Redirect::route('showCourse')->with(['error'=>'could not delete!']);
        }

    }

}