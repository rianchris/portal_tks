<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 1. Tambahkan TrustProxies agar Laravel mengenali HTTPS dari Hostinger
        $middleware->trustProxies(at: '*');

        // 2. Alias middleware yang sudah Anda buat sebelumnya
        $middleware->alias([
            'superadmin' => \App\Http\Middleware\SuperAdminOnly::class,
        ]);

        // 3. Bypass Signature khusus untuk Livewire Preview agar tidak 401/403
        $middleware->validateSignatures(except: [
            'livewire/preview-file/*',
            'portal/livewire/preview-file/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
