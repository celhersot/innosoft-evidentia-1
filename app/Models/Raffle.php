<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    protected $table="raffles";

    protected $fillable = [
        'title', 'description', 'winner_id', 'event_id', 'prize'
    ];

    public function winner()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }
}