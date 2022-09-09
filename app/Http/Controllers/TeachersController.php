<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeachersRequest;
use App\Http\Requests\UpdateTeachersRequest;
use App\Interfaces\TeachersRepositoryInterface;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    private $teachers;
    /**
     *  Constructor.
     */
    public function __construct(TeachersRepositoryInterface $teachers)
    {
        // Services
        $this->teachers = $teachers;
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
        return $this->teachers->indexTeachers();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->teachers->createTeachers();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeachersRequest $request)
    {
        return $this->teachers->storeTeachers($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->teachers->showTeachers($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->teachers->editTeachers($id);
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
        return $this->teachers->updateTeachers($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->teachers->destroyTeachers($id);
    }
}
