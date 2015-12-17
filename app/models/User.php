<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $guarded = [];

	protected $with = ['userInfo'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function userInfo(){
		return $this->hasOne('UserInfo', 'user_id', 'id');
	}

	public function result(){
		return $this->hasMany('Result', 'user_id', 'id');
	}

	public function senderMessage(){
		return $this->hasMany('Message', 'sender_id', 'id');
	}

	public function receiverMessage(){
		return $this->hasMany('Message', 'receiver_id', 'id');
	}

	public function posts(){
		return $this->hasMany('Posts', 'post_user_id', 'id');
	}

	public function owner1Thread(){
		return $this->hasMany('Thread', 'owner1_id', 'id');
	}

	public function owner2Thread(){
		return $this->hasMany('Thread', 'owner2_id', 'id');
	}

	public function roles()
	{
	    return $this->belongsToMany('Role','assigned_roles');
	}

}
