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
use App\Models\Salary;
use App\Models\SalaryStudents;
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
     * Get all assistant.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAssistant(): Collection
    {
        return Teacher::where('role', 'assistant')->get();
    }
    /**
     * Get All Teachers Paginated.
     * @param int $perPage
     * @return \Illuminate\Http\Response
     */
    public function getAllTeachersPaginated(int $perPage)
    {
        return Teacher::where('role', 'teacher')->orWhere('role', 'assistant')
            ->latest()
            ->get();
    }

    /**
     * Get count teachers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountTeachers(): int
    {
        return Teacher::where('role', 'teacher')->orWhere('role', 'assistant')->count();
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
        // Validation request
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'imageupload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);
        // dd($request->all());
        $teacher = Teacher::findOrFail($id);

        // image upload to public/images folder and store image name to database students table
        if ($request->hasFile('imageupload')) {
            $file_path = 'uploads/teacher/' . $teacher->image;
            if ($teacher->image != null) {
                unlink($file_path);
            }
            $image = $request->file('imageupload');
            $name = $request->firstname . ' ' . $request->lastname . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/teacher');
            $image->move($destinationPath, $name);
        }
        // dd($request->all());
        $teacher->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'phone' => str_replace(["(", ")", "-", " "], "", $request->phone),
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'role' => $request->role,
            'image' => $name ?? $teacher->image,
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
        $file_path = 'uploads/teacher/' . $teacher->image;
        unlink($file_path);
        // Salary delete
        Salary::where('teacher_id', $id)->delete();
        // Salary student delete
        SalaryStudents::where('teacher_id', $id)->delete();
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
        $request['phone'] = '998' . str_replace(["(", ")", "-", " "], "", $request->phone);
        $req = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|min:9|unique:users,phone',
            'birthday' => 'required|date',
            'gender' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
            'imageupload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // image upload to public/images folder and store image name to database students table
        if ($request->hasFile('imageupload')) {
            $image = $request->file('imageupload');
            $name = time() . '-' . $request['phone'] . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/teacher');
            $image->move($destinationPath, $name);
        }

        $teacher = $this->teachers->create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'phone' =>  $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'image' => $name ?? '',
            'role' => $request->role,
            'password' => Hash::make($request['password']),
        ]);
        return $teacher;
    }
}
