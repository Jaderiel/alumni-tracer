<?php

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

Artisan::command('serve', function () {
    $this->info('Server running on [http://127.0.0.1:8000/home]');

    $process = new Process(['php', '-S', '127.0.0.1:8000', '-t', public_path('')]);
    $process->setTimeout(null)->run();

    foreach ($process as $type => $data) {
        if ($process::OUT === $type) {
            echo $data;
        } else {
            $this->error($data);
        }
    }
})->purpose('Serve the application on the PHP development server');

