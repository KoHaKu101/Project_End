<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMedia extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    public $incrementing = false;

    public static function generateID()
    {
        $dataDB = self::select('order_id')->latest()->first();
        $id = 'or_0000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->order_id, 3);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('or_%07s', $numericPart);
        }
        return $id;
    }
    public function Emp()
    {
        return $this->belongsTo(Emp::class, 'emp_id');
    }
    public function RequestMedia()
    {
        return $this->belongsTo(RequestMedia::class, 'request_id');
    }

    protected $fillable = [
        'order_id',
        'emp_id',
        'request_id',
        'order_date',
        'end_date',
        'status',
    ];






}
