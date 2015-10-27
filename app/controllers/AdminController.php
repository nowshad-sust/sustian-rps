<?php

class AdminController extends \BaseController {

    public function viewNotification(){
        $notification = Notification::all();

        return View::make('admin.viewNotification')->with(['title'=>'Notifications','notificationsInfo'=>$notification]);
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
        return View::make('admin.notificationForm')->with(['title'=>'Add Notification']);
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
                return Redirect::route('addNotification')->with(['success'=>'notification added']);
            }else{
                return Redirect::back()->with(['error'=>'error adding notification']);
            }
        }
    }
}