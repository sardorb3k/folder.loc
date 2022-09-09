<?php

/**
 * Teachers Service.
 * @version    1.0.0
 * @author     Sardor Sattorov
 * @license    The MIT License (MIT)
 */

namespace App\Services;

use App\Http\Requests\UpdateTeachersRequest;
use App\Http\Requests\StoreTeachersRequest;
use App\Interfaces\TeachersServiceInterface;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TeachersService implements TeachersServiceInterface
{
    private $teachers;
    /**
     * Constructor.
     */
    public function __construct(Teacher $teachers)
    {
        $this->teachers = $teachers;
    }

    /**
     * Get all teachers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTeachers(): Collection
    {
        return Teacher::where('role', 'teacher')->get();
    }
    /**
     * Get All Teachers Paginated.
     * @param int $perPage
     * @return \Illuminate\Http\Response
     */
    public function getAllTeachersPaginated(int $perPage): LengthAwarePaginator
    {
        return Teacher::where('role', 'teacher')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get count teachers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountTeachers(): int
    {
        return Teacher::where('role', 'teacher')->count();
    }

    /**
     * Get teacher by id.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getTeacherById(int $id): Teacher
    {
        return Teacher::findOrFail($id);
    }

    /**
     * Update teacher information.
     */
    public function updateTeacher(Request $request, int $id): Teacher
    {
        // dd($request->all());
        $teacher = Teacher::findOrFail($id);
        $teacher->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'status' => $request->graduation == 'on' ? 'inactive' : 'active',
        ]);
        // dd($teacher);
        return $teacher;
    }
    /**
     * Update password.
     */
    public function updatePassword(Request $request, int $id): Teacher
    {
        // dd($request);
        /**
         * validate request
         */
        $req = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        /**
         * update password
         */
        $teacher = Teacher::findOrFail($id);
        $teacher->update([
            'password' => Hash::make($req['password']),
        ]);
        return $teacher;
    }

    /**
     * Teacher delete.
     */
    public function deleteTeacher(int $id): bool
    {
        $teacher = Teacher::findOrFail($id);
        return $teacher->delete();
    }

    /**
     * Create teacher.
     */
    public function createTeacher(Request $request): Teacher
    {
        /**
         *  Validate request
         */
        $request['phone'] = '998' . $request->phone;
        $req = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|numeric|min:9|unique:users,phone',
            'birthday' => 'required|date',
            'gender' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $teacher = $this->teachers->create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'phone' =>  $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'role' => 'teacher',
            'password' => Hash::make($request['password']),
        ]);
        return $teacher;
    }
}