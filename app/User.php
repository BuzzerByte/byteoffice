<?php
namespace buzzeroffice;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use buzzeroffice\JobHistory;
use buzzeroffice\Department;
use buzzeroffice\JobTitle;
use buzzeroffice\JobCategory;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role',
        'facebook_id', 
        'google_id',
        'github_id',
        'skin',
        'f_name',
        'l_name',
        'dob',
        'marital_status',
        'country',
        'blood_group',
        'id_number',
        'religious',
        'gender',
        'terminate_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isUser(){
        return $this->role == 'user';
    }
    
    public static function login($request)
    {
        $remember = $request->remember;
        $email = $request->email;
        $password = $request->password;
        return (\Auth::attempt(['email' => $email, 'password' => $password], $remember));
    }

    public function jobHistories($id){
        return JobHistory::select('department_id')->where('employee_id',$id)->first();
    }

    public function department($id){
        $department = JobHistory::where('employee_id',$id)->exists();
        if($department){
            $deparment_id = JobHistory::where('employee_id',$id)->first()->department_id;
            return Department::where('id',$deparment_id)->first()->name;
        }else{
            return "No Job History Found";
        }
    }

    public function jobTitle($id){
        $jobTitle = JobHistory::where('employee_id',$id)->exists();
        if($jobTitle){
            $titleId = JobHistory::where('employee_id',$id)->first()->title_id;
            return JobTitle::where('id',$titleId)->first()->title;
        }else{
            return "No Job History found";
        }
    }

    public function jobCategory($id){
        $jobCategory = JobHistory::where('employee_id',$id)->exists();
        if($jobCategory){
            $jobCategoryId = JobHistory::where('employee_id',$id)->first()->category_id;
            return JobCategory::where('id',$jobCategoryId)->first()->category;
        }else{
            return "No Job History found";
        }
    }

    public function workShift($id){
        $workShift = JobHistory::where('employee_id',$id)->exists();
        if($workShift){
            $workShiftId = JobHistory::where('employee_id',$id)->first()->shift_id;
            return WorkShift::where('id',$workShiftId)->first()->name;
        }else{
            return "No Job History found";
        }
    }
}
