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
use Illuminate\Support\Facades\DB;
use App\Models\GroupStudents;
use Illuminate\Http\Request;
use App\Models\Groups;
use Auth;

class GroupsService implements GroupsServiceInterface
{
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
            $groups = DB::select(
                DB::raw(
                    'SELECT gi.id,gi.`name`,gi.lessonstarttime,lessonendtime,gi.days,gi.level, ut.firstname AS teacher_firstname, ut.lastname AS teacher_lastname, ua.firstname AS assistant_firstname, ua.lastname AS assistant_lastname FROM groups AS gi LEFT JOIN users AS ut ON gi.teacher_id=ut.id LEFT JOIN users AS ua ON gi.assistant_id=ua.id'
                )
            );
            return $groups ?? [];
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }
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
        $group = Groups::find($id);
        return $group ?? [];
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
                "SELECT gi.id,gi.`name`,gi.lessonstarttime,gi.days,gi.level,concat(ut.lastname,' ',ut.firstname) AS teacher_id,concat(ua.lastname,' ',ua.firstname) AS assistant_id FROM groups AS gi LEFT JOIN users AS ut ON gi.teacher_id=ut.id LEFT JOIN users AS ua ON gi.assistant_id=ua.id WHERE gi.id=:id"
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
        $group_id = $request->group_id;
        $student_id = $request->student_id;
        $group_student = new GroupStudents();
        $group_student->group_id = $group_id;
        $group_student->student_id = $student_id;
        $group_student->user_id = Auth::user()->id;
        $group_student->save();
    }

    /**
     * Unsubscribe student from group.
     */
    public function groupUnsubscriptionStudents(Request $request): void
    {
        $group_id = $request->group_id;
        $student_id = $request->student_id;
        $group_student = GroupStudents::find($student_id);
        $group_student->delete();
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

        // Table group_student delete group results by group id
        $group_student = GroupStudents::where('group_id', $id)->delete();
        // Table group delete exam by id
        $group = Groups::where('id', $id)->delete();
    }

    /**
     * Update group.
     */
    public function updateGroup(Request $request, int $id): void
    {
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
