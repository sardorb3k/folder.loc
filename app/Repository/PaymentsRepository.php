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
        $groups = $this->groups->getAllGroupsPagination(10);
        return view('payments.index', compact('groups', 'count'));
    }
    public function show(int $id,  Request $request): RedirectResponse
    {
        // dd($request->all());
        $date = $request->input('datetime') ?? date('Y-m');
        return redirect()->route('payments.show', ['id' => $id, 'date' => $date]);
    }
    public function showPayments(int $id, $date): View
    {
        $count = $this->groups->getCountGroupStudents($id);
        $students = $this->payments->getStudents($id, $date);
        $group = $this->groups->getGroupInfoById($id);
        return view('payments.show', compact('students', 'count', 'date', 'id', 'group'));
    }

    // public function show(int $id): View
    // {
    //     $count = $this->groups->getCountGroupStudents($id);
    //     $students = $this->groups->getGroupStudents($id);
    //     return view('payments.show', compact('students', 'count', 'id'));
    // }
    public function storePayments(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'group_id' => 'required',
            'payments_date' => 'required'
        ]);
        $day = date('d');
        // Payments for each student
        foreach ($request->payments as $key => $value) {
            if ($request->amount[$key]) {
                $payment = new Payment();
                $payment->student_id = $key;
                $payment->payment_start = $value['start'];
                $payment->payment_end = $value['end'];
                // amount
                $payment->amount =  (int) str_replace(',', '', $request->amount[$key]);
                $payment->group_id = $request->group_id;
                $payment->payment_date = $request->payments_date . '-' . $day;
                $payment->user_id = auth()->user()->id;
                $payment->save();
            }
        }
        return redirect()->route('payments.index');
    }

    public function updatePayments(Request $request, int $id): RedirectResponse
    {
        // validation request
        $request->validate([
            'amount' => 'required',
            'group_id' => 'required',
            'payments' => 'required',
            'payments_date' => 'required'
        ]);
        // Payment update for each student
        if (count(array_filter($request->amount, 'is_null')) == count($request->amount)) {
            return redirect()->back()->with('success', 'O\'zgarish yo\'q.');
        }
        foreach ($request->payments as $key => $value) {
            // payment where student_id = $key and group_id = $id
            if ($request->amount[$key]) {
                $payment = Payment::where('student_id', $key)
                    ->where('group_id', $id)
                    ->whereYear('payment_date', date('Y', strtotime($request->salarydate)))
                    ->whereMonth('payment_date', date('m', strtotime($request->salarydate)))->first();

                if (isset($payment)) {
                    $payment->amount = (int) str_replace(',', '', $request->amount[$key]);
                    $payment->payment_start = $value['start'];
                    $payment->payment_end = $value['end'];
                    $payment->save();
                } else {
                    $payment = new Payment();
                    $payment->student_id = $key;
                    $payment->payment_start = $value['start'];
                    $payment->payment_end = $value['end'];
                    $day = date('d');
                    // amount
                    $payment->amount =  (int) str_replace(',', '', $request->amount[$key]);
                    $payment->group_id = $request->group_id;
                    $payment->payment_date = $request->payments_date . '-' . $day;
                    $payment->user_id = auth()->user()->id;
                    $payment->save();
                }
            }
        }

        return redirect()->back()->with('success', 'To\'lov saqlandi.');
    }
}
