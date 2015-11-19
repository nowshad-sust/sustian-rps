<?php

class PostController extends \BaseController {

    public function showAllPosts(){
        $user_batch = Auth::user()->userInfo->batch->batch;

        $latest_posts = Posts::where('batch',$user_batch)
            ->with('post_user')
            ->get();
        $latest_posts = $latest_posts->sortByDesc('created_at');

        return View::make('user.posts')->with('title', 'Posts')
                                        ->with('latest_posts', $latest_posts);
    }

    public function submitPost(){
        $rules =[
            'post_body'  =>  'required'
        ];

        $data = Input::all();

        $validation = Validator::make($data,$rules);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }else{
            $post = new Posts();
            $post->post_user_id = Auth::user()->id;
            $post->batch = Auth::user()->userInfo->batch->batch;
            $post->post_body = nl2br($data['post_body']);
            if($post->save()){
                return Redirect::route('posts')->with('success','Posted successfully');
            }else{
                return Redirect::back()->with(['error'=>'error posting!']);
            }
        }
    }

    public function deletePost($post_id){
        try{
            if($post_id != null){
                $post = Posts::find($post_id);
                if(Auth::user()->userInfo->batch->batch == $post->batch){
                    if($post->delete()){
                        return Redirect::back()->with('success', 'Post deleted successfully');
                    }else
                        return Redirect::back()->with('error', 'post deletion failed');
                }
            }
        }catch (Exception $ex){
            return Redirect::back()->with('error', 'post deletion failed');
        }
    }

    public function updatePost()
    {
        $rules = [
            'post_body' => 'required'
        ];

        $data = Input::all();

        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            return Redirect::back()->withErrors($validation);
        } else {
            try {
                if ($data['post_id'] != null) {
                    $post = Posts::find($data['post_id']);
                    if (Auth::user()->id == $post->post_user_id) {

                        $update = $post->update([
                            'post_body' => $data['post_body']
                        ]);
                        if ($update) {
                            return Redirect::route('posts')->with('success', 'Post updated successfully');
                        } else
                            return Redirect::back()->with('error', 'post update failed');
                    }
                }
            } catch (Exception $ex) {
                return Redirect::back()->with('error', 'post update failed');
            }
        }
    }
}