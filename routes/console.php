<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('aoc {id}', function ($id) {
    $id = substr(str($id)->padleft(2, '0'),-2);
    $file = base_path("app/aoc/step_{$id}.php");
    if (file_exists($file)) {
        include $file;
    } else {
        dd($file . ' does not exist !');
    }
})->purpose('Execute a modul with path /app/aoc/step_{id}.php');

Artisan::command('run {path} {module}', function ($path, $module) {
    $module = basename($module, '.php');
    $file = base_path("app/{$path}/{$module}.php");
    if (file_exists($file)) {
        include $file;
    } else {
        dd($file . ' does not exist !');
    }
})->purpose('Execute a modul with path /app/{$path}/{module}.php');
