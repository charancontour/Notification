<?php namespace Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Notification extends Model
{
  use SoftDeletes;

  protected $fillable = ['type','user_id','created_at','description'];

  public $timestamps  = false;

  protected $dates    = ['created_at','deleted_at'];

  public static function boot()
  {
      parent::boot();

      static::creating(function ($model) {
          $model->created_at = $model->freshTimestamp();
      });
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }


}
