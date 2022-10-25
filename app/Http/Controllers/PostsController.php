<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //

        $input = $request->all();

        if($file = $request->file('fileUpload')){
            
            $name = $file->getClientOriginalName();

            $file->move('images', $name);

            $input['path'] = $name;
            Post::create($input);
            return redirect('/posts');

        }

        // $this->validate($request, [
        //     'title' => 'required|max:4',
        //     'content' => 'required'
        // ]);
        // Post::create($request->all());

        // return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
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
        //
        $post = Post::findOrFail($id);

        $post->update($request->all());
        
        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        $post->delete();
        
        return redirect('posts');
    }

    public function contact() {
        $people = [];
        $people = ['Abdulsamad', 'Mohammed', 'Mohumed', 'Gade'];
        return view('contact', compact('people'));
    }

    public function post(){
        return view('post');
    }

    public function show_post($id, $name){
        // return view('post')->with('id', $id);
        return view('post', compact('id', 'name'));
    }

    public function user_details($username, $password){
        // return view('user')->with(['username' => $username, 'password' => $password]);
        return view('user', compact('username', 'password'));
    }
}