<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DashboardRepositoryInterface;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $dashboard;
    public function __construct(DashboardRepositoryInterface $dashboard)
    {
        $this->dashboard = $dashboard;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Auth role
        // dd(Auth::user()->getRole());
        if (Auth::user()->getRole() == 'admin' || Auth::user()->getRole() == 'superadmin'){
            return $this->dashboard->adminDashboard();
        }elseif (Auth::user()->getRole() == 'student'){
            return $this->dashboard->studentDashboard();
        }elseif (Auth::user()->getRole() == 'teacher' || Auth::user()->getRole() == 'assistant'){
            return $this->dashboard->teacherDashboard();
        }
    }
}
