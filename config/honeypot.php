<?php

return [
    'enabled' => env('HONEYPOT_ENABLED', true),
    'field_name' => 'supamu', // Japanese name for Spam to fool the bot
    'field_time_name' => 'jikan', // Japanese name for time
    'minimum_time' => 3
];
