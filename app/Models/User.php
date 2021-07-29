<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'role',
        'phonenumber',
        'password',
        'tradeName',
        'itiPassed',
        'isDiplomaHolder',
        'dob',

        'fatherGuardianName',
        'motherName',
        'gender',
        'category',
        'physicallyHandicapped',
        'traineeType',
        'employeeCodePEN',
        'aadharNumber',
        'maritalStatus',
        'address',
        'certificateVerificationStatus',
        'feeVerificationStatus',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        // public function UserDocuments(){
        // return $this->belongsTo('App\Models\documents');
        // }


public function qualification(){
    return $this->hasMany(QualificationDetail::class);
}
}
