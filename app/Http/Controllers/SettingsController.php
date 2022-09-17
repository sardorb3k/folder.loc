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
}
