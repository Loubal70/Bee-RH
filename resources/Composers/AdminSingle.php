<?php

namespace Themosis\BeeRH\Composers;
use Illuminate\Support\Composer;
use WP_User_Query;

class AdminSingle extends Composer
{
    public function compose($view)
    {
        $view->with('employees', $this->getEmployees());
    }

    public function getEmployees(): array
    {
        $employees = get_users([
            'role' => 'employees',
            'orderby' => 'display_name',
        ]);

        return collect($employees)->map(function ($employee) {
            $employee->stats_link = esc_url(admin_url('admin.php?page=employee-stats&id=' . $employee->ID));
            return $employee;
        })->all();
    }
}