<?php

namespace App\Repository;

use App\Interfaces\SettingsRepositoryInterface;
use App\Interfaces\SettingsServiceInterface;
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
        return view('settings.index', compact('info'));
    }
    public function storeSettings(Request $request)
    {
        return $this->settingsService->storeSettings($request);
    }
}
