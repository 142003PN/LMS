<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Department extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'hod_id'];

    public function hod(): BelongsTo
    {
        return $this->belongsTo(User::class, 'hod_id');
    }
}
