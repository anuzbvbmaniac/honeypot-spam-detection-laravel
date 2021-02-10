<?php

namespace App\Honeypot;

use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class Honeypot
{
    protected static $response;
    protected $request;
    protected $config;

    public function __construct(Request $request, array $config)
    {

        $this->request = $request;
        $this->config = $config;
    }

    public static function abortUsing(callable $response)
    {
        static::$response = $response;
    }

    public function disabled()
    {
        return !$this->config['enabled'];
    }

    public function detect()
    {
        if (!$this->enabled()) {
            return false;
        }

        /**
         *  Look for (Honeypot Field Name) : 'spam'
         *  If this doesn't exist ==> Something's wrong!!! Ding ding ding! It's a spam.
         */
        if (!$this->request->has($this->config['field_name'])) {
            return true;
        }

        /**
         *  If (Honeypot Field Name) is present and has some values
         *  Ding Ding Ding!!! Since end user cannot see this field and it's populated. It's a spam.
         */
        if (!empty($this->request->input($this->config['field_name']))) {
            return true;
        }

        /**
         *  How much time has elapsed.
         *  If its smaller than 3 seconds, Bot filled in the form. Thus, Abort the task.
         */
        if ($this->submittedToQuickly() <= $this->config['minimum_time']) {
            return true;
        }

        return false;
    }

    public function enabled()
    {
        return $this->config['enabled'];
    }

    public function submittedToQuickly()
    {
        try {
            return microtime(true) - Crypt::decrypt($this->request->input($this->config['field_time_name']));
        } catch (DecryptException $exception) {
            return false;
        }
    }

    public function abort()
    {
        if (static::$response) {
            call_user_func(static::$response);
        }
        abort(400, 'Error while handing your request.');
    }
}
