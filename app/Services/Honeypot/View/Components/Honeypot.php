<?php

namespace App\Services\Honeypot\View\Components;

use Illuminate\View\Component;

class Honeypot extends Component
{
    var $fieldName, $fieldTimeName;

    public function __construct()
    {
        $this->fieldName = config('honeypot.field_name');
        $this->fieldTimeName = config('honeypot.field_time_name');
    }

    public function render()
    {
        return <<<'blade'
        <div style="display: none">
            <input type="text" name="{{$fieldName}}"/>
            <input type="text" name="{{$fieldTimeName}}" value="{{Crypt::encrypt(microtime(true))}}"/>
        </div>
        blade;
//        return view('components.honeypot', [
//            'fieldName' => config('honeypot.field_name'),
//            'fieldTimeName' => config('honeypot.field_time_name')
//        ]);
    }
}
