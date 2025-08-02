<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

 protected function authorizeCategory(Category $category)
{
// if($category -> user_id !== Auth::id())
// {
//     abort(403,'Unauthorized Action');
// }

}
    // display all categories related to user 
    public function index()
    {
        $categories=Category::where('user_id',Auth::id())->get();
        return view('categories.index',compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    // new category
    public function store(StoreCategoryRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        // ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->user_id = Auth::id();
        $category->save();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(Category $category)
    {
    
        // if ($category->user_id !== auth()->id()) {
        //     abort(403);
        // }

        return view('categories.edit', compact('category'));
    }

    
    public function update(UpdateCategoryRequest $request,Category $category)
    {
        // if ($category->user_id !== auth()->id()) {
        //     abort(403);
        // }

        // $request->validate([
        //     'name' => 'required|string|max:255',
        // ]);

        $category->name = $request->input('name');
        $category->save();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }


    public function destroy(Category $category)
    {
        // if ($category->user_id !== auth()->id()) {
        //     abort(403);
        // }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }

}
