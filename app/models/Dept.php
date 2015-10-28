<?php

class Dept extends \Eloquent {
    protected $fillable = [];

    protected $table = 'dept';

    protected $guarded = ['id'];

    public function course(){
        return $this->hasMany('Course', 'dept_id', 'id');
    }
    public function userInfo(){
        return $this->hasMany('UserInfo', 'dept_id', 'id');
    }
}