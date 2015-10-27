<?php

class Result extends \Eloquent {
    protected $fillable = [];

    protected $table = 'results';

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('User','user_id','id');
    }
    public function course(){
        return $this->belongsTo('Course','course_id','id');
    }
}