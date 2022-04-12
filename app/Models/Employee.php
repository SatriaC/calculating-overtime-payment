<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status_id',
        'salary',
    ];

    public $timestamps = false;

    public function reference()
    {
        # code...
        return $this->belongsTo(Reference::class, 'status_id');
    }

    public function overtimes()
    {
        # code...
        return $this->hasMany(Overtime::class, 'employee_id');
    }

    public function getOvertimeDurationTotalAttribute()
    {
        $overtime = Overtime::where('employee_id', $this->id)->get();
        $result = 0;
        foreach ($overtime as $item) {
            # code...
            $result += $item->overtime_duration;
        }
        return $result;
    }

    public function getAmountAttribute($value)
    {
        switch ($this->reference->id) {
            case 1:
                # code...
                $result = ($this->salary / 173) * $this->getOvertimeDurationTotalAttribute();
                break;

            case 2:
                # code...
                $result = 10000 * $this->getOvertimeDurationTotalAttribute();
                break;
        }
        
        return $result;
    }
}
