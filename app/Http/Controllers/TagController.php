<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('posts.tags.index', [
            'tags' => Tag::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('posts.tags.create');
    }

    public function store()
    {
        request()->validate([
            'name' => 'required'
        ]);

        Tag::create([
            'name' => request('name'),
            'slug' => \Str::slug(request('name'))
        ]);

        session()->flash('success','Successfully added a tag');
        return back();
    }

    public function edit(Tag $tag)
    {
        return view('posts.tags.edit', compact('tag'));
    }

    public function update(Tag $tag)
    {
        request()->validate([
            'name' => 'required'
        ]);

        $tag->update([
            'name' => request('name'),
            'slug' => \Str::slug(request('name'))
        ]);

        session()->flash('success','Successfully updated a tag');
        return redirect(route('tags'));
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('success', 'Successfully deleted a tag');
        return back();
    }
}
