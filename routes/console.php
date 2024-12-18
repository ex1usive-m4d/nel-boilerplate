<?php


use Illuminate\Support\Facades;

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

/*
|--------------------------------------------------------------------------
| Schedule
|--------------------------------------------------------------------------
|
| Here you may define your schedule. This is where you can define a list
|
*/


// Ежедневная очистка логов и просмотров
Facades\Schedule::command('activitylog:clean')->daily();
Facades\Schedule::command('telescope:prune')->daily();

// Оптимизация SQLite смотри https://www.sqlite.org/pragma.html#pragma_optimize
Facades\Schedule::command('sqlite:optimize')->everyFourHours();
Facades\Schedule::command('sqlite:vacuum')->everyFourHours();

// Ежедневное создание и очистка резервных копий в определенное время
Facades\Schedule::command('backup:clean')->daily()->at('01:00');
Facades\Schedule::command('backup:run')->daily()->at('01:30');
