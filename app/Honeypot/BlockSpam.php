<?php

namespace App\Honeypot;

use Closure;
use Illuminate\Http\Request;

class BlockSpam
{
    protected $honeypot;

    public function __construct(Honeypot $honeypot)
    {
        $this->honeypot = $honeypot;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->honeypot->detect()) {
            $this->honeypot->abort();
        }

        return $next($request);
    }

}
