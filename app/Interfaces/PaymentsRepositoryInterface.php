<?php
namespace App\Interfaces;
/**
 * Payments Repository Interface
 */
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Payments;

interface PaymentsRepositoryInterface
{
    /**
     * Payments Repository indexRepository
     */
    public function indexPayments(): View;
    public function show(int $id, Request $request): RedirectResponse;
    public function showPayments(int $id, $date): View;
    public function storePayments(Request $request): RedirectResponse;
    public function updatePayments(Request $payments, int $id): RedirectResponse;
}
//
