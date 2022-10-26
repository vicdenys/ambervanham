<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $categories = Category::get();

        return view('categories')->with(['categories' => $categories]);
    }

    /**
     * Handle an incoming File upload.
     *
     * @param  \App\Http\Requests $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Create new file model
        $category = new Category();

        $category->title = $request->input('categoryTitle');

        $category->save();

        return redirect('/categories');
    }

    /**
     * make a menu file active.
     *
     * @return \Illuminate\View\View
     */
    public function update(Request $request)
    {

        // Create new file model
        $category = Category::findOrFail($request->input('categoryId'));


        $category->title = $request->input('categoryTitle');

        $category->save();

        return redirect('/categories');
    }

    /**
     * Remove a menu Catgegory.
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->files()->detach($id);

        $category->delete();



        return redirect('/categories');
    }
}
