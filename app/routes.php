<?php

use App\Controllers\HomeController;
use App\Controllers\LeadController;
use App\Controllers\ErrorController;
use App\Controllers\SubscribeController;

$app->get('/', [HomeController::class, 'index']);
$app->post('/store', [LeadController::class, 'store']);
$app->get('/error', [ErrorController::class, 'index']);
$app->get('/thanks', [ThanksController::class, 'index']);
$app->post('/subscribe', [new SubscribeController(), 'addMember']);
