<?php

class UserInfo extends \Eloquent {
	protected $fillable = [];

	protected $table = 'userinfo';

	protected $guarded = ['id'];

	public function user(){
		return $this->belongsTo('User','user_id','id');
	}

	public function batch(){
		return $this->belongsTo('Batch','batch_id','id');
	}

	public function dept(){
		return $this->belongsTo('Dept','dept_id','id');
	}
}