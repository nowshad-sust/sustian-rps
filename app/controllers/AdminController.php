<?php

class AdminController extends \BaseController {

    public function viewNotification(){
        $notification = Notification::all();

        return View::make('admin.notification.viewNotification')->with(['title'=>'Notifications','notificationsInfo'=>$notification]);
    }

    public function deleteNotification($id){
        try{
            if($id!=null){
                $notification = Notification::where('id',$id)->first();
                if($notification->delete()){
                    return Redirect::back()->with(['success'=>'notification deleted']);
                }else{
                    return Redirect::back()->with(['warning'=>'notification deletion failed']);
                }
            }
        }catch (Exception $ex){
            return Redirect::back()->with(['error'=>'notification deletion failed!']);
        }
    }

    public function activateNotification($id){
        try{
            if($id!=null){
                if($notification = Notification::where('id',$id)->update(['status'=>true])){
                    return Redirect::back()->with(['success'=>'notification activated']);
                }else{
                    return Redirect::back()->with(['warning'=>'notification activation failed']);
                }
            }

        }catch (Exception $e){
            return Redirect::back()->with(['error'=>'notification activation failed']);
        }
    }

    public function deactivateNotification($id){

        try{
            if($id!=null){
                if($notification = Notification::where('id',$id)->update(['status'=>false])){
                    return Redirect::back()->with(['success'=>'notification deactivated']);
                }else{
                    return Redirect::back()->with(['warning'=>'notification deactivation failed']);
                }
            }

        }catch (Exception $e){
            return Redirect::back()->with(['error'=>'notification deactivation failed']);
        }
    }

