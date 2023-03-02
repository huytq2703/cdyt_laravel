<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;

class SettingController extends Controller
{
    const ras_GeneralInfo = "system.setting.save_general_info";
    const res_ToasterMessage = "system.setting.save_toaster_message";
    public function index()
    {
        return Inertia::render("Admin/System/Setting", [
            'ras_GeneralInfo' => self::ras_GeneralInfo,
            'res_ToasterMessage' => self::res_ToasterMessage,
            'phone_number' => $this->_settingByKey('phone_number'),
            'address' => $this->_settingByKey('address'),
            'email' => $this->_settingByKey('email'),
            'url' => $this->_settingByKey('url'),
            'toaster' => $this->_settingByKey('toaster'),
        ]);
    }

    public function saveGeneralInfo(Request $request)
    {
       try {
        \DB::beginTransaction();
         // Update phone number
         $this->_updateSettings('phone_number', $request->phone_number);
         $this->_updateSettings('address', $request->address);
         $this->_updateSettings('email', $request->email);
         $this->_updateSettings('url', $request->url);

         \DB::commit();
        return redirect()->back()->with('toast.success', 'Cập nhật thông tin thành công');
       } catch (\Throwable $th) {
        //throw $th;
        return redirect()->back()->with('toast.error', 'Cập nhật thông tin thất bại');
       }
    }

    public function saveToasterMessage (Request $request)
    {
        $value = $request->value ?? "";

        $result = $this->_updateSettings('toaster', $value);
        if ($result) return redirect()->back()->with('toast.success', 'Cập nhật thông báo thành công');
        return redirect()->back()->with('toast.error', 'Cập nhật thông báo thất bại');
    }

    public function _updateSettings (String $key, String $value)
    {
        $settingModel = Setting::where("key",$key)->first();
         if (!$settingModel) $settingModel = new Setting();
         $settingModel->key = $key;
         $settingModel->value = $value;
         return $settingModel->save();
    }

    public function _settingByKey (String $key)
    {
        return Setting::where("key",$key)->first();
    }
}
