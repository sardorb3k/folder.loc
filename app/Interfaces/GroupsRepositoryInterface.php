<?php
namespace App\Interfaces;

use App\Http\Requests\UpdateGroupsRequest;
use App\Http\Requests\StoreGroupsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Groups;

interface GroupsRepositoryInterface
{
    public function indexGroups(): View;
    public function showGroups(int $id): View;
    public function createGroups(): View;
    public function editGroups(int $id): View;
    public function storeGroups(Request $request): RedirectResponse;
    public function destroyGroups(int $groups): RedirectResponse;
    public function updateGroups(Request $groups, int $id): RedirectResponse;
    public function groupSubscriptionStudents(Request $request);
    public function groupUnsubscriptionStudents(Request $request);
}
