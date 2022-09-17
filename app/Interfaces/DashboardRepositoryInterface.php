<?php
namespace App\Interfaces;

use App\Http\Requests\UpdateGroupsRequest;
use App\Http\Requests\StoreGroupsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Groups;

interface DashboardRepositoryInterface
{
    public function studentDashboard(): View;
    public function adminDashboard(): View;
    public function teacherDashboard(): View;
}
