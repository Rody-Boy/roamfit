<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('roamfit:about', function () {
    $this->info('RoamFit Laravel MVP');
});
