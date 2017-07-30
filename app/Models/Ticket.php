<?php

namespace App\Models;

use App\Models\User,
    App\Models\Ticket,
    Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'route_id', 'created_at'
    ];

    /**
     * Get user relation
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'route_id');
    }
}
