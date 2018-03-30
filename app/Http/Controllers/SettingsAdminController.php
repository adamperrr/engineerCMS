<?php

namespace App\Http\Controllers;

use App\Setting;
use Symfony\Component\HttpFoundation\Request;

class SettingsAdminController extends Controller
{
    public function __construct()
    {
        Controller::__construct();
        $this->middleware(['auth', 'checkSuperAdmin']);
    }

    public function index()
    {
        $fullSettings = Setting::all();

        return view('settings-admin.index', [
            'fullSettings' => $fullSettings,
        ]);
    }

    public function update(Request $request)
    {
        $this->updateTextFields($request);
        $this->updateBooleanFields($request);
        $this->updateIntFields($request);

        return redirect()->route('settings-admin.index');
    }

    private function updateTextFields($request)
    {
        $textSettingsFromDb = Setting::where('settingType', 'text')->get();
        foreach($textSettingsFromDb as $dbSetting)
        {
            $valueFromDB = $dbSetting->settingValue;
            $valueFromReq = $request[$dbSetting->settingName];

            if($valueFromDB != $valueFromReq)
            {
                $dbSetting->settingValue = $valueFromReq;
                $dbSetting->save();
            }
        }
    }

    private function updateBooleanFields($request)
    {
        $booleanSettingsFromDb = Setting::where('settingType', 'boolean')->get();
        foreach($booleanSettingsFromDb as $dbSetting)
        {
            $valueFromDB = $dbSetting->settingValue;
            $valueFromReq = $request[$dbSetting->settingName] == null ? 0 : 1;

            if($valueFromDB != $valueFromReq)
            {
                $dbSetting->settingValue = $valueFromReq;
                $dbSetting->save();
            }
        }
    }

    private function updateIntFields($request)
    {
        $intSettingsFromDb = Setting::where('settingType', 'int')->get();
        foreach($intSettingsFromDb as $dbSetting)
        {
            $valueFromDB = $dbSetting->settingValue;
            $valueFromReq = $request[$dbSetting->settingName];

            if($valueFromDB != $valueFromReq)
            {
                $dbSetting->settingValue = $valueFromReq;
                $dbSetting->save();
            }
        }
    }
}