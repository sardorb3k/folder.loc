<?php

/**
 * Groups Service.
 * @version    1.0.0
 * @author     Sardor Sattorov
 * @license    The MIT License (MIT)
 */

namespace App\Services;

use App\Http\Requests\UpdateGroupsRequest;
use App\Interfaces\GroupsServiceInterface;
use App\Http\Requests\StoreGroupsRequest;
use App\Models\Attendance;
use App\Models\ExamResults;
use App\Models\Exams;
use Illuminate\Support\Facades\DB;
use App\Models\GroupStudents;
use Illuminate\Http\Request;
use App\Models\Groups;
use App\Models\Payment;
use App\Models\SalaryStudents;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class GroupsService implements GroupsServiceInterface
{
    private $groups;
    public function __construct(Groups $groups)
    {
        $this->groups = $groups;
    }
    /**
     * Get all groups.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllGroups()
    {
        try {
            /**
             * Get all groups.
             */
            if (Auth::user()->getRole() != 'teacher' && Auth::user()->getRole() != 'assistant') {
                $groups = DB::select(
                    DB::raw(
                        'SELECT gi.id, gi.`name`,gi.lessonstarttime,lessonendtime, gi.days, gl.name, ut.firstname AS teacher_firstname, ut.lastname AS teacher_lastname, ua.firstname AS assistant_firstname, ua.lastname AS assistant_lastname FROM groups AS gi LEFT JOIN users AS ut ON gi.teacher_id=ut.id LEFT JOIN group_level AS gl ON gi.id=gl.id LEFT JOIN users AS ua ON gi.assistant_id=ua.id'
                    )
                );
                // $groups = Groups::leftJoin('users as teachers', 'teachers.id', '=', 'groups.teacher_id')
                //     ->leftJoin('users as assistants', 'assistants.id', '=', 'groups.assistant_id')
                //     ->select('groups.*', 'teachers.firstname as teacher_firstname', 'teachers.lastname as teacher_lastname', 'assistants.firstname as assistant_firstname', 'assistants.lastname as assistant_lastname')
                //     ->latest('groups.created_at');
            } else {
                $userid == Auth::user()->id;
                if (Auth::user()->getRole() == 'teacher') {
                    $groups = DB::select("SELECT gi.id,gi.`name`,gi.lessonstarttime,lessonendtime,gi.days,gl.name, ut.firstname AS teacher_firstname, ut.lastname AS teacher_lastname, ua.firstname AS assistant_firstname, ua.lastname AS assistant_lastname FROM groups AS gi LEFT JOIN users AS ut ON gi.teacher_id=ut.id LEFT JOIN group_level AS gl ON gl.id=gi.id LEFT JOIN users AS ua ON gi.assistant_id=ua.id where ut.id = $userid");
                } else {
                    $groups = DB::select("SELECT gi.id,gi.`name`,gi.lessonstarttime,lessonendtime,gi.days,gl.name, ut.firstname AS teacher_firstname, ut.lastname AS teacher_lastname, ua.firstname AS assistant_firstname, ua.lastname AS assistant_lastname FROM groups AS gi LEFT JOIN users AS ut ON gi.teacher_id=ut.id LEFT JOIN group_level AS gl ON gl.id=gi.id LEFT JOIN users AS ua ON gi.assistant_id=ua.id where ua.id = $userid");
                }
            }
            return $groups ?? [];
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }
    // get All Groups pagination
    public function getAllGroupsPagination($perPage = 10)
    {
        // User role if teacher or assistant

        if (Auth::user()->getRole() != 'teacher' && Auth::user()->getRole() != 'assistant') {
            $groups = $this->groups
                ->leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
                ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
                ->leftJoin('group_level as group_level', 'group_level.id', '=', 'groups.level')
                ->select(DB::raw('(SELECT count(*) from group_students where group_id = groups.id) as students_count'), 'ut.firstname as teacher_firstname', 'ut.lastname as teacher_lastname', 'ua.firstname as assistant_firstname', 'ua.lastname as assistant_lastname', 'group_level.name as level', 'groups.id', 'groups.name', 'groups.lessonstarttime', 'groups.lessonendtime', 'groups.days', 'groups.created_at')
                ->latest('groups.created_at')
                ->get();
        } else {
            $userid = Auth::user()->id;
            if (Auth::user()->getRole() == 'teacher') {
                $groups = $this->groups
                    ->leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
                    ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
                    ->leftJoin('group_level as group_level', 'group_level.id', '=', 'groups.level')
                    ->select(DB::raw('(SELECT count(*) from group_students where group_id = groups.id) as students_count'), 'ut.firstname as teacher_firstname', 'ut.lastname as teacher_lastname', 'ua.firstname as assistant_firstname', 'ua.lastname as assistant_lastname',  'group_level.name as level', 'groups.id', 'groups.name', 'groups.lessonstarttime', 'groups.lessonendtime', 'groups.days', 'groups.created_at')
                    ->where('ut.id', $userid)
                    ->latest('groups.created_at')
                    ->get();
            } else {
                $groups = $this->groups
                    ->leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
                    ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
                    ->leftJoin('group_level as group_level', 'group_level.id', '=', 'groups.level')
                    ->select(DB::raw('(SELECT count(*) from group_students where group_id = groups.id) as students_count'), 'ut.firstname as teacher_firstname', 'ut.lastname as teacher_lastname', 'ua.firstname as assistant_firstname', 'ua.lastname as assistant_lastname',  'group_level.name as level', 'groups.id', 'groups.name', 'groups.lessonstarttime', 'groups.lessonendtime', 'groups.days', 'groups.created_at')
                    ->where('ua.id', $userid)
                    ->latest('groups.created_at')
                    ->get();
            }
        }
        return $groups ?? [];
    }

    /**
     * Get count groups.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountGroups()
    {
        /**
         * Get count groups.
         * return value parce to int.
         */
        $count_group = DB::select(
            DB::raw('SELECT count(*) AS count_group FROM `groups`')
        );
        return $count_group[0]->count_group ?? 0;
    }

    /**
     * Get group by id.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getGroupById(int $id): Groups
    {
        /**
         * Get group by id.
         */
        $group = Groups::join('group_level as gl', 'gl.id', '=', 'groups.level')
            ->select('gl.name as level', 'groups.id', 'groups.name', 'groups.lessonstarttime', 'groups.lessonendtime', 'groups.days', 'groups.created_at')
            ->where('groups.id', $id)
            ->first();
        return $group;
    }

    /**
     * Get group by id information
     */
    public function getGroupInfoById(int $id): array
    {
        /**
         * Get group by id information
         */
        $group = DB::select(
            DB::raw(
                "SELECT gi.id,gi.`name`,gi.lessonstarttime,gi.days,gl.name as level,concat(ut.lastname,' ',ut.firstname) AS teacher_id,concat(ua.lastname,' ',ua.firstname) AS assistant_id FROM groups AS gi LEFT JOIN users AS ut ON gi.teacher_id=ut.id LEFT JOIN group_level AS gl ON gl.id=gi.level LEFT JOIN users AS ua ON gi.assistant_id=ua.id WHERE gi.id=:id"
            ),
            ['id' => $id]
        );
        return $group ?? [];
    }

    /**
     * Get count group students.
     */
    public function getCountGroupStudents(int $id): int
    {
        /**
         * Get count group students.
         */
        $count_group_students = DB::select(
            DB::raw(
                "SELECT COUNT(*) AS count_group_students FROM group_students WHERE group_id = $id"
            )
        );
        return $count_group_students[0]->count_group_students;
    }

    /**
     *  get group subscribers students list
     */
    public function getGroupStudents(int $id)
    {
        $students = GroupStudents::join(
            'users',
            'group_students.student_id',
            '=',
            'users.id'
        )
            ->select(
                'users.id',
                'group_students.id as group_id',
                'users.lastname',
                'users.firstname',
                'users.phone',
                'users.status',
                'users.image',
                'users.status',
                'users.birthday'
            )
            ->where('group_id', $id)
            ->get();
        return $students ?? [];
    }

    /**
     * Subscribe student to group.
     */
    public function groupSubscriptionStudents(Request $request): void
    {
        // dd($request->all());
        try {
            if ($request->has('student_id')) {
                $group_id = $request->group_id;
                // Foreach student id
                foreach ($request->student_id as $student_id) {
                    // Check student id
                    $check_student_id = GroupStudents::where(
                        'student_id',
                        $student_id
                    )
                        ->where('group_id', $group_id)
                        ->first();
                    if ($check_student_id) {
                        continue;
                    }
                    // Create new group student
                    $group_student = new GroupStudents();
                    $group_student->student_id = $student_id;
                    $group_student->group_id = $group_id;
                    $group_student->user_id = Auth::user()->id;
                    $group_student->save();
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Unsubscribe student from group.
     */
    public function groupUnsubscriptionStudents(Request $request): void
    {
        try {
            // Validation request
            $request->validate([
                'group_id' => 'required',
                'student_id' => 'required',
            ]);
            $group_id = $request->group_id;
            $student_id = $request->student_id;
            $group_student = GroupStudents::find($student_id);
            if ($group_student) {
                $group_student->delete();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Get unsubscribe list.
     */
    public function getUnsubscribeList(int $id): array
    {
        $students = DB::select(
            'SELECT * FROM users WHERE id NOT IN (SELECT student_id FROM group_students WHERE group_students.group_id=' .
                $id .
                ')'
        );
        return $students ?? [];
    }

    /**
     * Delete group.
     */
    public function deleteGroup(int $id): void
    {
        // Validation group id
        $group = Groups::find($id);
        // try {
        if ($group) {
            // Table group_student delete group results by group id
            GroupStudents::where('group_id', $id)->delete();
            Attendance::where('group_id', $id)->delete();
            $exam = Exams::where('group_id', $id)->first();
            if ($exam) {
                ExamResults::where('exam_id', $exam->id)->delete();
                $exam->delete();
            }
            // Payment delete group results by group id
            Payment::where('group_id', $id)->delete();
            SalaryStudents::where('group_id', $id)->delete();
            // Table group delete exam by id
            $group->delete();
        }
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
    }

    /**
     * Update group.
     */
    public function updateGroup(Request $request, int $id): void
    {
        // Validation request
        $request->validate([
            'name' => 'required',
            'lessonstarttime' => 'required',
            'lessonendtime' => 'required',
            'days' => 'required',
            'level' => 'required',
            'teacher_id' => 'required',
            'assistant_id' => 'required',
        ]);
        $group = Groups::find($id);
        $group->name = $request->name;
        $group->lessonstarttime = $request->lessonstarttime;
        $group->lessonendtime = $request->lessonendtime;
        $group->days = $request->days;
        $group->level = $request->level;
        $group->teacher_id = $request->teacher_id;
        $group->assistant_id = $request->assistant_id;
        $group->save();
    }
}
