<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use CrudTrait;
    protected $table = 'rooms';

    protected $fillable = [
        'room_number','type','price_per_night','status'
    ];
}
