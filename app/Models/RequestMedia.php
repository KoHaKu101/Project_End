<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMedia extends Model
{
    use HasFactory;
protected $dateFormat = 'Y-m-d';
    protected $primaryKey = 'request_id';
    public $incrementing = false;
    public static function generateID()
    {
        $dataDB = self::select('request_id')->orderBy('request_id','DESC')->latest()->first();
        $id = 'req_000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->request_id, 4);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('req_%06s', $numericPart);
        }
        return $id;
    }
    public function Book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function TypeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'type_media_id');
    }
    public function Emp()
    {
        return $this->belongsTo(Emp::class, 'emp_id');
    }
    public function RequestUser()
    {
        return $this->belongsTo(RequestUser::class, 'requesters_id');
    }
    public function OrderMedia()
    {
        return $this->hasOne(OrderMedia::class, 'order_id');
    }
    protected $fillable = [
        'request_id',
        'emp_id',
        'type_media_id',
        'requesters_id',
        'book_id',
        'request_date',
        'status',
        'desc',
        'cancel_desc',
        'media_out_date'
    ];
}
