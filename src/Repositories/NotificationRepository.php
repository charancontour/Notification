<?php namespace Notification\Repositories;
use Redis;
use Auth;
class NotificationRepository implements NotificationInterface
{
  public function index()
  {
    $notifications = Auth::user()->notifications;    
    return view('vendor.Notification.index')->with('notifications',$notifications);
  }
}
