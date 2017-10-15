<?php

namespace App\Http\Controllers;

use App\Record;

class PagesController extends Controller
{

    public function index()
    {
        return view('index',
            ['records' => Record::orderBy('pub_date', 'desc')->get()]);
    }
}
