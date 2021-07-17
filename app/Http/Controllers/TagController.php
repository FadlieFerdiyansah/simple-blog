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
}
