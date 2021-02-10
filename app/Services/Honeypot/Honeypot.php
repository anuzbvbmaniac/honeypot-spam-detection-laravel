<?php

namespace App\Services\Honeypot;

use Closure;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class Honeypot
{

    public function handle(Request $request, Closure $next)
    {

        if (!config('honeypot.enabled')) {
            return $next($request);
        }

        /**
         *  Look for (Honeypot Field Name) : 'span'
         *  If this doesn't exist ==> Something's wrong!!! Ding ding ding! It's a spam.
         */
        if (!$request->has(config('honeypot.field_name'))) {
            $this->abort();
        }

        /**
         *  If (Honeypot Field Name) is present and has some values
         *  Ding Ding Ding!!! Since end user cannot see this field and it's populated. It's a spam.
         */
        if (!empty($request->input(config('honeypot.field_name')))) {
            $this->abort();
        }

        /**
         *  How much time has elapsed.
         *  If its smaller than 3 seconds, Bot filled in the form. Thus, Abort the task.
         */
        if ($this->timeToSubmit($request) <= config('honeypot.minimum_time')) {
            $this->abort();
        }

        return $next($request);
    }

    public function abort()
    {
        abort(422, 'Spam Detected'); // I understand what you're doing but i ain't gonna do it.
    }

    public function timeToSubmit(Request $request)
    {
        try {
            return microtime(true) - Crypt::decrypt($request->input(config('honeypot.field_time_name')));
        } catch (DecryptException $exception) {
            return $this->abort();
        }
    }

}
