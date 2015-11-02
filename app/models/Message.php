<?php

class Message extends \Eloquent {
    protected $fillable = [];

    protected $table = 'message';

    protected $guarded = ['id'];

    public function message(){
        return $this->belongsTo('User','sender_id','id');
    }

}
