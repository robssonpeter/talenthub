<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class RenameIsActiveToSlierIsActiveInSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isActive = Setting::where(['key' => 'is_active'])->first();
        $isActive->update(['key' => 'slider_is_active']);
    }
}
