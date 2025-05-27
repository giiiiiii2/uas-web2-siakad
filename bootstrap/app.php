<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware; // Tambahkan ini
use App\Http\Middleware\MahasiswaMiddleware; // Tambahkan ini

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Daftarkan alias middleware di sini
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'mahasiswa' => MahasiswaMiddleware::class,
        ]);

        // Anda juga bisa menambahkan middleware ke grup web atau api jika diperlukan
        // $middleware->web(append: [
        //     \App\Http\Middleware\MahasiswaMiddleware::class,
        // ]);
        // $middleware->api(append: [
        //     //
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
