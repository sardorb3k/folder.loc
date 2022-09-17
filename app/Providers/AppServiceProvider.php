<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Bind the interface to the implementation.
         */
        // Group Repository
        $this->app->bind(
            'App\Interfaces\GroupsRepositoryInterface',
            'App\Repository\GroupsRepository'
        );
        // Group Service
        $this->app->bind(
            'App\Interfaces\GroupsServiceInterface',
            'App\Services\GroupsService'
        );
        // Teacher Repository
        $this->app->bind(
            'App\Interfaces\TeachersRepositoryInterface',
            'App\Repository\TeachersRepository'
        );
        // Teacher Service
        $this->app->bind(
            'App\Interfaces\TeachersServiceInterface',
            'App\Services\TeachersService'
        );
        // Student Repository
        $this->app->bind(
            'App\Interfaces\StudentsRepositoryInterface',
            'App\Repository\StudentsRepository'
        );
        // Student Service
        $this->app->bind(
            'App\Interfaces\StudentsServiceInterface',
            'App\Services\StudentsService'
        );

        // Exams Repository
        $this->app->bind(
            'App\Interfaces\ExamsRepositoryInterface',
            'App\Repository\ExamsRepository'
        );
        // Exams Service
        $this->app->bind(
            'App\Interfaces\ExamsServiceInterface',
            'App\Services\ExamsService'
        );
        // Salary Repository
        $this->app->bind(
            'App\Interfaces\SalaryRepositoryInterface',
            'App\Repository\SalaryRepository'
        );
        // Payments Repository
        $this->app->bind(
            'App\Interfaces\PaymentsRepositoryInterface',
            'App\Repository\PaymentsRepository'
        );
        // Payments Service
        $this->app->bind(
            'App\Interfaces\PaymentsServiceInterface',
            'App\Services\PaymentsService'
        );
        // Attendance Repository
        $this->app->bind(
            'App\Interfaces\AttendanceRepositoryInterface',
            'App\Repository\AttendanceRepository'
        );
        // Attendance Service
        $this->app->bind(
            'App\Interfaces\AttendanceServiceInterface',
            'App\Services\AttendanceService'
        );
        // Salary Service
        $this->app->bind(
            'App\Interfaces\SalaryServiceInterface',
            'App\Services\SalaryService'
        );
        // Salary Repository
        $this->app->bind(
            'App\Interfaces\SalaryRepositoryInterface',
            'App\Repository\SalaryRepository'
        );
        // Dashboard Repository
        $this->app->bind(
            'App\Interfaces\DashboardRepositoryInterface',
            'App\Repository\DashboardRepository'
        );
        // Settings Repository
        $this->app->bind(
            'App\Interfaces\SettingsRepositoryInterface',
            'App\Repository\SettingsRepository'
        );
        // Settings Service
        $this->app->bind(
            'App\Interfaces\SettingsServiceInterface',
            'App\Services\SettingsService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap('default');
    }
}
