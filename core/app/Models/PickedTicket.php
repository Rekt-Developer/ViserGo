<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class PickedTicket extends Model
{
    use GlobalStatus;

    protected $casts = [
        'choosen_tickets' => 'array'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }
}
