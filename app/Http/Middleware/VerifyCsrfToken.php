<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        "139.59.212.68",
        "46.101.216.212"
    ];

    protected function shouldPassThrough($request)
    {
        $ip = $request->ip();

        return in_array($ip, $this->except);
    }
}
