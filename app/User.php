<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 * @property int $RoleID
 * @property int $UserID
 * @property string $Username
 * @property string $Email
 * @property string $Password
 * @property string $FirstName
 * @property string $LastName
 * @property string Phone
 * @property string Picture
 * @property string RememberME
 * @property int Created
 * @property string Updated
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Name of the users table
     *
     * @var string
     */
    protected $table = 'Users';

    /**
     * Users table primary key
     *
     * @var string
     */
    protected $primaryKey = 'UserID';

    /**
     * Username column
     *
     * @var string
     */
    protected $username = 'Email';

    /* Timestamps */
    const CREATED_AT = 'Created';
    const UPDATED_AT = 'Updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RoleID', 'CompanyID', 'Username', 'Email', 'Password', 'FirstName',
        'LastName', 'Phone', 'Picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password', 'RememberME'
    ];

    /**
     * Validation rules
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'RoleID' => 'exists:Roles,ID',
            'CompanyID' => 'exists:Companies,ID',
            'Username' => 'string|min:3|max:30|unique:Users,Username',
            'Email' => 'email|unique:Users,Email',
            'Password' => 'min:6',
            'FirstName' => 'string|min:2|max:30',
            'LastName' => 'string|min:3|max:30',
            'Phone' => 'nullable|max:20',
            'Picture' => 'nullable|mimes:jpg,jpeg'
        ];
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'RememberME';
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->Password;
    }

    /**
     * Get the role associated to the user
     */
    public function role()
    {
        return $this->hasOne('App\Role', 'ID', 'RoleID');
    }

    /**
     * Get the company associated to the user
     */
    public function company()
    {
        return $this->hasOne('App\Company', 'ID', 'CompanyID');
    }

    /**
     * Check is the current user Admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        $role = Role::where('ID', $this->RoleID)->first();

        if ($role->Name == 'Admin') {
            return true;
        }

        return false;
    }

    /**
     * Check is the current user secretary
     * @return bool
     */
    public function isSecretary()
    {
        $role = Role::where('ID', $this->RoleID)->first();

        if ($role->Name == 'Sihteeri') {
            return true;
        }

        return false;
    }
}
