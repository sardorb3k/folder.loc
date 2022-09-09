<?php
namespace App\Repository;
use App\Interfaces\ExamsRepositoryInterface;
use App\Interfaces\GroupsServiceInterface;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Requests\StoreExamRequest;
use Illuminate\Http\RedirectResponse;
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
        return view('exams.show');
    }

    /**
     * @return View
     */
    public function createExams(Request $request): View
    {
        // Group information
        $group = $this->groupService->getGroupInfoById($request->group_id);
        // Group count for select
        $count = $this->groupService->getCountGroupStudents($request->group_id);
        // Group list for select
        $students = $this->groupService->getGroupStudents($request->group_id);
        // dd($request->all());
        $exam_type = $request->exam;

        return view('exams.create', compact('count', 'students', 'group', 'exam_type'));
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
    public function updateExams(Request $request,int $id): RedirectResponse
    {
        $update = $this->examsService->updateResults($request, $id);
        return redirect()->route('exams.index');
    }
}
