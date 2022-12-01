<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    protected $table="raffles";

    protected $fillable = [
        'title', 'description', 'user_id', 'evidence_id', 'prize'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function evidence()
    {
        return $this->belongsTo('App\Models\Evidence');
    }
}