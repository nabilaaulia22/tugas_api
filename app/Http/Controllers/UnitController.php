<?php

namespace App\Http\Controllers;

use App\Models\Dataunit;
use Illuminate\Http\Request;

class UnitController extends Controller
{



    public function view_unitdata()
    {
        $data = Dataunit::orderBy('created_at', 'desc')->get();

        // return $data;
        return view('monitoringlog.unitdata', compact('data'));
    }

    public function add()
    {

        // return $data;
        return view('monitoringlog.add');
    }

    public function insertdata(Request $request)
    {
        // dd($request->all());
        Dataunit::create([
            'id_unit' => $request->id_unit,
            'ip_unit' => $request->ip_unit,
            'unit_name' => $request->unit_name
        ]);

        return redirect('unitdata');
    }

    public function delete($id)
    {
        $data = Dataunit::find($id);
        $data->delete();
        return redirect()->route('unitdata')->with('succes', 'Data berhasil di Hapus');
    }

    public function tampilkandata($id)
    {
        $data = Dataunit::find($id);
        // dd($data);
        return view('monitoringlog.edit', compact('data'));

    }

    public function updatedata(Request $request, $id)
    {
        $data = Dataunit::find($id);
        $data->update($request->all());

        return redirect()->route('unitdata')->with('succes', 'Data berhasil di update');
    }
}


