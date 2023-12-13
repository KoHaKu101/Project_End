<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestUser extends Model
{
    use HasFactory;
    protected $primaryKey = 'requesters_id';
    public $incrementing = false;
    public static function generateID()
    {
        $dataDB = self::select('requesters_id')->latest()->first();
        $id = 'user_00001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->requesters_id, 5);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('user_%05s', $numericPart);
        }
        return $id;
    }

    protected $fillable = [
        'requesters_id',
        'f_name',
        'l_name',
        'gender',
        'birthday',
        'age',
        'id_card',
        'tel',
    ];
}
