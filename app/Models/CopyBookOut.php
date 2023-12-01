<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyBookOut extends Model
{
    use HasFactory;
    protected $primaryKey = 'copyout_id';
    public $incrementing = false;
    public function CopyBook()
    {
        return $this->belongsTo(CopyBook::class, 'copy_id');
    }
    public function Emp()
    {
        return $this->belongsTo(Emp::class, 'emp_id');
    }
    public static function generateID()
    {
        $dataDB = self::select('copyout_id')->latest()->first();
        $id = 'cbo_000001';
        if (!is_null($dataDB)) {
            $lastNumericPart = (int)substr($dataDB->copyout_id, 4);
            $numericPart = $lastNumericPart + 1;
            $id = sprintf('cbo_%06s', $numericPart);

        }
        return $id;
    }
    protected $fillable = [
    'copyout_id',
    'copy_id',
    'emp_id',
    'amount',
    'status',
    ];
}
