<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use GlobalStatus;

    protected $casts = [
        'choosen_tickets' => 'array'
    ];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }

    public function calculateSingleCartPrice()
    {
        return $this->quantity * $this->lottery->price;
    }
}
