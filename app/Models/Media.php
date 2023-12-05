<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $primaryKey = 'media_id';
    public $incrementing = false;

    public static function generateID()
    {
        $dataDB = self::select('media_id')->latest()->first();
        $id = 'md_0000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->media_id, 3);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('md_%07s', $numericPart);
        }
        return $id;
    }
    public static function generateNumber($book_id,$type_media_id)
    {
        $dataDB = self::select('number','type_media_id')->where('type_media_id',$type_media_id)->latest()->first();
        $number = '1';
        if (!is_null($dataDB)) {
            $number = $dataDB->number + 1;;
        }
        return $number;
    }
    public function Book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function TypeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'type_media_id');
    }
    protected $fillable = [
        'media_id',
        'book_id',
        'type_media_id',
        'number',
        'amount_end',
        'braille_page',
        'status',
        'check_date',
        'translator',
        'sound_sys',
        'file_location',
        'source'
    ];
    
}
