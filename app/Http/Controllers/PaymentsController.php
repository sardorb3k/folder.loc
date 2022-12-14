<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Interfaces\PaymentsRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportPayment;

class PaymentsController extends Controller
{
    private $paymentService;
    public function __construct(PaymentsRepositoryInterface $paymentService)
    {
        $this->paymentService = $paymentService;
        // Middleware
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->paymentService->indexPayments();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show_red($id, Request $request)
    {
        return $this->paymentService->show($id, $request);
    }
    public function show($id, $date)
    {
        return $this->paymentService->showPayments($id, $date);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->paymentService->updatePayments($request, $id);
    }
    public function exportPayments(Request $request){
        return Excel::download(new ExportPayment, 'payments.xlsx');
        // return (new ExportPayment)->download('invoices.html', Excel::HTML);
        // return Excel::HTML->download(new ExportPayment, 'payments.html');
    }
}
