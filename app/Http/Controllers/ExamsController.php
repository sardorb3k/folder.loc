<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Interfaces\ExamsRepositoryInterface;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    private $examRepository;
    /**
     * Constructor
     */
    public function __construct(ExamsRepositoryInterface $examRepository)
    {
        $this->examRepository = $examRepository;
        /**
         * Middleware
         */
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Exam Repository indexRepository
         */
        return $this->examRepository->indexExams();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /**
         * Exam Repository createRepository
         */
        return $this->examRepository->createExams($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Exam Repository storeRepository
         */
        return $this->examRepository->storeExams($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         * Exam Repository showRepository
         */
        return $this->examRepository->showExams($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         * Exam Repository editRepository
         */
        return $this->examRepository->editExams($id);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Exam Repository updateRepository
         */
        return $this->examRepository->updateExams($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         * Exam Repository destroyRepository
         */
        return $this->examRepository->destroyExams($id);
    }
}
