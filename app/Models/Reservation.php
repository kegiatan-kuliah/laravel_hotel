<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use CrudTrait;
    protected $table = 'reservations';

    protected $fillable = [
        'guest_id','room_id','check_in_date','check_out_date','total_price','status'
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function export($crud = false)
    {
        return '<a class="btn btn-primary" target="_blank" href="'.route('reservation.export').'">Download PDF</a>';
    }
}

