<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['guest_id', 'message', 'arrival'];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guests::class, 'guest_id', 'id');
    }
}
