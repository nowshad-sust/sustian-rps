<?php

Route::get('/',function(){
	return Redirect::route('home');
});

//filter not needed
	Route::get('home',['as'=>'home','uses'=>'HomeController@showHome']);
	Route::get('test',['as'=>'test','uses'=>'HomeController@showTest']);
	Route::get('about',['as'=>'about','uses'=>'HomeController@showAbout']);
	Route::get('features',['as'=>'features','uses'=>'HomeController@showFeatures']);
	Route::get('contact',['as'=>'contact','uses'=>'HomeController@showContact']);
	Route::post('contact_request','HomeController@postContactUs');

Route::group(['before' => 'guest'], function(){
	Route::controller('password', 'RemindersController');
	Route::get('login', ['as'=>'login','uses' => 'AuthController@login']);
	Route::post('login', array('uses' => 'AuthController@doLogin'));
	Route::get('register',['as'=>'register','uses'=>'UserController@showRegisterForm']);
	Route::post('register',['uses'=>'UserController@validateRegistration']);
	Route::get('register/activation/{key}',['uses'=>'ActivationController@activate']);
	Route::get('activationRequest', ['as'=>'activationRequest', 'uses'=>'ActivationController@viewActivationRequest']);
	Route::post('sendActivationLink',['as'=>'sendActivationLink','uses'=>'ActivationController@sendActivationLink']);
});

Route::group(array('before' => 'auth|activation'), function()
{
	//login section
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'AuthController@dashboard'));
	Route::get('change-password', array('as' => 'password.change', 'uses' => 'AuthController@changePassword'));
	Route::post('change-password', array('as' => 'password.doChange', 'uses' => 'AuthController@doChangePassword'));

	//profile section
	Route::get('profile', ['as'=>'profile', 'uses'=>'UserController@viewProfile']);
	Route::get('updateProfile',['as'=>'updateProfile', 'uses'=>'UserController@showProfileUpdateForm']);
	Route::post('updateProfile',['as'=>'storeProfile', 'uses'=>'UserController@validateProfileUpdate']);
	Route::get('uploadAvatar',['as'=>'uploadAvatar', 'uses'=>'UserController@uploadAvatarForm']);
	Route::post('uploadAvatar',['as'=>'storeAvatar', 'uses'=>'UserController@uploadAvatar']);

	//all classmates grid
	Route::get('classmates',['as'=>'classmates', 'uses'=>'UserController@showClassmates']);
	//others profile view
	Route::get('showProfile/{id}', ['as'=>'showProfile', 'uses'=>'UserController@showOthersProfile']);

	//posts section
	Route::get('posts',['as'=>'posts', 'uses'=>'PostController@showAllPosts']);
	Route::post('posts',['as'=>'submitpost', 'uses'=>'PostController@submitPost']);
	Route::get('deletePost/{id}',['as'=>'deletePost', 'uses'=>'PostController@deletePost']);
	Route::post('updatePost',['as'=>'updatePost','uses'=>'PostController@updatePost']);

	//OLD message section
	Route::get('writeMessage',['as'=>'writeMessage', 'uses'=>'MessageController@showMessageForm']);
  	Route::post('writeMessage',['as'=>'postMessage', 'uses'=>'MessageController@sendMessage']);
	Route::get('messageDetails/{message_id}',['as'=>'messageDetails', 'uses'=>'MessageController@messageDetails']);
	Route::get('seeAllMessages',['as'=>'seeAllMessages', 'uses'=>'MessageController@seeAllMessages']);
	Route::get('replyMessage/{message_id}',['as'=>'replyMessage', 'uses'=>'MessageController@replyMessage']);
  	Route::post('replyMessage',['as'=>'postReply', 'uses'=>'MessageController@postReply']);

  	//NEW messages section
  	Route::get('messages',['as'=>'messages', 'uses'=>'MessageController@showNewMessages']);
  	Route::get('messages/view/{thread_id}',['as'=>'messages.view', 'uses'=>'MessageController@ViewNewMessage']);
  	Route::post('messages/send/{thread_id}',['as'=>'messages.send', 'uses'=>'MessageController@postNewMessage']);
  	Route::get('thread/new/{user_id}',['as'=>'thread.new', 'uses'=>'MessageController@newThread']);


	//STAT section
	Route::get('resultsDataTable',['as'=>'resultsDataTable', 'uses'=>'StatController@showAllResults']);
	Route::get('addResult',['as'=>'addResult', 'uses'=>'StatController@addResultForm']);
	Route::post('addResult',['as'=>'postResult', 'uses'=>'StatController@validateResult']);
	Route::get('dropList', ['as'=>'dropList', 'uses'=>'StatController@showDropList']);
	Route::get('editResult/{id}',['as'=>'editResult', 'uses'=>'StatController@showResultEditForm']);
	Route::post('editResult',['as'=>'updateResult', 'uses'=>'StatController@updateResult']);
	Route::get('deleteResult/{id}',['as'=>'deleteResult', 'uses'=>'StatController@deleteResult']);
	Route::get('classStanding',['as'=>'classStanding','uses'=>'StatController@getStanding2']);

	//chart section
	Route::get('chart/course-grade',['as'=>'chart.course-grade','uses'=>'ChartController@showcoursegrade']);
    Route::get('chart/course-cgpa',['as'=>'chart.course-cgpa','uses'=>'ChartController@showcoursecgpa']);
	Route::get('chart/class-cgpa',['as'=>'chart.class-cgpa','uses'=>'ChartController@showclasscgpa']);
	Route::get('chart/semester-cgpa',['as'=>'chart.semester-cgpa', 'uses'=>'ChartController@showsemestercgpa']);
	Route::get('chart/coursewise-stat/{course_id}',['as'=>'chart.coursewise-stat','uses'=>'ChartController@coursewisestat']);

	//Route::get('gpa',['as'=>'gpa','uses'=>'ChartController@calculateGPA']);
	Route::get('gpa/{semester}',['as'=>'gpaBySemester','uses'=>'StatController@gpaBySemester']);
	Route::get('results',['as'=>'results','uses'=>'StatController@showResultsTab']);
	Route::get('cgpa',['as'=>'cgpa','uses'=>'StatController@calculateCGPA']);

});

