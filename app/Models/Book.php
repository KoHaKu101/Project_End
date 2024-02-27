<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $dateFormat = 'Y-m-d';
    protected $primaryKey = 'book_id';
    public $incrementing = false;

    public static function generateID()
    {

        $dataDB = self::select('book_id')->latest('book_id')->first();
        $number = '1';
        $id = 'bk_0000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->book_id, 3);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('bk_%07s', $numericPart);
        }
        return $id;
        // return $id;
    }
    public function TypeBook()
    {
        return $this->belongsTo(TypeBook::class, 'type_book_id');
    }
    public function CopyBook()
    {
        return $this->hasOne(CopyBook::class, 'book_id');
    }
    protected $fillable = [
        'book_id',
        'type_book_id',
        'name',
        'author',
        'publisher',
        'edition',
        'year',
        'original_page',
        'isbn',
        'level',
        'language',
        'abstract',
        'synopsis',
        'img_book',
        'updated_at'
    ];
}
