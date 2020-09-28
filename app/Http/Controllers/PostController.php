<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display all posts except private.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $posts = Post::query()->where('private', false)->latest()->simplePaginate(20);
        return Response(view('posts.index', compact('user', 'posts'))); //
    }

    /**
     * Display auth user posts including private
     * @return \Illuminate\Http\Response
     */
    public function indexUserPosts() {
        $user = auth()->user();
        $posts = $user->posts()->latest()->simplePaginate(20);
        return Response(view('posts.index', compact('user', 'posts')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Response(view('posts.create'));//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();
        auth()->user()->posts()->create($data);

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize($post);
        return Response(view('posts.show', compact('post')));//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Response(view('posts.edit', compact('post')));//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize($post);
        $data = $request->validated();
        if (!isset($data['private']))
            $data['private'] = false;
        $post->update($data);
        return redirect(route('posts.index'));//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $this->authorize($post);
        $post->delete();
        return redirect(route('posts.index'));
    }
}
