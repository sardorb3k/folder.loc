<?php
namespace App\Interfaces;

// Exams Repository Interface
use App\Http\Requests\UpdateExamRequest;
use App\Http\Requests\StoreExamRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Exams;

/**
 * Interface ExamsRepositoryInterface
 * @package App\Interfaces
 */
interface ExamsRepositoryInterface
{
    /**
     * @return View
     */
    public function indexExams(): View;

    /**
     * @param int $id
     * @return View
     */
    public function showExams(int $id): View;

    /**
     * @return View
     */
    public function createExams(Request $request): View;

    /**
     * @param int $id
     * @return View
     */
    public function editExams(int $id): View;

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeExams(Request $request): RedirectResponse;

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroyExams(int $id): RedirectResponse;

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateExams(Request $request, int $id): RedirectResponse;

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    // public function groupSubscriptionExams(Request $request): RedirectResponse;

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    // public function groupUnsubscriptionExams(Request $request): RedirectResponse;
}

