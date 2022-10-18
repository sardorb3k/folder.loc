<?php

namespace App\Http\Controllers;

use App\Interfaces\SettingsRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    private $settings;
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
        // Middleware for authentication.
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->settings->indexSettings();
    }

    // Store
    public function store(Request $request)
    {
        return $this->settings->storeSettings($request);
        return redirect()->back();
    }
    // Group levels
    public function groupLevel(Request $request)
    {
        return $this->settings->groupLevel($request);
    }
    // Group Level delete
    public function groupLevelDelete($id)
    {
        return $this->settings->groupLevelDelete($id);
    }
    // Group Level get
    public function groupLevelGetById($id)
    {
        return $this->settings->groupLevelGetById($id);
    }
    // Group Level update
    public function groupLevelUpdate(Request $request)
    {
        return $this->settings->groupLevelUpdate($request);
    }
}
