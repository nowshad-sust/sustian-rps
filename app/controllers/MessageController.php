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

    public function showMessageToForm($receiver_id){
      try{
          if($receiver_id!=null){
            $receiver = User::find($receiver_id);
            if($receiver != null){

              return View::make('message.messageToForm')->with('title','Send Message')
                                                      ->with('receiver',$receiver);
            }else{
              throw new Exception();

            }
          }
      }catch(Exception $ex){
        return Redirect::back()->with('error','could not show the message form!');
      }

    }
    public function postMessageTo(){
      $rules =[
          'subject'  =>  'required',
          'message'  =>  'required'

      ];
      $data = Input::all();

      $validation = Validator::make($data,$rules);

      if($validation->fails()){
          return Redirect::back()->withErrors($validation)->withInput();
      }else{
          $message = new Message();
          $message->sender_id =   Auth::user()->id;
          $message->receiver_id = $data['receiver_id'];//to admin for primary use only
          $message->seen_status = false;
          $message->subject = $data['subject'];
          $message->message = $data['message'];
          if($message->save()){
              return Redirect::route('seeAllMessages')->with(['success'=>'Message Sent']);
          }else{
              return Redirect::back()->with(['error'=>'error sending message']);
          }
      }
    }

    public function ViewNewMessage($thread_id){
        $user_id = Auth::user()->id;
        $currentThread = Thread::where('id',$thread_id)
                              ->with('owner1')
                              ->with('owner2')
                              ->with('Message')
                              ->first();
        if($currentThread->owner1_id != $user_id && $currentThread->owner2_id != $user_id)
          return 'you do not have right to see the message thread';

        $threads = Thread::where('owner1_id',$user_id)
                ->orWhere('owner2_id',$user_id)
                ->with('owner1')
                ->with('owner2')
                //->with('Message')
                ->get();

      $messages = $currentThread->message->sortBYDESC('created_at');
      //return $messages;
      if($currentThread->owner1_id == $user_id){
        $otherUserInfo = $currentThread->owner2;
        $userInfo = $currentThread->owner1;
      }
      elseif($currentThread->owner2_id == $user_id){
        $otherUserInfo = $currentThread->owner1;
        $userInfo = $currentThread->owner2;
      }


      return View::make('message.messages')->with('title','Message Box')
                                            ->with('threads',$threads)
                                            ->with('currentThread',$currentThread)
                                            ->with('userInfo',$userInfo)
                                            ->with('otherUserInfo',$otherUserInfo)
                                            ->with('messages',$messages);
    } 

    public function showNewMessages(){

      $user_id = Auth::user()->id;
      $thread = Thread::where('owner1_id',$user_id)
                ->orWhere('owner2_id',$user_id)
                ->with('owner1')
                ->with('owner2')
                ->with('Message')
                ->get();

      //return $thread;
      return View::make('message.messages')->with('title','Message Box')
                                            ->with('threads',$thread);
    }

    public function showMessageForm(){
        return View::make('message.messageForm')->with(['title'=>'Send Message']);
    }

    /**
     * validate the post data
     * send message to the admin or user
     *
     */
    public function postNewMessage($thread_id){
        $rules =[
            'message'  =>  'required'

        ];

        $data = Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
          $user_id = Auth::user()->id;

          $thread = Thread::find($thread_id);
                                
          if($thread->owner1_id == $user_id)
            $receiver_id = $thread->owner2_id;
          elseif($thread->owner2_id == $user_id)
            $receiver_id = $thread->owner1_id;
          else
              return 'you do not have right to see the message thread';


            $message = new Message();
            $message->sender_id =   $user_id;
            $message->receiver_id = $receiver_id;
            $message->seen_status = false;
            $message->subject = 'message';
            $message->message = $data['message'];
            $message->thread_id = $thread_id;

            if($message->save()){
                return Redirect::route('messages.view',$thread->id)->with(['success'=>'Message Sent']);
            }else{
                return Redirect::back()->with(['error'=>'error sending message']);
            }
        }
    }

    public function sendMessage(){
        $rules =[
            'subject'  =>  'required',
            'message'  =>  'required'

        ];
        $data = Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
            $message = new Message();
            $message->sender_id =   Auth::user()->id;
            $message->receiver_id = 1;//to admin for primary use only
            $message->seen_status = false;
            $message->subject = $data['subject'];
            $message->message = $data['message'];
            if($message->save()){
                return Redirect::route('dashboard')->with(['success'=>'Message Sent']);
            }else{
                return Redirect::back()->with(['error'=>'error sending message']);
            }
        }
    }

    public function messageDetails($message_id = null){
        try{
            if($message_id != null){
                if($message = Message::find($message_id)){
                    //update seen_status
                    if($message->update([
                        'seen_status' => true
                    ])){
                        $senderInfo = User::find($message->sender_id);
                        return View::make('message.messageDetails')->with([
                            'title'             =>  'Message',
                            'messageDetails'    =>  $message,
                            'senderInfo'        => $senderInfo
                        ]);
                    }else{
                        return 'message could not be opened';
                    }

                }else{
                    return 'message not found';
                }
            }
        }catch (Exception $ex){

        }
    }

    public function seeAllMessages(){
        try{
            $user = Auth::user();
            $received_messages = Message::where('receiver_id',$user->id)
                                        ->with('sender')
                                        ->get();

            return View::make('message.allMessages')->with([
                'title' =>  'All Messages',
                'messages' => $received_messages
            ]);

        }catch (Exception $ex){

        }
    }

    public function replyMessage($message_id){
        try{
            $user = Auth::user();
            $received_message = Message::where('id',$message_id)
                ->where('receiver_id',$user->id)
                ->with('sender')
                ->first();

            $senderInfo = $received_message->sender;

            return View::make('message.replyMessage')->with([
                'title' =>  'Reply',
                'messageDetails' => $received_message,
                'senderInfo'    =>  $senderInfo
            ]);

        }catch (Exception $ex){

        }
    }

    public function postReply(){
        $rules =[
            'subject'  =>  'required',
            'message'  =>  'required',
            'to'       =>  'required'

        ];
        $data = Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
            $message = new Message();
            $message->sender_id =   Auth::user()->id;
            $message->receiver_id = $data['to'];//to user for primary use only
            $message->seen_status = false;
            $message->subject = $data['subject'];
            $message->message = $data['message'];
            if($message->save()){
                return Redirect::route('dashboard')->with(['success'=>'Message Sent']);
            }else{
                return Redirect::back()->with(['error'=>'error sending']);
            }
        }
    }

}
