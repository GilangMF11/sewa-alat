<?php

namespace App\Controllers\Setting;

use App\Controllers\BaseController;
use App\Models\Settings\SettingModel;

class SettingController extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        // Ambil data setting pertama (karena hanya 1)
        $setting = $this->settingModel->first();

        return view('Admin/setting/v_setting', [
            'setting' => $setting
        ]);
    }

    public function save()
    {
        $request = service('request');
        $setting = $this->settingModel->first(); // ambil yang pertama
        $settingId = $setting['id'] ?? null;

        // Validasi
        $rules = [
            'name_web'     => 'required',
            'phone'        => 'required',
            'facebook'     => 'permit_empty|valid_url',
            'instagram'    => 'permit_empty|valid_url',
            'twitter'      => 'permit_empty|valid_url',
            'logo' => 'permit_empty|uploaded[logo]|max_size[logo,2048]|is_image[logo]',
            'background' => 'permit_empty|uploaded[background]|max_size[background,2048]|is_image[background]',

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload logo dan background
        $logo = $this->request->getFile('logo');
        $background = $this->request->getFile('background');

        $data = [
            'name_web'   => $request->getPost('name_web'),
            'phone'      => $request->getPost('phone'),
            'facebook'   => $request->getPost('facebook'),
            'instagram'  => $request->getPost('instagram'),
            'twitter'    => $request->getPost('twitter'),
        ];

        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $logoName = $logo->getRandomName();
            $logo->move('uploads/logo', $logoName);
            $data['logo'] = $logoName;
        }

        if ($background && $background->isValid() && !$background->hasMoved()) {
            $bgName = $background->getRandomName();
            $background->move('uploads/background', $bgName);
            $data['background'] = $bgName;
        }

        // Simpan atau update
        if ($settingId) {
            $this->settingModel->update($settingId, $data);
        } else {
            $this->settingModel->insert($data);
        }

        return redirect()->to('/setting')->with('success', 'Pengaturan berhasil disimpan!');
    }
}