<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
