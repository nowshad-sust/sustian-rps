<?php

class Course extends \Eloquent {
    protected $fillable = [];

    protected $table = 'courses';

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('User','user_id','id');
    }

    public function result(){
        return $this->hasMany('Result', 'course_id', 'id');
    }

    public function dept(){
        return $this->belongsTo('Dept','dept_id','id');
    }

    public function batch(){
        return $this->belongsTo('Batch','batch_id','id');
    }



}