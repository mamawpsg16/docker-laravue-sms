<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gender extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeActive(Builder $query): void
    {
        $query->where('active', 1);
    }
}
