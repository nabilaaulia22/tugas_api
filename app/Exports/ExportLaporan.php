<?php

namespace App\Exports;

use App\Models\Down;
use App\Models\Laporan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Collection;

class ExportLaporan implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Memeriksa apakah ada data yang telah difilter
        if ($this->data->isNotEmpty()) {
            return $this->data->map(function ($item, $key) {
                return [
                    'NO' => $key + 1,
                    'IP ADDRESS' => $item->ip_address,
                    'UNIT NAME' => $item->unit_name,
                    'DOWN TIME' => Carbon::parse($item->down_time)->format('Y-m-d H:i:s'),
                    'UP TIME' => Carbon::parse($item->up_time)->format('Y-m-d H:i:s'),
                    'DURATION' => $item->duration
                ];
            });
        } else {
            // Jika data kosong, kembalikan koleksi kosong
            return collect();
        }
    }


    public function headings(): array
    {
        return [
            'NO',
            'IP ADDRESS',
            'UNIT NAME',
            'DOWN TIME',
            'UP TIME',
            'DURATION'
        ];
    }
}

