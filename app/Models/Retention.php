<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sort;

class Retention extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'duration',
        'sort_id',
    ];

    public function sort()
    {
        return $this->belongsTo(Sort::class, 'sort_id');
    }
}