Route::group(array('before' => 'manager'), function()
{
	//mass data entry section
	Route::get('data-entry', ['as'=>'data.entry','uses'=>'ManagerController@index']);
	Route::get('data-add/{course_id}', ['as'=>'data.add','uses'=>'ManagerController@addCourseResultForm']);
	Route::put('data-add/{result_id}', ['as'=>'data.add.result','uses'=>'ManagerController@addCourseResultForOneUser']);
	Route::post('data-add/new', ['as'=>'data.add.new.result','uses'=>'ManagerController@addNewCourseResultForOneUser']);
	Route::get('delete-course-result/{result_id}',['as'=>'delete.course.result','uses'=>'ManagerController@deleteCourseResult']);
	
	//course section
	Route::get('show-course',['as'=>'course.show','uses'=>'ManagerController@showCourseList']);
	Route::get('add-course', ['as'=>'course.add.form','uses'=>'ManagerController@showCourseAddForm']);
	Route::post('add-course', ['as'=>'course.add.post','uses'=>'ManagerController@addCourse']);
	Route::get('edit-course/{id}',['as'=>'course.edit.form','uses'=>'ManagerController@showCourseEditForm']);
	Route::put('edit-course/{id}',['as'=>'course.edit.put', 'uses'=>'ManagerController@editCourse']);
	Route::get('delete-course/{id}',['as'=>'course.delete','uses'=>'ManagerController@deleteCourse']);
});

Route::group(array('before' => 'auth|admin'), function()
{
	/* user panel */
	//normal users section
	Route::get('users', ['as'=>'users','uses'=>'AdminController@showUsers']);
	//managers
	Route::get('managers',['as'=>'managers.show', 'uses'=>'AdminController@showManagers']);
	Route::get('make-manager/{user_id}',['as'=>'manager.make', 'uses'=>'AdminController@makeManager']);
	Route::get('remove-manager/{user_id}',['as'=>'manager.remove', 'uses'=>'AdminController@removeManager']);

	//admin
	Route::get('admin',['as'=>'admin.show', 'uses'=>'AdminController@showAdmin']);
	//Route::get('managers',['as'=>'managers.show', 'uses'=>'AdminController@showManagers']);


	//notification section
	Route::get('addNotification',['as'=>'addNotification', 'uses'=>'AdminController@showNotificationForm']);
	Route::post('addNotification',['as'=>'addNotification', 'uses'=>'AdminController@addNotification']);
	Route::get('viewNotifications', ['as'=>'viewNotifications', 'uses'=>'AdminController@viewNotification']);
	Route::get('deleteNotification/{id}',['as'=>'deleteNotification','uses'=>'AdminController@deleteNotification']);
	Route::get('activateNotification/{id}',['as'=>'activateNotification','uses'=>'AdminController@activateNotification']);
	Route::get('deactivateNotification/{id}',['as'=>'deactivateNotification','uses'=>'AdminController@deactivateNotification']);

	//dept section
	Route::get('showDept',['as'=>'showDept','uses'=>'AdminController@showDept']);
	Route::get('addDept',['as'=>'addDept','uses'=>'AdminController@showDeptForm']);
	Route::post('addDept',['as'=>'addDept','uses'=>'AdminController@addDept']);
	Route::get('deleteDept/{id}', ['as'=>'deleteDept', 'uses'=>'AdminController@deleteDept']);
	Route::get('editDept/{id}',['as'=>'editDept', 'uses'=>'AdminController@showDeptEditForm']);
	Route::post('editDept',['as'=>'updateDept', 'uses'=>'AdminController@editDeptInfo']);

	//batch section
	Route::get('showBatch',['as'=>'showBatch','uses'=>'AdminController@showBatchList']);
	Route::get('addBatch',['as'=>'addBatch','uses'=>'AdminController@showAddBatchForm']);
	Route::post('addBatch',['as'=>'addBatch','uses'=>'AdminController@addBatch']);
	Route::get('deleteBatch/{id}',['as'=>'deleteBatch','uses'=>'AdminController@deleteBatch']);

	//course section
	Route::get('showCourse',['as'=>'showCourse','uses'=>'AdminController@showCourseList']);
	Route::get('addCourse', ['as'=>'addCourse','uses'=>'AdminController@showCourseForm']);
	Route::post('addCourse', ['as'=>'addCourse','uses'=>'AdminController@addCourse']);
	Route::get('deleteCourse/{id}',['as'=>'deleteCourse','uses'=>'AdminController@deleteCourse']);
	Route::get('editCourse/{id}',['as'=>'editCourse','uses'=>'AdminController@showCourseEditForm']);
	Route::post('editCourse',['as'=>'updateCourse', 'uses'=>'AdminController@editCourse']);

	//message section
	Route::get('writeMessageTo/{receiver_id}',['as'=>'writeMessageTo', 'uses'=>'MessageController@showMessageToForm']);
	Route::post('writeMessageTo',['as'=>'postMessageTo', 'uses'=>'MessageController@postMessageTo']);


});
