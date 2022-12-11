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
            'name' => 'required',
        ]);

        try {
            $board = new Boards();
            $board->name = $request->name;
            $board->order_number = Boards::max('order_number') ?? 1;
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
            'color' => 'required',
            'id' => 'required',
        ]);
        try {
            $board = Boards::where('id', $request->id)->first();
            $board->name = $request->name;
            $board->color = $request->color;
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
            'id' => 'required',
        ]);

        try {
            Boards::where('id', $request->id)->delete();
            return response()->json([
                'message' => 'Board deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }


    public function reorder(Request $request)
    {
        $request->validate([
            'boardIds' => 'required',
        ]);
        $boards = json_decode($request->boardIds);
        try {
            for ($i = 0; $i < count($boards); $i++) {
                $board = Boards::find($boards[$i]);
                $board->order_number = $i + 1;
                $board->save();
            }
            return response()->json([
                'message' => 'Board updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
