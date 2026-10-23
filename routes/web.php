<?php

use Illuminate\Support\Facades\Route;

$adminPrefix = env('ADMIN_PREFIX', 'inventaris-portal-mgmt');

Route::redirect('/', '/' . $adminPrefix);
