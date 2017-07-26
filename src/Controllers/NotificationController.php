<?php namespace Notification\Controllers;

use App\Http\Controllers\Controller;
use Notification\Repositories\NotificationInterface;
class NotificationController extends Controller
{

  function __construct(NotificationInterface $notification)
  {
    $this->notification = $notification;
  }

  public function index()
  {
    return $this->notification->index();
  }

}
