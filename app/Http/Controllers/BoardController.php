<?php

namespace App\Http\Controllers;

use App\Models\Boards;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    // store
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'id' => 'required',
        ]);

        $board = new Boards();
        $board->name = $request->title;
        $board->data_id = $request->id;
        $board->issue_id = 1;
        $board->save();

        // json response
        return response()->json([
            'message' => 'Board created successfully',
            'board' => $board
        ], 201);
    }
    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'id' => 'required',
        ]);

        $board = Boards::where('data_id', $id)->first();
        $board->name = $request->title;
        $board->issue_id = 1;
        $board->save();

        // json response
        return response()->json([
            'message' => 'Board updated successfully',
            'board' => $board
        ], 200);
    }
}
