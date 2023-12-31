<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyBook extends Model
{
    use HasFactory;
    public static function generateID()
    {
        $dataDB = self::select('copy_id')->latest()->first();
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
