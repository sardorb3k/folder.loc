<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\GroupLevel;
use App\Models\CourseItem;

class CourseController extends Controller
{
    // Index
    public function index()
    {
        $courses = Course::where('status', '1')->get();
        return view('course.index', compact('courses'));
    }
    // Create
    public function create($id)
    {
        $courses = Course::where('status', '1')->get();
        $levels = GroupLevel::where('status', '1')->get();
        return view('course.create', compact('levels','id'));
    }
    // show
    public function show($id)
    {
        $courses = CourseItem::where('status', 'active')->where('course', $id)->get();
        return view('course.show', compact('courses','id'));
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'videolink' => 'required',
        ]);
        $courseitem = new CourseItem();
        $courseitem->name = $request->name;
        $courseitem->videolink = $request->videolink;
        $courseitem->course = $request->id;
        $courseitem->status = 'active';
        $courseitem->save();
        return redirect()->route('course.show', $request->id)->with('success', 'Create Successfully');
    }
    // course
    public function course($id, $courseitem)
    {
        $course = CourseItem::findOrFail($courseitem)->where('status', 'active')->where('course', $id)->first();
        return view('course.course', compact('course'));
    }
}
