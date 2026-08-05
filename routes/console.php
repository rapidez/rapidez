<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('rapidez:index')->hourly()->withoutOverlapping();
Schedule::command('rapidez:index:update')->everyMinute()->withoutOverlapping();

Schedule::command('cache:clear')->daily();
