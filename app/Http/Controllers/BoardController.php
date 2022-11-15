<?php

namespace App\Http\Controllers;

use App\Models\Boards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    // store
    public function store(Request $request)
    {
        $request->validate([
            'board_id' => 'required',
            'name' => 'required',
        ]);

        try {
            $board = new Boards();
            $board->name = $request->name;
            $board->board_id = $request->board_id;
            $board->issuer_id = Auth::user()->id;
            $board->save();

            return response()->json([
                'message' => 'Board created successfully',
                'board' => $board
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'board_id' => 'required',
        ]);
        try {
            $board = Boards::where('board_id', $request->board_id)->first();
            $board->name = $request->name;
            $board->issuer_id = Auth::user()->id;
            $board->save();

            return response()->json([
                'message' => 'Board updated successfully',
                'board' => $board
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'board_id' => 'required',
        ]);

        try {
            Boards::where('board_id', $request->board_id)->delete();
            return response()->json([
                'message' => 'Board deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
