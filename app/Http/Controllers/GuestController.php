<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exhibition;
use App\Models\File;
use Illuminate\Http\Request;


class GuestController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $categories = Category::get();
        $exhibitions = Exhibition::get();
        $artworks = File::get();

        $pastExhibitions = [];
        $ongoingExhibitions = [];
        $futureExhibitions = [];

        foreach ($exhibitions as $exhibition) {

            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));

            $startDate = date('Y-m-d', strtotime($exhibition->start_date));
            $endDate = date('Y-m-d', strtotime($exhibition->end_date));

            if (($currentDate >= $startDate) && ($currentDate <= $endDate)) {
                array_push($ongoingExhibitions, $exhibition);
            } elseif ($currentDate <= $startDate) {
                array_push($futureExhibitions, $exhibition);
            } else {
                array_push($pastExhibitions, $exhibition);
            }
        }

        return view('welcome')->with(['categories' => $categories, 'artworks' => $artworks, 'ongoingExhibitions' => $ongoingExhibitions, 'futureExhibitions' => $futureExhibitions, 'pastExhibitions' => $pastExhibitions]);
    }
}
