<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

/**
 * Created by PhpStorm.
 * User: ccyeh0901
 * Date: 10/10/2017
 * Time: 2:08 PM
 */

class PusherEvent implements ShouldBroadcast
{
	use SerializesModels;

	public $text, $id;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($text, $id)
	{
		$this->text = $text;
		$this->id   = $id;
	}

	/**
	 * Get the channels the event should be broadcast on.
	 *
	 * @return array
	 */
	public function broadcastOn()
	{
		return ['laravel-broadcast-channel'];
	}
}