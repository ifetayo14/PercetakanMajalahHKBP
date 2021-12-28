<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportSoftcopy implements FromQuery, ShouldAutoSize, WithHeadings, WithStyles {

    use Exportable;

    public function getParam(int $month, int $year)
    {
        $this->month = $month;
        $this->year = $year;

        return $this;
    }

    public function query()
    {
        if ($this->month == 13){
            return DB::table('member')
                ->join('user', 'member.user_id', '=', 'user.user_id')
                ->select(DB::raw(
                    'user.nama,
                    COUNT(*),
                    MONTH(member.active_date),
                    YEAR(member.active_date)'
                ))
                ->where(DB::raw('YEAR(active_date)'), $this->year)
                ->where('member.status', '=', '1')
                ->groupBy('member.user_id')
                ->orderBy('member.user_id');
        }else{
            return DB::table('member')
                ->join('user', 'member.user_id', '=', 'user.user_id')
                ->select(DB::raw(
                    'user.nama,
                    COUNT(*),
                    MONTH(member.active_date),
                    YEAR(member.active_date)'
                ))
                ->where(DB::raw('MONTH(active_date)'), $this->month)
                ->where(DB::raw('YEAR(active_date)'), $this->year)
                ->where('member.status', '=', '1')
                ->groupBy('member.user_id')
                ->orderBy('member.user_id');
        }

    }

    public function headings(): array
    {
        return [
            'Nama',
            'Jumlah Pembelian',
            'Bulan',
            'Tahun'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return[
            1 => ['font' => ['bold' => true], ['size' => 12]]
        ];
    }
}
