<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupStudentsRequest;
use App\Http\Requests\UpdateGroupStudentsRequest;
use App\Models\GroupStudents;

class GroupStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupStudentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupStudentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupStudents  $groupStudents
     * @return \Illuminate\Http\Response
     */
    public function show(GroupStudents $groupStudents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupStudents  $groupStudents
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupStudents $groupStudents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupStudentsRequest  $request
     * @param  \App\Models\GroupStudents  $groupStudents
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupStudentsRequest $request, GroupStudents $groupStudents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupStudents  $groupStudents
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupStudents $groupStudents)
    {
        //
    }
}
