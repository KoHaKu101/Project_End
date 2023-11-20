<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMedia extends Model
{
    use HasFactory;

    protected $primaryKey = 'type_media_id';
    public $incrementing = false;

    public static function generateID()
    {
        $dataDB = self::select('type_media_id')->latest()->first();
        $id = 'tm_0000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->type_media_id, 3);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('tm_%07s', $numericPart);
        }
        return $id;
    }

    protected $fillable = [
        'type_media_id',
        'name',
        'desc',
    ];
}
