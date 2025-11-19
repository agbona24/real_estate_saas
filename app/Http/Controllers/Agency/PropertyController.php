<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display properties listing.
     */
    public function index()
    {
        return view('agency.properties.index');
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        return view('agency.properties.create');
    }

    /**
     * Display categories.
     */
    public function categories()
    {
        return view('agency.properties.categories');
    }
}
