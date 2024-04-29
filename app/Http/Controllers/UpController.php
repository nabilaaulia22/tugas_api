<?php

namespace App\Http\Controllers;

use App\Models\Dataup;
// use App\Models\Up;
use Illuminate\Http\Request;

class UpController extends Controller
{
    public function index()
    {
        $data = Dataup::all();
        return view('submenu.up', compact(['data']));
    }
}
