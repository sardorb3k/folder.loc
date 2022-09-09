<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\GroupsRepositoryInterface;
use App\Http\Requests\StoreGroupsRequest;
use App\Http\Requests\UpdateGroupsRequest;

class GroupsController extends Controller
{
    private $groups;

    public function __construct(GroupsRepositoryInterface $groups)
    {
        $this->groups = $groups;
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
        return $this->groups->indexGroups();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->groups->createGroups();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->groups->storeGroups($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->groups->showGroups($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->groups->editGroups($id);
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
        return $this->groups->updateGroups($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->groups->destroyGroups($id);
    }

    /**
     * Group subscription students
     */
    public function subscription(Request $request)
    {
        return $this->groups->groupSubscriptionStudents($request);
    }

    /**
     * Group unsubscription students
     */
    public function unsubscribe(Request $request)
    {
        return $this->groups->groupUnsubscriptionStudents($request);
    }
}
