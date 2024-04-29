<?php

namespace App\Http\Controllers;

use App\Models\Down;
use Illuminate\Http\Request;

class DownController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data down yang belum di-up
        $data = Down::leftJoin('up', 'up.down_id' , '=', 'down.id')
                    ->select('down.*')
                    ->where('up.id', null)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('submenu.down', compact('data'));
    }
}
