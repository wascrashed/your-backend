<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return ['posts' => $posts];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'language' => 'required',
            'publication_type' => 'required',
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'heading' => 'required',
            'tags' => 'required',
            'site_location' => 'required',
            'link' => 'required',
            'content' => 'required',
            'author_comment' => 'required',
            'user_id' => 'required'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $posts = Post::create($data);
        return ['post' => $posts];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return ['post' => $post];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this-> validate($request, [
            'language' => 'string',
            'publication_type' => 'string',
            'image' => 'string',
            'title' => 'string',
            'description' => 'string',
            'heading' => 'string',
            'tags' => 'string',
            'site_location' => 'integer',
            'link' => 'string',
            'content' => 'string',
            'author_comment' => 'string',
            'user_id' => 'integer'
        ]);
        $post->update($request->all());
        return ['post' => $post];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return ['post' => $post];
    }
}
