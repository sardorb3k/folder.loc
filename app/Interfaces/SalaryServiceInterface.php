<?php
namespace App\Interfaces;
/**
 * Salary Service Interface
 */
interface SalaryServiceInterface {
    /**
     * Get salary
     * @param  int $id
     * @return array
     */
    // public function getSalary($id);
    public function getGroupById($id);
    public function getStudent($id, $date);
    public function getTeacherList($date);
}
//
