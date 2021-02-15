<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Redirect;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //'http://127.0.0.1:8000/api/login',
        // 'http://127.0.0.1:8000/api/cart/add_product'
       // '/api/*',
    ];
}
