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
use App\Models\GroupLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingsService implements SettingsServiceInterface
{
    private $settings;
    private $levels;
    public function __construct(Settings $settings, GroupLevel $levels)
    {
        $this->settings = $settings;
        $this->levels = $levels;
    }

    // Store Settings
    public function storeSettings(Request $request)
    {
        // Settings update
        try {
            $settings = $this->settings->findOrFail(1);
            $settings->update([
                'attendance_day' => $request->attendance_day,
                'exam_pass' => $request->exam_pass,
                'price' => $request->price,
            ]);
            $settings->save();
            return redirect()->route('settings.index')->with('success', 'Settings Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->route('settings.index')->with('success', $e->getMessage());
        }
    }
    // Group levels
    public function groupLevel(Request $request)
    {
        // Group level update
        try {
            // Request validation
            $request->validate([
                'name' => 'required',
                'type' => 'required',
            ]);
            if ($request->type == 'add') {
                $this->levels->create([
                    'name' => $request->name,
                ]);
                return redirect()->route('settings.index')->with('success', 'Group Level Added Successfully');
            } else {
                $level = $this->levels->findOrFail($request->id);
                $level->update([
                    'name' => $request->name,
                ]);
                $level->save();
                return redirect()->route('settings.index')->with('success', 'Group Level Updated Successfully');
            }
        } catch (\Exception $e) {
            return redirect()->route('settings.index')->with('success', $e->getMessage());
        }
    }
}
