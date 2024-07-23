<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Admin as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

}
