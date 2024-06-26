<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class communicationRecord extends Model
{
    use HasFactory;

    protected $table = 'communication_record';
    protected $fillable = [
        'communication_id',
        'record_id',
        'is_original',
        'return_date',
        'return_effective',
    ];

    public function communication()
    {
        return $this->belongsTo(Communication::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }


}
