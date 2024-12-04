<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use GlobalStatus;

    protected $casts = [
        'ticket_number' => 'array'
    ];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
