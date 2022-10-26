<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\File as FileL;

class ArtworkUploadController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {



        return view('menu');
    }

    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $selectedCategory = null;

        if(array_key_exists('category', $request->input())){
            
            $requestFilter = $request->input('category');
            $files = File::whereHas('categories', function ($query) use ($requestFilter) {
                $query->where('category_id', $requestFilter);
            })->orderByDesc('created_at')->sortable()->get();

            $selectedCategory = Category::where('id', $request->input('category'))->first();
        }
        else{
            $files = File::orderByDesc('created_at')->sortable()->get();
        }

        
        $categories = Category::get();

        return view('dashboard')->with(['files' => $files, 'categories' => $categories, 'selectedCategory' => $selectedCategory]);
    }


    /**
     * Handle an incoming File upload.
     *
     * @param  \App\Http\Requests $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFileRequest $request,  MessageBag $message_bag)
    {
        // Create new file model
        $file = new File;

        $file->title = $request->input('artworkTitle');
        $file->description = $request->input('artworkDescription');

        $cats = [];
        foreach ($request->input() as $input  => $value) {
            if ("category-" == substr($input, 0, 9)) {
                $number = substr($input, strrpos($input, '-'));
            
                array_push($cats, substr($number, 1, 1));
            }
        }


        $file->save();

        $category = Category::find($cats);
        $file->categories()->attach($category);
        
        
        if ($request->file('artworkFile')) {
            $artworkFile = $request->file('artworkFile');
            $filename = $file->id . '.' . $artworkFile->extension();
            $file->image = $filename;
            $file->save();

            // File upload location
            $location = 'artwork-files';

            // Upload file
            $didFileMove = $artworkFile->move($location, $filename);

            if ($didFileMove) {

                return redirect('/dashboard')->withSuccess('File Uploaded');
            } else {
                return redirect('/dashboard')->withErrors('Could not upload file');
            }

            return redirect('/dashboard')->withSuccess('File Uploaded');
        } else {
            return redirect('/dashboard')->withErrors('Could not upload file');
        }
    }

    /**
     * Remove a menu file.
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        $file->delete();
       


        FileL::delete('artwork-files/' . $file->image);


        return redirect('/dashboard');
    }

    /**
     * make a menu file active.
     *
     * @return \Illuminate\View\View
     */
    public function update(Request $request)
    {
        

        // Create new file model
        $file = File::findOrFail($request->input('fileId'));

        $file->title = $request->input('artworkTitle');
        $file->description = $request->input('artworkDescription');

        $cats = [];
        foreach ($request->input() as $input  => $value) {
            if ("category-" == substr($input, 0, 9)) {
                $number = substr($input, strrpos($input, '-'));
            
                array_push($cats, substr($number, 1, 1));
            }
        }


        $file->save();

        // $category = Category::find($cats);

        // $attachedIds = $file->categories()->whereIn('category_id', $cats)->pluck('category_id');
        // $newIds = array_diff($cats, $attachedIds);
        $file->categories()->sync($cats);


        if ($request->file('artworkFile')) {
            $artworkFile = $request->file('artworkFile');
            $filename = $file->id . '.' . $artworkFile->extension();
            $file->image = $filename;
            $file->save();

            // File upload location
            $location = 'artwork-files';

            // Upload file
            $didFileMove = $artworkFile->move($location, $filename);

            if ($didFileMove) {

                return redirect('/dashboard')->withSuccess('File Uploaded');
            } else {
                return redirect('/dashboard')->withErrors('Could not upload file');
            }

            return redirect('/dashboard')->withSuccess('File Uploaded');
        } else {
            return redirect('/dashboard')->withErrors('Could not upload file');
        }




        return redirect('/dashboard');
    }
}
