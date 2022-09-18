<?php

namespace App\Repository;

use App\Interfaces\ExamsRepositoryInterface;
use App\Interfaces\GroupsServiceInterface;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Requests\StoreExamRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Services\ExamsService;
use Illuminate\Http\Request;
use App\Models\ExamResults;
use Illuminate\View\View;
use App\Models\Exams;

class ExamsRepository implements ExamsRepositoryInterface
{
    private $groupService;
    private $examsService;
    public function __construct(ExamsService $examsService, GroupsServiceInterface $groupService)
    {
        $this->examsService = $examsService;
        $this->groupService = $groupService;
    }
    /**
     * @return View
     */
    public function indexExams(): View
    {
        $exams = $this->examsService->getAllExams() ?? [];
        $groups = $this->groupService->getAllGroups() ?? [];
        // $exams = [];
        // $groups = [];
        return view('exams.index', compact('exams', 'groups'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function showExams(int $id): View
    {
        // Group information
        $exam = $this->examsService->getExamById($id);
        // Group count for select
        // $students = $this->groupService->getGroupStudents($exam->group_id);
        $students = DB::select("SELECT
        group_students.student_id AS id,
        users.lastname,
        users.firstname,
        users.phone,
        users.image,
        users.birthday,
        group_students.group_id,
        (
            SELECT result FROM exam_results WHERE student_id = users.id and exam_id = $id
            ) as result
    FROM
        users
    LEFT JOIN group_students ON users.id = group_students.student_id
    WHERE
        group_students.group_id =$exam->group_id");
        // dd($students);
        $count = $this->groupService->getCountGroupStudents($exam->group_id);
        return view('exams.show', compact('exam', 'count', 'students'));
    }

    /**
     * @return View
     */
    public function createExams(Request $request): RedirectResponse
    {
        // Validation
        $request->validate([
            'group_id' => 'required',
            'exam' => 'required',
        ]);
        // Group information
        $group = $this->groupService->getGroupInfoById($request->group_id);

        $exam = new Exams;
        $exam->exam_type = $request->exam;
        $exam->group_id = $group[0]->id;
        $exam->level = $group[0]->level;
        $exam->save();

        // Redirect to exams edit page with exam id
        return redirect()->route('exams.show', $exam->id);
    }

    /**
     * @param int $id
     * @return View
     */
    public function editExams(int $id): View
    {
        // Group information
        $exam = $this->examsService->getExamById($id);
        // Group count for select
        $count = $this->groupService->getCountGroupStudents($exam->group_id);
        $students = $this->examsService->getExamResults($id);
        return view('exams.edit', compact('exam', 'students', 'count'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeExams(Request $request): RedirectResponse
    {
        $save = $this->examsService->saveResults($request);
        return redirect()->route('exams.index')->with('success', 'Exam created successfully');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroyExams(int $id): RedirectResponse
    {
        $this->examsService->deleteExam($id);
        return redirect()->route('exams.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateExams(Request $request, int $id): RedirectResponse
    {
        $update = $this->examsService->updateResults($request, $id);
        return redirect()->route('exams.index');
    }

    // getExamId
    public function getExamId(int $id, int $student_id)
    {
        $exam = $this->examsService->getExamResultsById($id, $student_id);
        // JSON response
        return response()->json(json_decode($exam));
    }

    // updateExam
    public function updateExam(Request $request, int $id, int $student_id)
    {
        // dd($request->all());
        $update = $this->examsService->updateExam($request, $id, $student_id);
        // JSON response
        return response()->json($update);
    }
}
