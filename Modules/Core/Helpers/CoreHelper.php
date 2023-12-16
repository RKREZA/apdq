<?php
namespace Modules\Core\Helpers;

use Modules\Phase\Entities\Phase;
use Modules\ProjectForm\Entities\ProjectFormFiscalYear;

class CoreHelper
{
    public static function instance()
    {
        return new CoreHelper();
    }

    public static function filter_data($request, $data)
    {
        $data->orderBy('id', 'DESC');

        if($request->date != null){
            $data->where('date', $request->date);
        }
        if($request->status != null){
            $data->where('status','like',"%$request->status%" );
        }
        return $data;
    }

    public static function filter_data_for_admin($request, $data)
    {
        if(auth()->user()->hasRole('Admin')){
            $data->orderBy('id', 'DESC');
        }else{
            $data->where('user_id', auth()->user()->id);
        }
        return $data;
    }

    public static function filter_eligible_data_for_user($request, $query)
    {
        $user = auth()->user();

        if ($user->hasRole('User')) {
            $company_business_age = $user->company_business_age;
            $company_status = $user->company_status;
            $company_registered_for_taxes = $user->company_registered_for_taxes;
            $company_number_of_employees = $user->company_number_of_employees;
            $company_turnover = $user->company_turnover;
            $company_groups = $user->company_groups;
            $company_customer_manipulate_information = $user->company_customer_manipulate_information;
            $company_part_of_areas = $user->company_part_of_areas;
            $company_investment_areas = $user->company_investment_areas;

            $query->where(function ($query) use (
                $company_business_age,
                $company_status,
                $company_registered_for_taxes,
                $company_number_of_employees,
                $company_turnover,
                $company_groups,
                $company_customer_manipulate_information,
                $company_part_of_areas,
                $company_investment_areas,
            ) {

                if (!empty($company_business_age)) {
                    $query->where(function ($query) use ($company_business_age) {
                        $query->whereJsonContains('company_business_age', $company_business_age)
                            ->orWhereNull('company_business_age');
                    });
                }

                if (!empty($company_status)) {
                    $query->where(function ($query) use ($company_status) {
                        $query->whereJsonContains('company_status', $company_status)
                            ->orWhereNull('company_status');
                    });
                }

                if (!empty($company_registered_for_taxes)) {
                    $query->where(function ($query) use ($company_registered_for_taxes) {
                        $query->whereJsonContains('company_registered_for_taxes', $company_registered_for_taxes)
                            ->orWhereNull('company_registered_for_taxes');
                    });
                }

                if (!empty($company_number_of_employees)) {
                    $query->where(function ($query) use ($company_number_of_employees) {
                        $query->whereJsonContains('company_number_of_employees', $company_number_of_employees)
                            ->orWhereNull('company_number_of_employees');
                    });
                }

                if (!empty($company_turnover)) {
                    $query->where(function ($query) use ($company_turnover) {
                        $query->whereJsonContains('company_turnover', $company_turnover)
                            ->orWhereNull('company_turnover');
                    });
                }

                if (!empty($company_groups)) {
                    $query->where(function ($query) use ($company_groups) {
                        $query->whereJsonContains('company_groups', $company_groups)
                            ->orWhereNull('company_groups');
                    });
                }

                if (!empty($company_customer_manipulate_information)) {
                    $query->where(function ($query) use ($company_customer_manipulate_information) {
                        $query->whereJsonContains('company_customer_manipulate_information', $company_customer_manipulate_information)
                            ->orWhereNull('company_customer_manipulate_information');
                    });
                }

                if (!empty($company_part_of_areas)) {
                    $query->where(function ($query) use ($company_part_of_areas) {
                        $query->whereJsonContains('company_part_of_areas', $company_part_of_areas)
                            ->orWhereNull('company_part_of_areas');
                    });
                }

                if (!empty($company_investment_areas)) {
                    $query->where(function ($query) use ($company_investment_areas) {
                        $query->whereJsonContains('company_investment_areas', $company_investment_areas)
                            ->orWhereNull('company_investment_areas');
                    });
                }
            });

            return $query;
        }

        return $query->orderBy('id', 'DESC');
    }



}
