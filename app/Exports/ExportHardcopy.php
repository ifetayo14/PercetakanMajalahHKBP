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

    class ExportHardcopy implements FromQuery, ShouldAutoSize, WithHeadings, WithStyles {

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
                return DB::table('orders')
                    ->join('user', 'orders.user_id', '=', 'user.user_id')
                    ->join('producthardcopy', 'orders.producthardcopy_id', '=', 'producthardcopy.producthardcopy_id')
                    ->select(DB::raw(
                        'user.nama,
                        qty,
                        price,
                        qty*price,
                        MONTH(orders.order_date),
                        YEAR(orders.order_date),
                        orders.ship_address,
                        orders.status,
                        producthardcopy.stok'
                    ))
                    ->where(DB::raw('YEAR(order_date)'), $this->year)
                    ->where('orders.status', '!=', 'Menunggu Pembayaran')
                    ->orderBy('orders.order_date');
            }else{
                return DB::table('orders')
                    ->join('user', 'orders.user_id', '=', 'user.user_id')
                    ->join('producthardcopy', 'orders.producthardcopy_id', '=', 'producthardcopy.producthardcopy_id')
                    ->select(DB::raw(
                        'user.nama,
                        qty,
                        price,
                        qty*price,
                        MONTH(orders.order_date),
                        YEAR(orders.order_date),
                        orders.ship_address,
                        orders.status,
                        producthardcopy.stok'
                    ))
                    ->where(DB::raw('MONTH(orders.order_date)'), $this->month)
                    ->where(DB::raw('YEAR(order_date)'), $this->year)
                    ->where('orders.status', '!=', 'Menunggu Pembayaran')
                    ->orderBy('orders.order_date');
            }

        }

        public function headings(): array
        {
            return [
                'Nama',
                'Quantity',
                'Price',
                'Total Pembelian',
                'Bulan',
                'Tahun',
                'Alamat',
                'Status',
                'Stok'
            ];
        }

        public function styles(Worksheet $sheet)
        {
            return[
                1 => ['font' => ['bold' => true], ['size' => 12]]
            ];
        }
    }
