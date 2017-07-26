<?php namespace Notification\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Notification\Models\Notification;
use Redis;

class SendNotification extends Command implements SelfHandling {

  public $notification_details;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($notification_details)
	{
    $this->notification_details = json_decode($notification_details);
    $this->notification_details = (array) $this->notification_details;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
    $notification = Notification::create($this->notification_details);
    Redis::publish('notifications',json_encode($notification));
    return 'true';
	}

}
