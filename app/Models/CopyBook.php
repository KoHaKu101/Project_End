<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyBook extends Model
{
    use HasFactory;
    protected $dateFormat = 'Y-m-d';
    public static function generateID()
    {
        $dataDB = self::select('copy_id')->orderBy('copy_id','DESC')->first();
        $id = 'cb_0000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->copy_id, 3);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('cb_%07s', $numericPart);
        }
        return $id;
    }
    public function Book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    protected $primaryKey = 'copy_id';
    public $incrementing = false;
    protected $fillable = [
        'copy_id',
        'book_id',
        'amount',
    ];
}
