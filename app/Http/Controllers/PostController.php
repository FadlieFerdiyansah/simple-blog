<?php

namespace App\Http\Controllers;

use App\Models\{Tag, Post, Comment, Category};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\{Auth, Storage};

class PostController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->query;
        return view('posts.index', [
            'posts' => Post::where("title", "like" , "%$query%")->latest()->paginate(10),
            'result' => Post::where("title", "like" , "%$query%")->latest()->paginate(10)
        ]);
    }

    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->paginate(8),
        ]);
    }

    public function show(Post $post)
    {
        $related = Post::where('category_id', $post->category_id)->limit(6)->get();
        $comment = Comment::where('post_id', $post->id)->get();

        return view('posts.show', [
            'post' => $post,
            'related' => $related,
            'comments' => $comment
        ]);
    }

    public function create()
    {

        return view('posts.create',[
            'tags' => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    public function store(PostRequest $request)
    {
        $image = $request->file('image')->store('images/posts');

       $post = Auth::user()->posts()->create([
           'image' => $image,
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'body' => request('body'),
            'category_id' => request('category'),
        ]);
        $post->tags()->attach(request('tags'));

        session()->flash('success','Successfully added a post');

        return back();
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'tags' => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    public function update(Post $post)
    {
        if(request('image')){
            Storage::delete($post->image);
            $image = request()->file('image')->store('images/posts');
        }else{
            $image = $post->image;
        }

        $post->update([
            'image' => $image,
            'title' => request('title'),
            'body' => request('body'),
            'category_id' => request('category')
        ]);

        $post->tags()->sync(request('tags'));
        session()->flash('success', 'Successfully to updated the post');
        return redirect()->route('posts.edit',$post->slug);
    }

    public function destroy(Post $post)
    {
        Storage::delete($post->image);
        $post->delete();

        session()->flash('success','Successfully to deleted the post');
        return redirect()->route('posts');
    }
}
