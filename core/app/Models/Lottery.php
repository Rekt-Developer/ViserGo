<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model {
    use GlobalStatus;

    protected $casts = [
        'slider_images'   => 'array',
        'winning_tickets' => 'array',
    ];

    public function competitions() {
        return $this->belongsTo(Competition::class, 'competition_id', 'id');
    }

    public function winners() {
        return $this->hasMany(Winner::class, 'lottery_id', 'id');
    }

    public function pickedTickets() {
        return $this->hasMany(PickedTicket::class, 'lottery_id', 'id');
    }

    public function users() {
        return $this->hasManyThrough(User::class, Winner::class, 'lottery_id', 'id', 'id', 'user_id');
    }

    public function scopePickedAndWonByUser($query, $userId) {
        return $query
            ->with(['pickedTickets' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }, 'winners' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->whereHas('pickedTickets', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
    }

    public function getTotalSoldAttribute() {
        return count(json_decode($this->sold_tickets));
    }

    public function getWinStatusAttribute() {
        if ($this->winners->isNotEmpty()) {
            return ' <span class="badge badge--success"> ' . trans('Win') . '</span>';
        } else if ($this->draw_date > now()) {
            return ' <span class="badge badge--warning"> ' . trans('Running') . '</span>';
        } else {
            return ' <span class="badge badge--danger"> ' . trans('Lose') . '</span>';
        }
    }

    public function statusBadge(): Attribute {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::ENABLE) {
                $html = '<span class="badge badge--success">' . trans('Enabled') . '</span>';
            } else {
                $html = '<span class="badge badge--warning">' . trans('Disabled') . '</span>';
            }
            return $html;
        });
    }
    public function drawnBadge(): Attribute {
        return new Attribute(function () {
            $html = '';
            if ($this->is_drawn == Status::LOTTERY_DRAWN) {
                $html = '<span class="badge badge--danger">' . trans('Drawn') . '</span>';
            } else {
                $html = '<span class="badge badge--primary">' . trans('Live') . '</span>';
            }
            return $html;
        });
    }

    public function scopeLive($query) {
        return $query->whereDate('draw_date', '>=', now())->where('is_drawn', Status::LOTTERY_LIVE);
    }
    public function scopeDrawn($query) {
        return $query->where('is_drawn', Status::LOTTERY_DRAWN);
    }
}
