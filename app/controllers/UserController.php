<?php

class UserController extends \BaseController {

    /**
     * show user registration form
     * @return mixed
     */
    public function showRegisterForm(){

        //return View::make('user.registerForm')->with('title','Register');
        return View::make('home.register')->with('title','Register');
    }


    /**
     * user registration validation
     * @return mixed
     */
    public function validateRegistration(){
        $rules =[
            'fullName'              =>  'required',
            'reg_no'                =>  'required|unique:userinfo,reg_no|digits:10',
            'email'                 =>  'required|email|unique:users',
            'password'              =>  'required|confirmed',
            'password_confirmation' =>  'required'
        ];

        $data = Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput(Input::except('password', 'password_confirmation'));
        }else{
            try{
                //dept & batch extraction from reg_no
                //batch should be 1111***### for admin registration
                $batch = (int) substr($data['reg_no'],0,4);
                $dept = (int) substr($data['reg_no'],4,3);
                //extraction finished


                //now find the batch id & dept id
                $batch_id = Batch::where('batch',$batch)->first()->id;
                $dept_id = Dept::where('deptCode',$dept)->first()->id;
                //finding ends

                if($batch_id==null||$dept_id==null){
                    throw new Exception;
                }
            }catch (Exception $ex){
                return Redirect::back()->withInput()->with(['error'=>'no valid batch or dept could be extracted from the given registration number,
                                                please recheck your registration number']);
            }

            $confirmation_code = str_random(30);

            $user = new User();

            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);

            if($user->save()){

                $role = Role::find(2);
                $user->attachRole($role);

                $user_info = new UserInfo();
                $user_info->fullName = $data['fullName'];
                $user_info->user_id = $user->id;
                $user_info->activation = false;
                $user_info->activation_key = $confirmation_code;
                $user_info->reg_no  = $data['reg_no'];
                $user_info->batch_id = $batch_id;
                $user_info->dept_id   = $dept_id;
                //set a default avatar
                $user_info->icon_url = 'uploads/image/defaultAvatar.png';
                $user_info->avatar_url = 'uploads/image/defaultAvatar.png';

                if($user_info->save()){
                    //send a activation mail
                    //genrate a activation key

                    Mail::send('user.activation', ['confirmation_code'=>$confirmation_code,
                                                    'fullName'=>$data['fullName']],
                        function($message) {
                            $message->to(Input::get('email'), Input::get('fullName'))
                                    ->subject('Verify your email address');
                    });

                    return Redirect::route('login')->with('success',"Your Account Created Successfully. Please check your email");
                }else{
                    return Redirect::back()->withInput()->withErrors($validation);
                }

            }else{
                return Redirect::back()->withInput()->withErrors($validation);
            }
        }
    }

    public function viewProfile(){
        return View::make('user.profile')->with(['title'=>'Profile']);
    }

    public function showProfileUpdateForm(){
        $profileInfo = Auth::user()->userInfo;
        return View::make('user.profileUpdateForm')->with(['title'=>'Update Profile',
                                                            'profileInfo'=> $profileInfo]);
    }

    public function validateProfileUpdate(){
        $rules =[
            'fullName'  =>  'required',
        ];

        $data = Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{

            if($userInfo = UserInfo::where('id',$data['id'])
                ->update(array(
                                'fullName' => $data['fullName']
                ))){
                return Redirect::route('profile')->with('success','profile updated successfully');
            }else{
                return Redirect::back()->withInput()->withErrors($validation);
            }
        }
    }

    public function uploadAvatarForm(){
        return View::make('user.avatar')->with(['title'=>'Avatar']);
    }

    public function uploadAvatar(){
        //add two extra fields to userinfo table
        //icon path & avatar path

        $rules = array(
            'image' => 'required|image|max:3000'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::route('uploadAvatar')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(); // send back the input (not the password) so that we can repopulate the form
        } else {

            if (Input::hasFile('image'))
            {
                $image = Input::file('image');

                //deleting previous file
                $prev_avatar_url = Auth::user()->userInfo->avatar_url;
                if($prev_avatar_url != 'uploads/image/defaultAvatar.png'){
                    if (File::exists($prev_avatar_url)) {
                    File::delete($prev_avatar_url);
                }
                    $prev_icon_url = Auth::user()->userInfo->icon_url;
                    if (File::exists($prev_icon_url)) {
                        File::delete($prev_icon_url);
                    }
                }

                $avatar_url = 'uploads/image/avatar/avatar-'.Auth::user()->id.'.jpg';
                $icon_url = 'uploads/image/icon/icon-'.Auth::user()->id.'.jpg';

                Image::make($image)->resize(200, 200)->save(public_path($avatar_url));
                Image::make($image)->resize(50, 50)->save(public_path($icon_url));


                if($imageInfo = UserInfo::where('user_id',Auth::user()->id)
                    ->update(array(
                        'avatar_url' => $avatar_url,
                        'icon_url' => $icon_url
                    ))){
                    return Redirect::route('profile')->with('success','avatar updated successfully');
                }else{
                    return Redirect::back()->withInput()->withErrors($validator);
                }

            }else{

                return Redirect::route('uploadAvatar')->with(['error'=>'image could not be uploaded']);
            }

        }

    }

    public function showOthersProfile($id){
        try{
            $userInfo = User::with('UserInfo')->where('id',$id)->first();

            return View::make('user.userProfile')->with(['title'=>'User Profile', 'userInfo'=>$userInfo]);
        }catch(Exception $q){
            return 'could not get user profile';
        }

    }

    public function showClassmates(){
        //all activated users of the same batch & same dept
        $classmatesInfo = UserInfo::where('activation',true)
                            ->where('batch_id',Auth::user()->userInfo->batch_id)
                            ->where('dept_id',Auth::user()->userInfo->dept_id)
                            ->get();

        return View::make('user.classmates')->with(['title'=>'Classmates','classmatesInfo'=>$classmatesInfo]);
    }


}
