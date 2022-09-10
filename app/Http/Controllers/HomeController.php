<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user_id = Auth::user();
        // return $user_id."Salom";


        // $students = GroupItems::join('users', 'group_items.student_id', '=', 'users.id')->select("users.id", "group_items.id as group_id", "users.lastname", "users.firstname", "users.phone")->where('group_id', $group->id)->get();
        $groups = DB::select(DB::raw("select student_id, g.name,
        concat(uo.lastname, ' ', uo.firstname) as assistant,
        concat(ut.lastname, ' ', ut.firstname) as teacher
        from group_items
            inner join groups g on group_items.group_id = g.id
            inner JOIN users as uo ON g.teacher_id = uo.id
            LEFT JOIN users as ut ON g.assistant_id = ut.id
        where student_id = :user_id;"),
    [
        'user_id' => $user_id
    ]);

        return view('dashboard.student', compact('groups'));
    }
}
