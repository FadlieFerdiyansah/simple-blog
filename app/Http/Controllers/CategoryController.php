<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        return view('posts.categories.index', [
            'categories' => Category::latest()->paginate(10)
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => request('name'),
            'slug' => \Str::slug(request('name'))
        ]);

        session()->flash('success', 'Successfully added a category');
        return back();
    }

    public function show(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(8);
        return view('posts.index', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
}
