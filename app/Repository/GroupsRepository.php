<?php

namespace App\Repository;

use App\Interfaces\GroupsRepositoryInterface;
use App\Interfaces\TeachersServiceInterface;
use App\Http\Requests\UpdateGroupsRequest;
use App\Interfaces\GroupsServiceInterface;
use App\Http\Requests\StoreGroupsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Groups;

class GroupsRepository implements GroupsRepositoryInterface
{
    private $groups;
    private $groupService;
    private $teacherService;
    /**
     * Constructor.
     */
    public function __construct(GroupsServiceInterface $groupService, Groups $groups, TeachersServiceInterface $teachersService)
    {
        $this->groups = $groups;
        $this->groupService = $groupService;
        $this->teachersService = $teachersService;
    }
    /**
     * IndexGroups method. Get all groups.
     * @return View
     */
    public function indexGroups(): View
    {
        $groups = $this->groupService->getAllGroups();
        $count = $this->groupService->getCountGroups();

        return view('groups.index', compact('groups', 'count'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    /**
     * ShowGroups method for GroupsController class to display a single group in the database.
     * @return View
     */
    public function showGroups(int $id): View
    {
        $group = $this->groupService->getGroupById($id);

        $unsubscribelist = $this->groupService->getUnsubscribeList($id);

        $students = $this->groupService->getGroupStudents($id);
        $count = $this->groupService->getCountGroupStudents($id);
        return view('groups.show', compact('group', 'count', 'students', 'unsubscribelist'));
    }
    /**
     * CreateGroups method
     * @return View
     */
    public function createGroups(): View
    {
        $teachers = $this->teachersService->getAllTeachers();
        return view('groups.create', compact('teachers'));
    }
    /**
     * EditGroups method for GroupsController class to display the form for editing a group.
     */
    public function editGroups(int $id): View
    {
        $group = $this->groupService->getGroupById($id);
        $teachers = $this->teachersService->getAllTeachers();
        return view('groups.edit', compact('group', 'teachers'));
    }
    /**
     * StoreGroups method for GroupsController class to store a new group in the database.
     */
    public function storeGroups(Request $request): RedirectResponse
    {
        // dd($request->all());
        $groups = Groups::create($request->all());
        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }
    /**
     * DestroyGroups method for GroupsController class to delete a group from the database.
     */
    public function destroyGroups(int $groups): RedirectResponse
    {
        /**
         * Delete group from database.
         */
        $this->groupService->deleteGroup($groups);
        return redirect()->route('groups.index')
            ->with('success', 'Group deleted successfully');
    }
    /**
     * UpdateGroups method for GroupsController class to update a group in the database.
     */
    public function updateGroups(Request $groups, int $id): RedirectResponse
    {
        $this->groupService->updateGroup($groups, $id);

        return redirect()->route('groups.index')
            ->with('success', 'Group updated successfully');
    }

    /**
     * Group subscription students
     */
    public function groupSubscriptionStudents(Request $request): RedirectResponse
    {
        $this->groupService->groupSubscriptionStudents($request);
        return redirect()->route('groups.show', $request->group_id);
    }

    /**
     * Group unsubscription students
     */
    public function groupUnsubscriptionStudents(Request $request): RedirectResponse
    {
        $this->groupService->groupUnsubscriptionStudents($request);
        return redirect()->route('groups.show', $request->group_id);
    }
}
