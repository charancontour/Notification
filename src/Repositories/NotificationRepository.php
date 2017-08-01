<?php namespace Notification\Repositories;
use Redis;
use Auth;
use Notification\Models\Notification;
class NotificationRepository implements NotificationInterface
{
  public function index()
  {
    $notifications = Auth::user()->notifications; 
    Notification::where('user_id',Auth::user()->id)->update(['read_status'=>1]);   
    return view('vendor.Notification.index')
    		->with('notifications',$notifications->sortByDesc('created_at'));
  }
}
