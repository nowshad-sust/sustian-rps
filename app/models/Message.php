<?php

class Message extends \Eloquent {
    protected $fillable = [];

    protected $table = 'message';

    protected $guarded = ['id'];

    public function sender(){
        return $this->belongsTo('User','sender_id','id');
    }

    public function receiver(){
        return $this->belongsTo('User','receiver_id','id');
    }

    public function thread(){
        return $this->belongsTo('Thread','thread_id','id');
    }

}
