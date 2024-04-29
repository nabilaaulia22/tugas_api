<?php

namespace App\Http\Controllers;

use App\Exports\ExportLaporan;
use App\Models\Down;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function laporan()
    {
        // Set isFiltered menjadi false karena halaman laporan awal tidak memiliki filter
        $isFiltered = false;

        $logGangguan = Down::join('UP', 'down.id', '=', 'up.down_id')
            ->select('down.*', 'up.id', 'up.up_time')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($logGangguan as $data) {
            $downTime = Carbon::parse($data->down_time);
            $upTime = Carbon::parse($data->up_time);
            $duration = $upTime->diff($downTime);

            $durationString = '';
            if ($duration->d > 0) {
                $durationString .= $duration->d . ' hari ';
            }
            $durationString .= $duration->format('%H:%I:%S');

            $data->duration = $durationString;
        }

        return view('monitoringlog.laporan', compact('logGangguan', 'isFiltered'));
    }

    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $unitName = $request->input('unit');

        $query = Down::join('UP', 'down.id', '=', 'up.down_id')
            ->whereBetween('down.down_time', [$startDate, $endDate])
            ->orWhereBetween('up.up_time', [$startDate, $endDate])
            ->orderBy('down.id', 'desc');

        if ($unitName) {
            $query->where('down.unit_name', $unitName);
        }

        $logGangguan = $query->paginate(100);

        session(['logGangguan' => $logGangguan]);

        foreach ($logGangguan as $data) {
            $downTime = Carbon::parse($data->down_time);
            $upTime = Carbon::parse($data->up_time);
            $duration = $upTime->diff($downTime);

            $durationString = '';
            if ($duration->d > 0) {
                $durationString .= $duration->d . ' hari ';
            }
            $durationString .= $duration->format('%H:%I:%S');

            $data->duration = $durationString;
        }

        // Set isFiltered menjadi true karena filter telah diterapkan
        $isFiltered = true;

        return view('monitoringlog.laporan', compact('logGangguan', 'isFiltered'));
    }

    public function export_excel(Request $request)
    {
        // Periksa apakah ada data filter dalam sesi
        if ($request->session()->has('logGangguan')) {
            // Ambil data filter dari sesi
            $logGangguan = $request->session()->get('logGangguan');
        } else {
            // Jika tidak ada filter, ambil semua data
            $logGangguan = Down::join('UP', 'down.id', '=', 'up.down_id')->get();
        }

        // Panggil fungsi download dari kelas Excel dengan instance ExportLaporan
        return Excel::download(new ExportLaporan($logGangguan), 'laporan.xlsx');
    }
}
