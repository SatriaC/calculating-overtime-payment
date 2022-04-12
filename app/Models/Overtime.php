<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'date',
        'time_started',
        'time_ended',
    ];

    public $timestamps = false;
    public function employee()
    {
        # code...
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function getOvertimeDurationAttribute($value)
    {
        $waktu_awal=strtotime($this->date.' '.$this->time_started);
        $waktu_akhir=strtotime($this->date.' '.$this->time_ended);
        $diff=$waktu_akhir - $waktu_awal;
        $jam    =floor($diff / (60 * 60));
        return number_format($jam,0,",",".")-1;
    }
}
