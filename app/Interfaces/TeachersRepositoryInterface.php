<?php
namespace App\Interfaces;
use App\Http\Requests\StoreTeachersRequest;
use App\Http\Requests\UpdateTeachersRequest;
use App\Models\Teacher;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Teachers Repository Interface for implementing the CRUD operations.
 */
interface TeachersRepositoryInterface {
    public function indexTeachers(): View;
    public function showTeachers(int $id): View;
    public function createTeachers(): View;
    public function editTeachers(): View;
    public function storeTeachers(StoreTeachersRequest $request): RedirectResponse;
    public function destroyTeachers(int $teachers): RedirectResponse;
    public function updateTeachers(UpdateTeachersRequest $request, int $id): RedirectResponse;
}

