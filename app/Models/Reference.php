<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'expression',
    ];

    public $timestamps = false;
    public function setting()
    {
        # code...
        return $this->hasOne(Setting::class, 'value');
    }
}