    public function showNotificationForm(){
        return View::make('admin.notification.notificationForm')->with(['title'=>'Add Notification']);
    }
    public function addNotification(){
        $rules =[
            'notification'  =>  'required'
        ];
        $data = Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
            $notification = new Notification();
            $notification->notification_text = $data['notification'];
            $notification->status = true;
            if($notification->save()){
                return Redirect::route('viewNotifications')->with(['success'=>'notification added']);
            }else{
                return Redirect::back()->with(['error'=>'error adding notification']);
            }
        }
    }

    public function showDept(){
        $dept = Dept::all();
        return View::make('admin.dept.dept')->with(['title'=>'Departments','deptInfo'=>$dept]);
    }

    public function showDeptForm(){
        return View::make('admin.dept.deptForm')->with(['title'=>'Add Department']);
    }

    public function addDept(){
        $rules =[
            'deptCode'  =>  'required|unique:dept,deptCode|digits:3',
            'dept'      =>  'required',
            'deptName'  => 'required'
        ];
        $data = Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
            $dept = new Dept();
            $dept->deptCode = (int) $data['deptCode'];
            $dept->deptName = $data['deptName'];
            $dept->dept = $data['dept'];
            if($dept->save()){
                return Redirect::route('showDept')->with(['success'=>'Department added']);
            }else{
                return Redirect::back()->with(['error'=>'error adding department']);
            }
        }
    }

    public function deleteDept($id = null){
        try{
            if($id != null){
                $dept = Dept::find($id);

                if($dept->delete()){
                    return Redirect::route('showDept')->with(['success'=>'dept deleted']);
                }else{
                    return Redirect::back()->with(['error'=>'dept deletion failed!']);
                }
            }
        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'dept deletion failed!']);
        }
    }

    public function showDeptEditForm($id){
        try{
            if($id != null){

                $dept = Dept::find($id);

                return View::make('admin.dept.deptEditForm')->with(['title'=>'Edit Dept Info','deptInfo'=>$dept]);
            }
        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'dept info update failed']);
        }
    }

    public function editDeptInfo(){
        try{

            $rules =[
                'deptCode'  =>  'required|digits:3',
                'dept'      =>  'required',
                'deptName'  => 'required'
            ];
            $data = Input::all();

            $validation = Validator::make($data,$rules);

            if($validation->fails()){
                return Redirect::back()->withErrors($validation)->withInput();
            }else{
                $dept = Dept::find(Input::get('id'));

                if($dept->update([
                    'deptCode'  =>  (int) $data['deptCode'],
                    'deptName'  =>  $data['deptName'],
                    'dept'      =>  $data['dept']
                ])){
                    return Redirect::route('showDept')->with(['success'=>'Department info updated']);
                }else{
                    return Redirect::back()->withInput()->with(['error'=>'error updating department info']);
                }
            }

        }catch(Exception $ex){
            return Redirect::back()->with(['error'=>'dept info update failed!']);
        }

    }

    public function showBatchList(){
        $batchInfo = Batch::get(['batch','id']);
        return View::make('admin.batch.batchList')->with(['title'=>'Batch List', 'batchInfo'=>$batchInfo]);
    }

    public function showAddBatchForm(){
        return View::make('admin.batch.addBatchForm')->with(['title'=>'Add batch']);
    }

    public function addBatch(){
        try{

            $rules =[
                'batch'  =>  'required|digits:4',
            ];
            $data = Input::all();

            $validation = Validator::make($data,$rules);

            if($validation->fails()){
                return Redirect::back()->withErrors($validation)->withInput();
            }else{
                $batch = new Batch();
                $batch->batch = (int) $data['batch'];

                if($batch->save()){
                    return Redirect::route('showBatch')->with(['success'=>'Batch added']);
                }else{
                    return Redirect::back()->withInput()->with(['error'=>'Batch adding failed']);
                }
            }

        }catch(Exception $ex){
            return Redirect::back()->withInput()->with(['error'=>'Batch adding failed!']);
        }
    }

    public function deleteBatch($id = null){
        try{
            if($id != null){
                $batch = Batch::find($id);
                if($batch->delete()){
                    return Redirect::route('showBatch')->with(['success'=>'batch deleted']);
                }else{
                    return Redirect::route('showBatch')->with(['error'=>'could not find anything to delete']);
                }
            }

        }catch (Exception $ex){
            return Redirect::route('showBatch')->with(['error'=>'could not delete!']);
        }
    }


    public function showCourseList(){

        $courseInfo = Course::with(['dept','batch'])->get();
        return View::make('admin.course.courseList')->with(['title'=>'Courses','courseInfo'=>$courseInfo]);
    }

    public function showCourseForm(){
        $dept = Dept::lists('deptName','id');
        $batch = Batch::lists('batch','id');

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

        return View::make('admin.course.courseForm')->with(['title'=>'Add Course',
                                                            'deptInfo'=>$dept,
                                                            'batchInfo'=>$batch,
                                                            'semesterList'=>$semesterList]);
    }
    public function addCourse(){
        try{

            $rules =[
                'dept_id'  =>   'required',
                'batch_id'  =>  'required',
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
                $Course->dept_id = $data['dept_id'];
                $Course->batch_id = $data['batch_id'];
                $Course->course_semester = $data['course_semester'];
                $Course->course_number = $data['course_number'];
                $Course->course_title = $data['course_title'];
                $Course->course_credit = $data['course_credit'];

                if($Course->save()){
                    return Redirect::route('showCourse')->with(['success'=>'Course added']);
                }else{
                    return Redirect::back()->withInput()->with(['error'=>'Course adding failed']);
                }
            }

        }catch(Exception $ex){
            return Redirect::back()->withInput()->with(['error'=>'Course adding failed!']);
        }
    }

    public function deleteCourse($id = null){
        try{
            if($id != null){
                $course = Course::find($id);
                if($course->delete()){
                    return Redirect::route('showCourse')->with(['success'=>'Course deleted']);
                }else{
                    return Redirect::route('showCourse')->with(['error'=>'could not find course to delete']);
                }
            }

        }catch (Exception $ex){
            return Redirect::route('showCourse')->with(['error'=>'could not delete!']);
        }

    }

    public function showCourseEditForm($id=null){
        try{
            $dept = Dept::lists('deptName','id');
            $batch = Batch::lists('batch','id');

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
                if($course = Course::find($id)){
                    return View::make('admin.course.courseEditForm')->with(['title'=>'Edit Course Info',
                                                                        'courseInfo'=>$course,
                                                                        'deptInfo'=>$dept,
                                                                        'batchInfo'=>$batch,
                                                                        'semesterList'=>$semesterList]);
                }else{
                    return Redirect::route('showCourse')->with(['error'=>'could not find course']);
                }
            }

        }catch (Exception $ex){
            return Redirect::route('showCourse')->with(['error'=>'could not find anything!']);
        }

    }

    public function editCourse(){
        try{

            $rules =[
                'dept_id'  =>   'required',
                'batch_id'  =>  'required',
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

                $Course = Course::find(Input::get('id'));

                if($Course->update([
                    'dept_id' => $data['dept_id'],
                    'batch_id' => $data['batch_id'],
                    'course_semester' => $data['course_semester'],
                    'course_number' => $data['course_number'],
                    'course_title' => $data['course_title'],
                    'course_credit' => $data['course_credit']
                ])){
                    return Redirect::route('showCourse')->with(['success'=>'Course info update']);
                }else{
                    return Redirect::back()->withInput()->with(['error'=>'Course update failed']);
                }
            }

        }catch(Exception $ex){
            return Redirect::back()->withInput()->with(['error'=>'Course update failed!']);
        }
    }
}