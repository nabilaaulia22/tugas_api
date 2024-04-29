<?php

namespace App\Http\Controllers;


use App\Models\Dataunit;
use App\Models\Dataup;
use App\Models\Down;
use Illuminate\Http\Request;

class Ip_unitController extends Controller
{
    public function ip_unit(Request $request)
    {
        $data = Dataunit::select('Dataunit.ip_unit')->get();
        $PRTG = new PRTGController();
        foreach ($data as $key) {
            $ip = $key['ip_unit'];
            // echo $ip;
            $dt = $PRTG->checkOmbak($ip);
            $statusAPI = isset($dt[0]['status']) ? $dt[0]['status'] : null;
            $statusDB = $this->statusIP($ip);
            //compare status db dengan status API

            if ($statusAPI != $statusDB && $statusAPI = null) {
                if ($statusAPI == 'Down') {
                    // insert to table down
                    $dataDown = [
                        'sid' => 'required',
                        'ip_address' => 'required',
                        'unit_name' => 'required',
                        'down_time' => 'required',
                    ];
                    Down::create([
                        'sid' => $request->sid,
                        'ip_address' => $request->ip_address,
                        'unit_name' => $request->unit_name,
                        'down_time' => $request->down_time,
                    ]);
                }
                if ($statusAPI == 'Up') {
                    //insert to table up
                    $dataUp = [
                        'down_id' => 'required',
                        'sid' => 'required',
                        'ip_address' => 'required',
                        'unit_name' => 'required',
                        'up_time' => 'required',
                    ];
                    Dataup::create([
                        'down_id' => $request->down_id,
                        'sid' => $request->sid,
                        'ip_address' => $request->ip_address,
                        'unit_name' => $request->unit_name,
                        'up_time' => $request->up_time,
                    ]);
                }
            } else {
                echo "Do Nothing";
            }
        }
        //echo json_encode($status);
        //$test = $this->statusIP();
        //print_r($test);
    }

    public function statusIP($ip_address)
    {
        //get down
        $Down = Down::where('ip_address', $ip_address)->get()->last();
        if (isset($Down->ip_address)) {
            $down_id = $Down->id;
            //find in up table
            $up = Dataup::find($down_id);
            if ($up) {
                $status = "Up";
            } else {
                $status = "Down";
            }
        } else {
            $status = "Up";
        };
        return $status;
    }
}
