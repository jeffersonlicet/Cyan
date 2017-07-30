<?php

namespace App\Models;


use Carbon\Carbon, 
    App\Models\Ticket,
    Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * The table primary key
     *
     * @var string
     */
	protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'carnet', 'name', 'lastname', 'nickname'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_id', 'user_id')->where('created_at', '>=', Carbon::today()->toDateString());
    }
}
