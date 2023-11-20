<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Emp extends Model 
{
    use HasFactory;
    public static function generateID()
    {
        $dataDB = self::select('emp_id')->latest()->first();
        $id = 'pd_0000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->emp_id, 3);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('pd_%07s', $numericPart);
        }
        return $id;
    }
    protected $primaryKey = 'emp_id';
    public $incrementing = false;
    protected $fillable = [
        'emp_id',
        'username',
        'password',
        'f_name',
        'l_name',
        'gender',
        'birthday',
        'age',
        'id_card',
        'tel',
        'status',
        'address'
    ];

}
