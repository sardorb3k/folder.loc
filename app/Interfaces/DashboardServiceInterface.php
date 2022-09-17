<?php
/**
 * Exams Service Interface
 * @package App\Interfaces
 */
namespace App\Interfaces;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Requests\StoreExamRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Exams;

interface ExamsServiceInterface
{
    public function getAllExams();
}
