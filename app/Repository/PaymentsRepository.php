<?php

namespace App\Repository;

/**
 * Payments Repository
 */

use App\Models\Payments;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\PaymentsServiceInterface;
use App\Interfaces\GroupsServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Payment;
class PaymentsRepository implements PaymentsRepositoryInterface
{
    private $payments;
    private $groups;
    public function __construct(PaymentsServiceInterface $payments, GroupsServiceInterface $groups)
    {
        $this->payments = $payments;
        $this->groups = $groups;
    }
    /**
     * Payments Repository indexRepository
     */
    public function indexPayments(): View
    {
        $count = $this->groups->getCountGroups();
        $groups = $this->groups->getAllGroups();
        return view('payments.index', compact('groups', 'count'));
    }
    public function show(int $id,  Request $request):RedirectResponse{
        // dd($request->all());
        $date = $request->input('datetime') ?? date('Y-m');
        return redirect()->route('payments.show', ['id' => $id, 'date' => $date]);
    }
    public function showPayments(int $id, $date): View{
        $count = $this->groups->getCountGroupStudents($id);
        $students = $this->payments->getStudents($id, $date);
        return view('payments.show', compact('students', 'count', 'date', 'id'));
    }

    // public function show(int $id): View
    // {
    //     $count = $this->groups->getCountGroupStudents($id);
    //     $students = $this->groups->getGroupStudents($id);
    //     return view('payments.show', compact('students', 'count', 'id'));
    // }
    public function storePayments(Request $request): RedirectResponse
    {
        // dd($request->all());
        // Payments for each student
        foreach ($request->payments as $key => $value) {
            $payment = new Payment();
            $payment->student_id = $key;
            $payment->payment_start = $value['start'] ?? null;
            $payment->payment_end = $value['end'] ?? null;
            // amount
            $payment->amount = $request['amount'] ?? null;
            $payment->group_id = $request->group_id;
            $payment->payment_date = $request->payments_date.'-02';
            $payment->user_id = auth()->user()->id;
            $payment->save();
        }
        return redirect()->route('payments.index');
    }
    public function updatePayments(Request $payments, int $id): RedirectResponse
    {
        // Payment update for each student
        foreach ($payments->payments as $key => $value) {
            // payment where student_id = $key and group_id = $id
            $payment = Payment::where('student_id', $key)->where('group_id', $id)->where('payment_date', $payments->salarydate)->first();
            // amount
            $payment->amount = $payments['amount'] ?? null;
            $payment->payment_start = $value['start'] ?? null;
            $payment->payment_end = $value['end'] ?? null;
            $payment->save();
        }
        return redirect()->route('payments.index');
    }
}
//
