<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use CrudTrait;
    protected $table = 'guests';

    protected $fillable = [
        'name','email','phone','address'
    ];
}
