<?php
use App\Controllers\UserController;

return function ($app) {
	$app->get('/user/rfid/{rfid:[a-zA-Z0-9]+}', UserController::class . ':findByRfid');
};