<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $websiteSettings;

    public function __construct()
    {
        $settingsTemp = \App\Setting::all();

        foreach ($settingsTemp as $setting)
        {
            $this->websiteSettings[ $setting->settingName ] = [
                'value' => $setting->settingValue,
                'type' => $setting->settingType,
            ];
        }

        $this->websiteSettings['APP_URL'] = [
            'value' => env('APP_URL'),
            'type' => 'text',
        ];

        \View::share ( 'websiteSettings', $this->websiteSettings );
    }
}
