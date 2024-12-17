<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistorysController extends Controller
{
    public function index(){
        return view('stories.read');
    }
}
