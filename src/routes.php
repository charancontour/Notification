<?php

Route::get('notification',['middleware'=>'auth','uses'=>'Notification\Controllers\NotificationController@index']);
