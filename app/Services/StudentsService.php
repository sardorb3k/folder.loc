<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\StudentsServiceInterface;
use App\Http\Requests\UpdateStudentsRequest;
use App\Http\Requests\StoreStudentsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Student;


class StudentsService implements StudentsServiceInterface
{
    private $students;
    public function __construct(Student $students)
    {
        $this->students = $students;
    }
    public function getAllStudents()
    {
        // student where role = 'student'
        return $this->students->where('role', 'student')->get();
    }
    /**
     * Get All Students Paginated.
     * @param int $perPage
     * @return \Illuminate\Http\Response
     */
    public function getAllStudentsPaginated(int $perPage): LengthAwarePaginator
    {
        return $this->students->where('role', 'student')
            ->latest()
            ->paginate($perPage);
    }
    public function getCountStudents(): int
    {
        return $this->students->where('role', 'student')->count();
    }
    public function getStudentById($id)
    {
        return $this->students->findOrFail($id);
    }


    /**
     * Update teacher information.
     */
    public function updateStudent(Request $request, $id)
    {
        $student = $this->students->findOrFail($id);
        $student->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'status' => $request->graduation == 'on' ? 'inactive' : 'active',
        ]);
    }
    /**
     * Update password.
     */
    public function updatePassword(Request $request, $id)
    {
        /**
         * validate request
         */
        $req = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        /**
         * update password
         */
        $student = $this->students->findOrFail($id);
        $student->update([
            'password' => Hash::make($req['password']),
        ]);
    }

    public function deleteStudent($id): void
    {
        // delete student by id

        $this->students->destroy($id);
    }
    public function storeStudent(Request $request): void
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
        $students = $this->students->create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'phone' => '998' . $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'role' => 'student',
            'password' => Hash::make($request['password']),
        ]);
    }
    // Student group by id
    public function GetStudentGroupById($id)
    {
        return DB::select(
            DB::raw(
                "SELECT gp.id,gp.`name`,gp.lessontime,gp.days,gp.LEVEL,(
                    SELECT CONCAT(firstname,' ',lastname) FROM users WHERE id=gp.teacher_id) AS teacher_fullname,(
                    SELECT CONCAT(firstname,' ',lastname) FROM users WHERE id=gp.assistant_id) AS assistant_fullname FROM group_students AS gi LEFT JOIN groups AS gp ON gi.group_id=gp.id WHERE gi.student_id=:id"
            ),
            ['id' => $id]
        );
    }
}
