<?php

class Posts extends \Eloquent {
    protected $fillable = [];

    protected $table = 'posts';

    protected $guarded = ['id'];

    public function post_user(){
        return $this->belongsTo('User','post_user_id','id');
    }

}
