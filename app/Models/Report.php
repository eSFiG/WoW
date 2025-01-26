<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'type',
        'date',
    ];

    public function getType()
    {
        return $this->belongsTo(Type::class, 'type');
    }
}
