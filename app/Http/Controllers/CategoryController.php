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

    public function create()
    {
        return view('posts.categories.create');
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

    public function edit(Category $category)
    {
        return view('posts.categories.edit',compact('category'));
    }

    public function update(Category $category)
    {
        request()->validate([
            'name' => 'required'
        ]);

        $category->update([
            'name' => request('name'),
            'slug' => \Str::slug(request('name'))
        ]);

        session()->flash('success', 'Successfully added a category');
        return redirect(route('categories'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', 'Successfully deleted a category');
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
