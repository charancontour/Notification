<?php namespace Notification\Providers;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider {

  /**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
    $this->publishes([
      dirname(__DIR__).'/views' => base_path('resources/views/vendor/Notification'),
    ]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		include dirname(__DIR__).'/routes.php';
    $this->app->bind
		(
			'Notification\Repositories\NotificationInterface',
			'Notification\Repositories\NotificationRepository'
		);
	}

}
