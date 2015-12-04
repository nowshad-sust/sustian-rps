<?php

class Thread extends \Eloquent {
    protected $fillable = [];

    protected $table = 'thread';

    protected $guarded = ['id'];

    public function message(){
        return $this->hasMany('Message', 'thread_id', 'id');
    }

    public function owner1(){
        return $this->belongsTo('User','owner1_id','id');
    }
    public function owner2(){
        return $this->belongsTo('User','owner2_id','id');
    }

}
