<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeBook extends Model
{
    use HasFactory;
    protected $primaryKey = 'type_book_id';
    public $incrementing = false;

    public function Book()
    {
        return $this->hasOne(Book::class, 'type_book_id');
    }
    public static function generateID()
    {
        $dataDB = self::select('type_book_id')->latest()->first();
        $id = 'tb_0000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->type_book_id, 3);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('tb_%07s', $numericPart);
        }
        return $id;
    }

    protected $fillable = [
        'type_book_id',
        'name',
    ];
}
