<?php

namespace App\Http\Controllers;

use App\Models\Dataup;
use App\Models\Down;
use GuzzleHttp\Client;
// use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PRTGController extends Controller
{
    public function index(Request $request) {
        $host = $request->get('host');
        $sitename = $request->get('sitename');
        $event = $request->get('event');
        $timestamp = $request->get('timestamp');

        if($event=='Down'){
            $downData = [
                'ip_address'=>$host,
                'unit_name'=>$sitename,
                'down_time'=>$timestamp
            ];
            //insert to down table
            if(Down::create($downData)){
                $response = ['status'=>200, 'message'=>"Insert Down Table Success"];
            }else{
                $response = ['status'=>501, 'message'=>"Insert Down Table Fail"];
            }
        }else{
            //jika UP cari id ke table down ambil order dari last created desc
            $data = Down::where('ip_address', $host)->orderBy('created_at', 'desc')->get()->first();
            if($data){
                $down_id = $data->id;
                $dataUP = [
                    'down_id'=>$down_id,
                    'ip_address'=>$host,
                    'unit_name'=>$sitename,
                    'up_time'=>date('Y-m-d H:i:s')
                ];
                $modelUP = Dataup::create($dataUP);
                if($modelUP){
                    $response = ['status'=>200, 'message'=>"Insert UP Table Success"];
                }else{
                    $response = ['status'=>501, 'message'=>"Insert UP Table Fail"];
                }
            }else{
                $response = ['status'=>501, 'message'=>"Tryiing to insert UP without DOWN"];
            }
        }
        $downData = [
            'ip_address'=>$host,
            'unit_name'=>$sitename,
            'down_time'=>$timestamp
        ];
        Log::info('inputPRTG', $downData);
        echo json_encode($response);
    }
}
