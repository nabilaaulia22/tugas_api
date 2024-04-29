<?php

namespace App\Http\Controllers;

use App\Models\Dataunit;
use App\Models\Dataup;
use App\Models\Down;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan data down dari database
        $downData = Down::all();

        // Menghitung jumlah data down setiap bulan
        $downCounts = DB::table('down')
            ->select(DB::raw('MONTH(down_time) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(down_time)'))
            ->get();

        // Menyiapkan data bulan
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        // Menyusun ulang data agar sesuai dengan urutan bulan
        $downCountsByMonth = [];
        foreach ($months as $key => $month) {
            $downCountsByMonth[$key] = 0;
            foreach ($downCounts as $downCount) {
                if ($downCount->month == ($key + 1)) {
                    $downCountsByMonth[$key] = $downCount->count;
                    break;
                }
            }
        }

        // Menghitung total downtime
        $totalDowntime = Down::whereDoesntHave('up')->count();

        // Mengambil top 5 data yang sering mengalami down
        $topDownData = DB::table('down')
            ->select('unit_name', DB::raw('COUNT(*) as count'))
            ->groupBy('unit_name')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        // Menghitung data up
        $totalUpData = Dataup::count();

        $jumlahRayon = Dataunit::count();

        // Mengambil jumlah data area dari tabel unit data
        $jumlahArea = Dataunit::where('UNIT_NAME', 'LIKE', 'AREA%')->count();

        // Mendapatkan data down per tahun
        $downCountsByYear = $this->getDownCountsByYear();
        return view('monitoringlog.dashboard', compact('downCountsByMonth', 'months', 'totalDowntime', 'totalUpData', 'topDownData', 'jumlahRayon', 'jumlahArea'));
    }

    public function getDownCountsByYear()
    {
        // Mendapatkan data down untuk tahun ini
        $currentYear = Carbon::now()->year;
        $downCounts = Down::select(DB::raw('MONTH(down_time) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('down_time', $currentYear)
            ->groupBy(DB::raw('MONTH(down_time)'))
            ->get();

        $downCountsByMonth = [];
        foreach ($downCounts as $downCount) {
            $downCountsByMonth[$downCount->month - 1] = $downCount->count;
        }

        return $downCountsByMonth;
    }

    public function getTopDownData()
    {
        // Mendapatkan bulan dan tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $topDownData = DB::table('down')
            ->select('unit_name', DB::raw('COUNT(*) as count'))
            ->whereMonth('down_time', $currentMonth)
            ->whereYear('down_time', $currentYear)
            ->groupBy('unit_name')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        return response()->json($topDownData);
    }

    public function updateTopDownData()
{
    // Mendapatkan bulan dan tahun saat ini
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    // Mengambil top 5 data down untuk bulan dan tahun saat ini
    $topDownData = DB::table('down')
        ->select('unit_name', DB::raw('COUNT(*) as count'))
        ->whereMonth('down_time', $currentMonth)
        ->whereYear('down_time', $currentYear)
        ->groupBy('unit_name')
        ->orderByDesc('count')
        ->limit(5)
        ->get();

    // Simpan data ke dalam file atau cache
    // Misalnya:
    file_put_contents(storage_path('app/top_down_data.json'), json_encode($topDownData));

    return response()->json($topDownData);
}

public function down_current()
{
    // Query untuk mengambil data down yang sedang aktif
    $currentDownData = Down::doesntHave('up')->get();

    // Kirim data down yang sedang aktif ke tampilan
    return view('monitoringlog.current_down', compact('currentDownData'));
}


}
