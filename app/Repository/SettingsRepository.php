<?php

namespace App\Repository;

use App\Interfaces\SettingsRepositoryInterface;
use App\Interfaces\SettingsServiceInterface;
use App\Models\GroupLevel;
use App\Models\Salary;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsRepository implements SettingsRepositoryInterface
{
    private $settingsService;
    public function __construct(SettingsServiceInterface $settingsService)
    {
        $this->settingsService = $settingsService;
    }
    // Index Salary
    public function indexSettings()
    {
        $info = Settings::first();
        $level = GroupLevel::all();
        return view('settings.index', compact('info', 'level'));
    }
    public function storeSettings(Request $request)
    {
        return $this->settingsService->storeSettings($request);
    }
    // Group levels
    public function groupLevel(Request $request)
    {
        return $this->settingsService->groupLevel($request);
    }
    // Group Level delete
    public function groupLevelDelete($id)
    {
        try {
            $level = GroupLevel::findOrFail($id);
            $level->delete();
            return redirect()->route('settings.index')->with('success', 'Group Level Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('settings.index')->with('success', $e->getMessage());
        }
    }
    // Group level get by id
    public function groupLevelGetById($id)
    {
        try {
            $level = GroupLevel::findOrFail($id);
            return $level;
        } catch (\Exception $e) {
            return redirect()->route('settings.index')->with('success', $e->getMessage());
        }
    }
    // Group level update
    public function groupLevelUpdate(Request $request)
    {
        try {
            $level = GroupLevel::findOrFail($request->id);
            $level->update([
                'name' => $request->name,
            ]);
            $level->save();
            return response()->json(['success' => 'Group Level Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
