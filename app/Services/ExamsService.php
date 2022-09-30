<?php

namespace App\Services;

use App\Interfaces\ExamsServiceInterface;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Requests\StoreExamRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ExamResults;
use Illuminate\View\View;
use App\Models\Exams;

class ExamsService implements ExamsServiceInterface
{
    private $exams;
    public function __construct(Exams $exams)
    {
        $this->exams = $exams;
    }
    /**
     * Exams Repository indexRepository
     */
    public function getAllExams()
    {
        try {
            $crm_exam_pass = DB::select('SELECT exam_pass FROM settings WHERE id = 1')[0]->exam_pass;
            $exams = $this->exams
                ->leftJoin('groups', 'groups.id', '=', 'exams.group_id')
                ->select(DB::raw('(SELECT COUNT(*) FROM exam_results WHERE result >= ' . $crm_exam_pass . ' AND exam_id = exams.id) AS accepted'), DB::raw('(SELECT COUNT(*) FROM exam_results WHERE result < ' . $crm_exam_pass . ' AND exam_id = exams.id) AS notaccepted'), 'exams.*')
                ->latest('exams.created_at')
                ->get();
            return $exams;
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }

    /**
     * Save exam results
     */
    public function saveResults(Request $request)
    {
        // Table Exams create new exam
        $exam = new Exams;
        $exam->exam_type = $request->exam_type;
        $exam->group_id = $request->group_id;
        $exam->level = $request->level;
        $exam->save();

        // Table ExamResults create new exam results for each student key => value
        foreach ($request->students as $key => $value) {
            $exam_result = new ExamResults;
            $exam_result->student_id = $key;
            $exam_result->exam_id = $exam->id;
            $exam_result->mark = $value;
            $exam_result->save();
        }
    }
    /**
     * Update exam results
     */
    public function updateResults(Request $request, int $id)
    {
        // Table ExamResults update exam results for each student key => value
        foreach ($request->students as $key => $value) {
            $exam_result = ExamResults::where('exam_id', $id)->where('student_id', $key)->first();
            $exam_result->mark = $value;
            $exam_result->save();
        }
    }

    /**
     * Get exam by id
     */
    public function getExamById(int $id)
    {
        try {
            $exam = DB::select(
                DB::raw(
                    "SELECT ex.id,gp.`name` AS group_name,gp.id AS group_id,ex.exam_type,ex.`level`,(
                    SELECT COUNT(*) FROM exam_results WHERE exam_results.exam_id=ex.id AND exam_results.mark=1) AS accepted,(
                    SELECT COUNT(*) FROM exam_results WHERE exam_results.exam_id=ex.id AND exam_results.mark=0) AS notaccepted FROM exams AS ex LEFT JOIN groups AS gp ON gp.id=ex.group_id WHERE ex.id=:examid;"
                ),
                ['examid' => $id]
            );
            return $exam[0];
        } catch (\Exception $e) {
            return false;
        }
    }

    // Get exam results by exam id
    public function getExamResultsById(int $id, int $student_id)
    {
        try {
            $exam_results = DB::select(
                DB::raw(
                    "SELECT mark FROM `exam_results` WHERE exam_id = :examid and student_id = :studentid limit 1;"
                ),
                [
                    'examid' => $id,
                    'studentid' => $student_id
                ]
            );
            return $exam_results[0]->mark;
        } catch (\Exception $e) {
            return false;
        }
    }

    // updateExam
    public function updateExam(Request $request, int $id, int $student_id)
    {
        try {
            // Create exam results
            // Table ExamResults create new exam results for each student key => value

            $exam_result = ExamResults::where('exam_id', $id)->where('student_id', $student_id)->first();
            if ($exam_result) {
                $exam_result->mark = json_encode($request->mark);
                $exam_result->result = $request->result;
                $exam_result->save();
            } else {
                $exam_result = new ExamResults;
                $exam_result->student_id = $student_id;
                $exam_result->exam_id = $id;
                $exam_result->result = $request->result;
                $exam_result->mark = json_encode($request->mark);
                $exam_result->save();
            }
            // return json success message
            return response()->json(['success' => 'Exam results updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }














    /**
     * Get exam results by id
     */
    public function getExamResults(int $id)
    {
        try {
            // Table ExamResults get exam results by exam id
            $exam_result = DB::select(
                DB::raw(
                    "SELECT ex.id AS id,us.id AS user_id,CONCAT(us.firstname,' ',us.lastname) AS fullname,us.phone AS phone,us.birthday AS birthday,ex.mark AS mark FROM exam_results AS ex LEFT JOIN users AS us ON us.id=ex.student_id WHERE ex.exam_id=:examid;"
                ),
                ['examid' => $id]
            );
            return $exam_result;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Delete exam
     */
    public function deleteExam(int $id)
    {
        // Table ExamResults delete exam results by exam id
        $exam_result = ExamResults::where('exam_id', $id)->delete();
        // Table Exams delete exam by id
        $exam = Exams::where('id', $id)->delete();
    }

    /**
     * Get student by id
     */
    public function getStudentById(int $id)
    {
        try {
            $student = DB::select(
                DB::raw(
                    "SELECT er.id,ex.`level`,ex.created_at,er.result,gp.`name`,gp.lessonstarttime,gp.days, gp.id as group_id,(
                        SELECT CONCAT(firstname,' ',lastname) FROM users WHERE id=gp.teacher_id) AS teacher_id,(
                        SELECT CONCAT(firstname,' ',lastname) FROM users WHERE id=gp.assistant_id) AS assistant_id FROM exam_results AS er LEFT JOIN exams AS ex ON ex.id=er.exam_id LEFT JOIN groups AS gp ON gp.id=ex.group_id WHERE er.student_id=:studentid;"
                ),
                ['studentid' => $id]
            );
            return $student ?? [];
        } catch (\Exception $e) {
            return false;
        }
    }
}
