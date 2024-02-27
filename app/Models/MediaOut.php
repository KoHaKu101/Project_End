<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaOut extends Model
{
    use HasFactory;
protected $dateFormat = 'Y-m-d';
    protected $table =  'media_out';
    protected $primaryKey = 'md_out_id';
    public $incrementing = false;

    public function RequestMedia()
    {
        return $this->belongsTo(RequestMedia::class, 'request_id');
    }
    public static function generateID()
    {
        $dataDB = self::select('md_out_id')->orderBy('md_out_id','DESC')->latest()->first();
        $id = 'mo_0000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->md_out_id, 3);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('mo_%07s', $numericPart);
        }
        return $id;
    }
    protected $fillable = [
        'md_out_id',
        'request_id',
        'emp_id',
        'md_out_date',
        'status',
        'desc',
    ];






}
