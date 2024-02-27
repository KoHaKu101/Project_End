<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveBookDesc extends Model
{
    use HasFactory;
protected $dateFormat = 'Y-m-d';
    protected $primaryKey = 'recd_id';
    public $incrementing = false;
    public static function generateID()
    {
        $dataDB = self::select('recd_id')->orderBy('recd_id','DESC')->latest()->first();
        $id = 'recd_00001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->recd_id, 5);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('recd_%05s', $numericPart);
        }
        return $id;
    }
    public function ReceiveBook()
    {
        return $this->belongsTo(ReceiveBook::class, 'recv_id');
    }
    public function Book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }


    protected $fillable = [
        'recd_id',
        'recv_id',
        'book_id',
        'desc',
    ];

}
