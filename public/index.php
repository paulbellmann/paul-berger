<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use App\Controller\AnalysisController;
use App\Controller\HomeController;
use App\Controller\ReadController;
use App\Controller\CreateController;
use App\Controller\DeleteController;
use App\Controller\UpdateController;
use MiniMVC\Core\Application;

$app = new Application();

// Define routes
$app->get('/', HomeController::class);
$app->get('/analysis', AnalysisController::class);
$app->get('/read/{id}', ReadController::class);
$app->get('/delete/{id}', DeleteController::class);
$app->post('/update/{id}', UpdateController::class);
$app->post('/create', CreateController::class);

$app->run();
