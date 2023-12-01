<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveBook extends Model
{
    use HasFactory;

    protected $primaryKey = 'recv_id';
    public $incrementing = false;

    public static function generateID()
    {
        $dataDB = self::select('recv_id')->latest()->first();
        $id = 'recv_00001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->recv_id, 5);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('recv_%05s', $numericPart);
        }
        return $id;
    }
    public function Emp()
    {
        return $this->belongsTo(Emp::class, 'emp_id');
    }
    protected $fillable = [
        'recv_id',
        'emp_id',
        'book_name',
        'add_date',
        'add_type',
        'desc',
    ];

}
