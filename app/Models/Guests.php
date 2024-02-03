<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Guests extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'address', 'status'];

    public function attendance(): HasOne
    {
        return $this->hasOne(Attendance::class);
    }
}
