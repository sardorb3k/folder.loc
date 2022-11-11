<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\GroupsRepositoryInterface;
use App\Models\Groups;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupsController extends Controller
{
    private $groups;

    public function __construct(GroupsRepositoryInterface $groups)
    {
        $this->groups = $groups;
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
        if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin') {
            $groups = Groups
                ::leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
                ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
                ->leftJoin('group_level as group_level', 'group_level.id', '=', 'groups.level')
                ->select(DB::raw('(SELECT count(*) from group_students left join users on users.id = group_students.student_id where group_id = groups.id AND users.status = "active") as students_count'), 'ut.firstname as teacher_firstname', 'ut.lastname as teacher_lastname', 'ua.firstname as assistant_firstname', 'ua.lastname as assistant_lastname', 'group_level.name as level', 'groups.id', 'groups.name', 'groups.lessonstarttime', 'groups.lessonendtime', 'groups.days', 'groups.created_at')
                ->where('groups.status', 'active')
                ->latest('groups.created_at')
                ->get();
        } else {
            $userid = Auth::user()->id;
            if (Auth::user()->role == 'teacher') {
                $groups = Groups::leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
                    ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
                    ->leftJoin('group_level as group_level', 'group_level.id', '=', 'groups.level')
                    ->select(DB::raw('(SELECT count(*) from group_students left join users on users.id = group_students.student_id where group_id = groups.id AND users.status = "active") as students_count'), 'ut.firstname as teacher_firstname', 'ut.lastname as teacher_lastname', 'ua.firstname as assistant_firstname', 'ua.lastname as assistant_lastname',  'group_level.name as level', 'groups.id', 'groups.name', 'groups.lessonstarttime', 'groups.lessonendtime', 'groups.days', 'groups.created_at')
                    ->where([['ut.id', $userid], ['groups.status', 'active']])
                    ->latest('groups.created_at')
                    ->get();
            } else {
                $groups = Groups::leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
                    ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
                    ->leftJoin('group_level as group_level', 'group_level.id', '=', 'groups.level')
                    ->select(DB::raw('(SELECT count(*) from group_students left join users on users.id = group_students.student_id where group_id = groups.id AND users.status = "active") as students_count'), 'ut.firstname as teacher_firstname', 'ut.lastname as teacher_lastname', 'ua.firstname as assistant_firstname', 'ua.lastname as assistant_lastname',  'group_level.name as level', 'groups.id', 'groups.name', 'groups.lessonstarttime', 'groups.lessonendtime', 'groups.days', 'groups.created_at')
                    ->where([['ut.id', $userid], ['groups.status', 'active']])
                    ->latest('groups.created_at')
                    ->get();
            }
        };

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->groups->createGroups();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->groups->storeGroups($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->groups->showGroups($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->groups->editGroups($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->groups->updateGroups($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return $this->groups->destroyGroups($id);
    }

    /**
     * Group subscription students
     */
    public function subscription(Request $request)
    {
        return $this->groups->groupSubscriptionStudents($request);
    }

    /**
     * Group unsubscription students
     */
    public function unsubscribe(Request $request)
    {
        return $this->groups->groupUnsubscriptionStudents($request);
    }

    public function archives()
    {
        $groups = Groups::leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
            ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
            ->leftJoin('group_level as group_level', 'group_level.id', '=', 'groups.level')
            ->select(DB::raw('(SELECT count(*) from group_students where group_id = groups.id) as students_count'), 'groups.*', 'ut.firstname as teacher_firstname', 'ut.lastname as teacher_lastname', 'ua.firstname as assistant_firstname', 'ua.lastname as assistant_lastname', 'group_level.name as level',)
            ->where('groups.status', 'inactive')
            ->latest('groups.created_at')
            ->get();
        return view('groups.archives', ['groups' => $groups]);
    }

    // archive group
    public function archive(Request $request, $id)
    {
        $group = Groups::findOrFail($id);
        $group->status = 'inactive';
        $group->archive_reason = $request->archive_reason;
        $group->archived_at = Carbon::now();
        $group->save();
        return redirect()->route('groups.index')->with('success', 'Group has been archived');
    }

    // unarchive group
    public function unarchive($id)
    {
        $group = Groups::findOrFail($id);
        $group->status = 'active';
        $group->archive_reason = '';
        $group->archived_at = Carbon::now();
        $group->save();
        return redirect()->route('groups.archives')->with('success', 'Group has been unarchived');
    }
}
