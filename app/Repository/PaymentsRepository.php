<?php

namespace App\Repository;

/**
 * Payments Repository
 */

use App\Models\Payments;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\PaymentsServiceInterface;
use App\Interfaces\GroupsServiceInterface;
use App\Models\GroupStudents;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Payment;
use App\Models\User;

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
        $students = User::select(['users.id', 'users.firstname', 'users.lastname', 'group_level.name as group_level', 'groups.name as group_name', 'payments.payment_end'])
            ->leftJoin('group_students', 'group_students.student_id', '=', 'users.id')
            ->leftJoin('groups', 'groups.id', '=', 'group_students.group_id')
            ->leftJoin('group_level', 'group_level.id', '=', 'groups.level')
            ->leftJoin('payments', 'payments.student_id', '=', 'users.id')
            ->where(
                [
                    ['users.status', 'active'],
                    ['users.role', 'student'],
                ]
            )
            ->where(function ($query) {
                $query->where('payment_end', '=', function ($query) {
                    $query->from('payments')
                        ->select(DB::raw('max(payment_end)'))
                        ->where('users.id', '=', DB::raw('payments.student_id'));
                })
                    ->orWhereNull('payment_end');
            })
            ->orderBy('payments.payment_end')
            ->get();
        return view('payments.index', compact('students'));
    }

    public function show(int $id,  Request $request): RedirectResponse
    {
        // dd($request->all());
        $date = $request->input('datetime') ?? date('Y-m');
        return redirect()->route('payments.show', ['id' => $id, 'date' => $date]);
    }
    public function showPayments(int $studentId, $date): View
    {
        $student = User::select('firstname', 'lastname', 'image')->where('id', $studentId)->first();
        $studentPaymentByDate =  Payment::select('amount', 'payment_start', 'payment_end')->where('student_id', $studentId)->whereMonth('payment_start', date('m', strtotime($date)))->first();
        $studentPayments = Payment::where('student_id', $studentId)->latest()->get();
        return view('payments.show', compact('studentPayments', 'student', 'studentPaymentByDate', 'date', 'studentId'));
    }

    public function updatePayments(Request $request, int $studentId): RedirectResponse
    {
        // validation request
        $request->validate([
            'payment_amount' => 'required',
            'payment_start_date' => 'required',
            'payments_date' => 'required'
        ]);
        $payment = Payment::where('student_id', $studentId)
            ->whereYear('payment_date', date('Y', strtotime($request->payments_date)))
            ->whereMonth('payment_date', date('m', strtotime($request->payments_date)))->first();

        if (isset($payment)) {
            // update payment
            $payment->amount = (int) str_replace(',', '', $request->payment_amount);
            $payment->payment_start = $request->payment_start_date;
            $payment->payment_end = $request->payment_end_date;
            $payment->save();
        } else {
            // create payment
            $payment = new Payment();
            $payment->student_id = $studentId;
            $payment->amount = (int) str_replace(',', '', $request->payment_amount);
            $payment->payment_start = $request->payment_start_date;
            $payment->payment_end = $request->payment_end_date;
            $payment->group_id = GroupStudents::select('group_id')->where('student_id', $studentId)->first()->group_id;
            $payment->payment_date = $request->payments_date . '-' . date('d');
            $payment->user_id = auth()->user()->id;
            $payment->save();
        }

        return redirect()->back()->with('success', 'To\'lov saqlandi.');
    }
}
