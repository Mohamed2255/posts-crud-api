<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::get();
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:100',
            'body' => 'required|min:5',
        ]);
        if ($validator->fails()) {
            $mesg='Valid data';
        }
        else {
            $title=$request->title;
            $body=$request->body;
            $post=new Post();
            $post->title=$title;
            $post->body=$body;
            $post->save();
            $mesg='Added succesfully';
            
        }
        return response()->json($mesg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post= Post::select('id','title','body')->
        where('id','=',$post)->first();
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:100',
            'body' => 'required|min:5',
        ]);
        if ($validator->fails()) {
            $mesg='Update fails';
        }
        else {
            $title=$request->title;
            $body=$request->body;
            $post=Post::where('id','=',$post)->first();
            $post->title=$title;
            $post->body=$body;
            $post->save();
            $mesg='Updated succesfully';
            
        }
        return response()->json($mesg);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $post= Post::where('id','=',$post)->first();
        $post->delete();
        $msg="Post deleted";
        return response()->json($msg);
    }
}
