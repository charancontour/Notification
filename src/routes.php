<?php

Route::get('notification',['middlware'=>'auth','uses'=>'Notification\Controllers\NotificationController@index']);
