<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ReceptionRepositoryInterface;
class ReceptionController extends Controller
{
    private $reception;
    public function __construct(ReceptionRepositoryInterface $reception)
    {
        $this->reception = $reception;
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
        return $this->reception->indexReception();
    }
    // Create
    public function create()
    {
        return $this->reception->createReception();
    }

    // Store
    public function store(Request $request)
    {
        return $this->reception->storeReception($request);
        return redirect()->back();
    }
}
