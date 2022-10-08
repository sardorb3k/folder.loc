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
use App\Models\Attendance;
use App\Models\ExamResults;
use App\Models\GroupStudents;
use App\Models\SalaryStudents;
use App\Models\User;

class StudentsService implements StudentsServiceInterface
{
    private $students;
    public function __construct(Student $students, Attendance $attendance)
    {
        $this->students = $students;
        $this->attendance = $attendance;
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
    public function getAllStudentsPaginated(int $perPage)
    {

        return $this->students
            ->leftJoin('group_students', 'group_students.student_id', '=', 'users.id')
            ->leftJoin('groups', 'groups.id', '=', 'group_students.group_id')
            ->where('users.role', 'student')
            ->select('groups.level as group_level', 'groups.name as group_name', 'users.*')
            ->latest('users.created_at')
            ->get();
    }

    public function getCountStudents(): int
    {
        return $this->students->where('role', 'student')->count();
    }
    public function getStudentById($id)
    {
        return $this->students->findOrFail($id);
    }

    public function getStudentByAttendance($id)
    {
        return DB::select(
            DB::raw(
                "SELECT att.id, att.attendance_date, att.mark, gp.name, gp.level FROM `attendance` as att LEFT JOIN groups as gp on att.group_id = gp.id WHERE att.student_id = :id ORDER BY att.attendance_date DESC"
            ),
            ['id' => $id]
        );
    }


    /**
     * Update teacher information.
     */
    public function updateStudent(Request $request, $id)
    {
        // dd($request->all());
        // Validate request
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'homeaddress' => 'required',
            'reasontostudy' => 'required',
            'interests' => 'required',
            'hear_about' => 'required',
            'course' => 'required',
            'status' => 'required',
            'imageupload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Get student by id
        $student = $this->students->findOrFail($id);

        // image upload to public/images folder and store image name to database students table
        if ($request->hasFile('imageupload')) {
            $file_path = 'uploads/student/' . $student->image;
            if ($student->image != null) {
                unlink($file_path);
            }
            $image = $request->file('imageupload');
            $name = $request->firstname . ' ' . $request->lastname . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/student');
            $image->move($destinationPath, $name);
        }
        // Update student information
        $student->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => str_replace(["(", ")", "-", " ", "+"], "", $request->phone),
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'homeaddress' => $request->homeaddress,
            'reasontostudy' => $request->reasontostudy,
            'interests' => $request->interests,
            'hear_about' => $request->hear_about,
            'course' => $request->course,
            'image' => $name ?? $student->image,
            'status' => $request->status,
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
        // Group delete
        GroupStudents::where('student_id', $id)->delete();
        // Salary delete
        SalaryStudents::where('student_id', $id)->delete();
        ExamResults::where('student_id', $id)->delete();
    }
    public function storeStudent(Request $request): void
    {
        /**
         *  Validate request
         */
        $request['phone'] = '998' . str_replace(["(", ")", "-", " ", "+"], "", $request->phone);
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone',
            'birthday' => 'required|date',
            'gender' => 'required',
            'homeaddress' => 'required',
            'reasontostudy' => 'required',
            'interests' => 'required',
            'hear_about' => 'required',
            'course' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'imageupload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // image upload to public/images folder and store image name to database students table
        if ($request->hasFile('imageupload')) {
            $image = $request->file('imageupload');
            $name = time() . '-' . $request['phone'] . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/student');
            $image->move($destinationPath, $name);
        }
        $students = $this->students->create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'homeaddress' => $request->homeaddress,
            'reasontostudy' => $request->reasontostudy,
            'interests' => $request->interests,
            'hear_about' => $request->hear_about,
            'course' => json_encode($request->course) ?? [],
            'image' => $name ?? '',
            'role' => 'student',
            'password' => Hash::make($request['password']),
        ]);
    }
    // Student group by id
    public function GetStudentGroupById($id)
    {
        return DB::select(
            DB::raw(
                "SELECT gp.id,gp.`name`,gp.lessonstarttime,gp.days,gp.LEVEL,(
                    SELECT CONCAT(firstname,' ',lastname) FROM users WHERE id=gp.teacher_id) AS teacher_fullname,(
                    SELECT CONCAT(firstname,' ',lastname) FROM users WHERE id=gp.assistant_id) AS assistant_fullname FROM group_students AS gi LEFT JOIN groups AS gp ON gi.group_id=gp.id WHERE gi.student_id=:id"
            ),
            ['id' => $id]
        );
    }
}
