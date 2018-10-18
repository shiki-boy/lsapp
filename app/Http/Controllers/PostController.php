<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Post;
use App\Like;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PostController extends Controller
{

    public function gotoDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function likePost(Request $request)
    {
        // TODO : find like, create new like, fill the fields, add number of likes

            $post = Post::find($request['postId']);
            $user = Auth::user();
            $user_id = $user->id;
            
            // ** find liked post
            $like = $user->likes()->where('post_id',$post->id)->first();
            if($like){
                // ? : if liked by the user already
                // todo : unlike it
                if($like->is_liked){
                    $like->delete();
                    return response()->json(['msg'=>'success unliked'], 200);
                }

            }
            else{
                // ? if post is not liked 
                $like = new Like();
                $like->post_id = $post->id;
                $like->user_id = $user->id;
                $like->is_liked = 1;
                $like->save();
                return response()->json(['msg' => 'success liked'], 200);
            }
        }
        
    

    public function createPost(Request $request)
    {
        $post = new Post();
        $post->body = $request['body'];
        // ? get the current user and save the relation post
        if ($request->user()->posts()->save($post)) {
            return redirect()->route('dashboard');
        }
    }

    public function deletePost($post_id)
    {
        if (Auth::user() != $post->user) { // ? protecting route from other users
            return redirect()->back();
        }
        $post = Post::where('id', $post_id)->first();
        $post->delete();
        return redirect('dashboard');
    }

    public function editPost(Request $request)
    {
        $post = Post::find($request['postId']);
        $post->body = $request['body'];
        $post->update();
        return response()->json(['message' => 'post edited'], 200);
    }
}
