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
    public function saveResults(Request $request);
    public function updateResults(Request $request, int $id);
    public function getExamById(int $id);
    public function getExamResults(int $id);
    public function deleteExam(int $id);
    public function getStudentById(int $id);
}
