<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Floor;

class Building extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'creator_id'];

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
