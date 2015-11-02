<?php

class MessageController extends \BaseController {

    /**
     * sent message to admin
     * data to send with
     *      :subject
     *      :message
     *      :user_id
     *      :to [for admin only]
     */
    public function showMessageForm(){
        return View::make('message.messageForm')->with(['title'=>'Send Message']);
    }

    /**
     * validate the post data
     * send message to the admin or user
     *
     */
    public function sendMessage(){
        return 'sent';
    }
}