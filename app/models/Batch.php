<?php

class Batch extends \Eloquent {
    protected $fillable = [];

    protected $table = 'batch';

    protected $guarded = ['id'];

    public function course(){
        return $this->hasMany('Course', 'batch_id', 'id');
    }

    public function userInfo(){
        return $this->hasMany('UserInfo', 'batch_id', 'id');
    }
}