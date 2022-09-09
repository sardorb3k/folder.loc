<?php
namespace App\Interfaces;
use App\Http\Requests\UpdateTeachersRequest;
use App\Http\Requests\StoreTeachersRequest;
use Illuminate\Http\Request;
use App\Models\User;

interface TeachersServiceInterface
{
    public function getAllTeachers();
    public function getCountTeachers();
    public function getAllTeachersPaginated(int $perPage);
    public function getTeacherById(int $id);
    public function updateTeacher(UpdateTeachersRequest $request, int $id);
    public function updatePassword(Request $request, int $id);
    public function deleteTeacher(int $id): bool;
    public function createTeacher(Request $request);

}
