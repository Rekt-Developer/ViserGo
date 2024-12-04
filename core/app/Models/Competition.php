<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model {
    use GlobalStatus;

    public function lotteries() {
        return $this->hasMany(Lottery::class, 'competition_id', 'id')->active();
    }
}
