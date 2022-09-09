<?php
namespace App\Interfaces;
/**
 * Payments Service Interface
 */
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Payments;

interface PaymentsServiceInterface
{
    /**
     * Payments Service indexService
     */

    public function getStudents(int $id, $date);
 }
//
