<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $orders = Order::with('mine', 'driver', 'vehicle', 'approval_pic_1', 'approval_pic_2', 'rejected_by', 'canceled_by', 'created_by')->whereBetween('created_at', [$this->startDate . " 00:00:00", $this->endDate . " 23:59:59"])->get();

        $arr =  [];
        $i = 0;
        $no = 1;
        foreach ($orders as $key => $value) {
            $arr[$i] = [
                $no++,
                $value->driver->name,
                $value->vehicle->name,
                $value->mine->name,
                $value->start_date . " s/d " . $value->return_date,
                is_object($value->approval_pic_1) ? $value->approval_pic_1->name : "-",
                $value->approval_pic_1_at,
                is_object($value->approval_pic_2) ? $value->approval_pic_2->name : "-",
                $value->apporval_pic_2_at,
                $value->release_at,
                $value->return_at,
                is_object($value->rejected_by) ? $value->rejected_by->name : '-',
                $value->rejected_at,
                is_object($value->created_by) ? $value->created_by->name : '-',
                is_object($value->canceled_by) ? $value->canceled_by->name : '-',
                $value->canceled_at,
                $value->status
            ];
            $i++;
        }

        return new Collection($arr);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Driver',
            'Kendaraan',
            'Tambang',
            'Tanggal Pinjam',
            'Disetujui PIC 1',
            'Tanggal Disetujui PIC 1',
            'Disetujui PIC 2',
            'Tanggal Disetujui PIC 2',
            'Tanggal Diambil',
            'Tanggal Kembali',
            'Ditolak Oleh',
            'Tanggal Ditolak',
            'Diajukan Oleh',
            'Dibatalkan Oleh',
            'Tanggal Dibatalkan',
            'Status'
        ];
    }
}
