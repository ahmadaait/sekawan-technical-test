<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'mine_id',
        'start_date',
        'return_date',
        'req_pic_1',
        'approval_pic_1',
        'approval_pic_1_at',
        'req_pic_2',
        'approval_pic_2',
        'approval_pic_2_at',
        'rejected_by',
        'rejected_at',
        'canceled_by',
        'canceled_at',
        'created_by',
        'release_at',
        'return_at',
        'status'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function mine()
    {
        return $this->belongsTo(Mine::class);
    }

    public function approval_pic_1()
    {
        return $this->belongsTo(User::class, 'approval_pic_1');
    }

    public function approval_pic_2()
    {
        return $this->belongsTo(User::class, 'approval_pic_2');
    }

    public function rejected_by()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function canceled_by()
    {
        return $this->belongsTo(User::class, 'canceled_by');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
