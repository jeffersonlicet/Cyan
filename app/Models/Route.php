<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model,
	App\Models\Ticket,
	Carbon\Carbon;

class Route extends Model
{

	/**
     * The table primary key
     *
     * @var string
     */
	protected $primaryKey = 'route_id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'route_name', 'route_status', 'open_at', 'close_at', 'departure_at', 'created_at', 'updated_at'
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'open_at',
		'close_at',
		'departure_at',
		'created_at',
		'updated_at'
	];

	/**
	 * The new attributes to assign to each instance
	 *
	 * @var array
	 */
	protected $appends = ['is_open', 'open_time', 'departure_time'];

	/**
	 * Define if the current Route is open
	 *
	 * @return boolean
	 */
	public function getIsOpenAttribute(): bool
	{
		$datetimes = [
			'current'  => Carbon::now(),
			'close_at' => $this->close_at,
			'open_at'  => $this->open_at,
			'departure_at' => $this->departure_at
		];

		$times = $this->mutateCarbonDatetimeToTime($datetimes);

		return $times['current']->between($times['open_at'], $times['close_at'], true);
	}

	/**
	 * Define the time until open the route
	 *
	 * @return boolean
	 */
	public function getOpenTimeAttribute()
	{
		Carbon::setLocale('es');

		$datetimes = [
			'current'  => Carbon::now(),
			'open_at'  => $this->open_at,
		];

		$times = $this->mutateCarbonDatetimeToTime($datetimes);
		return $times['open_at']->diffForHumans($times['current'], true);
	}

	/**
	 * Define the time until departure
	 *
	 * @return string
	 */
	public function getDepartureTimeAttribute()
	{
		Carbon::setLocale('es');

		$datetimes = [
			'current'  => Carbon::now(),
			'departure_at'  => $this->departure_at,
		];

		$times = $this->mutateCarbonDatetimeToTime($datetimes);
		return $times['departure_at']->diffForHumans($times['current'], true);
	}

	/**
     * Get tickets relation
     *
     * @return Ticket[]
     */
	public function tickets()
	{
		return $this->hasMany(Ticket::class, 'route_id', 'route_id')->where('created_at', '>=', Carbon::today()->toDateString());
	}

	/**
	 * I'm sure there is a better way to do this...
	 *
	 * @return array
	 */
	private function mutateCarbonDatetimeToTime($datetime = null): array
	{
		$output = [];

		foreach($datetime as $key => $value)
		{
			$output[$key] = Carbon::parse($value->toTimeString());
		}

		return $output;
	}
}