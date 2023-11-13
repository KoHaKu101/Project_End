<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Emp extends Model 
{

    protected $fillable = [
        'emp_id',
        'username',
        'password',
        'f_name',
        'l_name',
        'gender',
        'national',
        'birthday',
        'age',
        'id_card',
        'tel',
        'status',
        'address'
    ];

}
