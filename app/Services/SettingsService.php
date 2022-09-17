<?php

namespace App\Services;

/**
 * Settings Service Interface
 */

use App\Models\Settings;
use App\Models\Exams;
use App\Models\Students;
use App\Models\GroupStudents;
use App\Interfaces\SettingsServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingsService implements SettingsServiceInterface
{
    private $settings;
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    // Store Settings
    public function storeSettings(Request $request)
    {
        // Settings update
        try {
            $settings = $this->settings->findOrFail(1);
            $settings->update([
                'attendance_day' => $request->attendance_day,
            ]);
            $settings->save();
            return redirect()->route('settings.index')->with('success', 'Settings Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->route('settings.index')->with('success', $e->getMessage());
        }
    }
}
