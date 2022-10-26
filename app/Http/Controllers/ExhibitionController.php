<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exhibition;
use App\Models\File;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
   /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $exhibitions = Exhibition::orderByDesc('start_date')->get();

        return view('exhibitions')->with(['exhibitions' => $exhibitions]);
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
        $exhibition = new exhibition();

        $exhibition->title = $request->input('exhibitionTitle');
        $exhibition->address = $request->input('exhibitionAddress');
        $exhibition->description = $request->input('exhibitionDescription');
        $exhibition->start_date = $request->input('exhibitionStartDate');
        $exhibition->end_date = $request->input('exhibitionEndDate');

        $exhibition->save();

        return redirect('/exhibitions');
    }

    /**
     * make a menu file active.
     *
     * @return \Illuminate\View\View
     */
    public function update(Request $request)
    {

        // Create new file model
        $exhibition = Exhibition::findOrFail($request->input('exhibitionId'));

        $exhibition->title = $request->input('exhibitionTitle');
        $exhibition->address = $request->input('exhibitionAddress');
        $exhibition->description = $request->input('exhibitionDescription');
        $exhibition->start_date = $request->input('exhibitionStartDate');
        $exhibition->end_date = $request->input('exhibitionEndDate');

        $exhibition->save();

        return redirect('/exhibitions');
    }

    /**
     * Remove a menu Catgegory.
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        
        $exhibtion = Exhibition::findOrFail($id);

        $exhibtion->delete();



        return redirect('/exhibitions');
    }
}
