<?php

namespace App;

use App\Office;
use App\Office2;
use App\Position;
use App\OfficeCharging;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = 'Employee_id';
    protected $table = 'Employees';
    public $with = ['position', 'office_charging', 'office_assignment', 'office'];
    public $keyType = 'string';

    protected $columns = [
        'Employee_id',
        'LastName',
        'FirstName',
        'MiddleName',
        'Suffix',
        'OfficeCode',
        'OfficeCode2',
        'PosCode',
        'Designation',
        'Gender',
        'CivilStatus',
        'Birthdate',
        'Address',
        'ContactNumber',
        'TimeCode',
        'ImagePhoto',
        'isActive',
        'isHead',
        'Work_Status',
        'pagibig_no',
        'philhealth_no',
        'sss_no',
        'tin_no',
        'lbp_account_no',
        'employment_from',
        'employment_to',
        'gsis_no',
        'dbp_account_no',
        'Email_address',
        'BirthPlace',
        'sg_no',
        'step',
        'salary_rate',
        'notes',
        'temp_id',
        'profile',
        'sg_year',
        'created_at',
        'updated_at',
        'civil_status_others',
        'height',
        'weight',
        'blood_type',
        'gsis_policy_no',
        'gsis_bp_no',
        'agency_employee_no',
        'citizenship',
        'citizenship_by',
        'indicate_country',
        'residential_house_no',
        'residential_street',
        'residential_village',
        'residential_barangay',
        'residential_city',
        'residential_province',
        'residential_zip_code',
        'permanent_house_no',
        'permanent_street',
        'permanent_village',
        'permanent_barangay',
        'permanent_city',
        'permanent_province',
        'permanent_zip_code',
        'telephone_no',
        'first_day_of_service',
        'office_code',
        'last_step_increment'
    ];

    protected $fillable = [
        'Employee_id',
        'LastName',
        'FirstName',
        'MiddleName',
        'Suffix',
        'OfficeCode',
        'OfficeCode2',
        'PosCode',
        'Designation',
        'Gender',
        'CivilStatus',
        'Birthdate',
        'Address',
        'ContactNumber',
        'TimeCode',
        'ImagePhoto',
        'isActive',
        'isHead',
        'Work_Status',
        'pagibig_no',
        'philhealth_no',
        'sss_no',
        'tin_no',
        'lbp_account_no',
        'employment_from',
        'employment_to',
        'gsis_no',
        'dbp_account_no',
        'Email_address',
        'BirthPlace',
        'sg_no',
        'step',
        'salary_rate',
        'notes',
        'temp_id',
        'profile',
        'sg_year',
        'created_at',
        'updated_at',
        'civil_status_others',
        'height',
        'weight',
        'blood_type',
        'gsis_policy_no',
        'gsis_bp_no',
        'agency_employee_no',
        'citizenship',
        'citizenship_by',
        'indicate_country',
        'residential_house_no',
        'residential_street',
        'residential_village',
        'residential_barangay',
        'residential_city',
        'residential_province',
        'residential_zip_code',
        'permanent_house_no',
        'permanent_street',
        'permanent_village',
        'permanent_barangay',
        'permanent_city',
        'permanent_province',
        'permanent_zip_code',
        'telephone_no',
        'first_day_of_service',
        'office_code',
        'last_step_increment'
    ];

    public $appends = [
        'fullname'
    ];


    public function getFullnameAttribute()
    {
        return "{$this->FirstName} " . substr($this->MiddleName, 0, 1) . ". {$this->LastName}" . " {$this->Suffix}";
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'PosCode', 'PosCode')->withDefault();
    }

    public function office()
    {
        return $this->hasOne(Office::class, 'OfficeCode', 'OfficeCode')->withDefault();
    }

    public function office_charging()
    {
        return $this->hasOne(OfficeCharging::class, 'OfficeCode', 'OfficeCode')->withDefault();
    }

    public function office_assignment()
    {
        return $this->hasOne(Office2::class, 'OfficeCode2', 'OfficeCode2')->withDefault();
    }

    public function scopeExclude($query, array $value = [])
    {
        return $query->select(array_diff($this->columns, $value));
    }

    public function scopeInActive($query)
    {
        return $query->where('isActive', self::IN_ACTIVE);
    }

    public function scopePermanent($query)
    {
        return $query->where('Work_Status', 'not like', '%' . 'JOB ORDER' . '%')
            ->where('Work_Status', 'not like', '%' . 'CONTRACT OF SERVICE' . '%')
            ->where('Work_Status', '!=', '');
    }
}
