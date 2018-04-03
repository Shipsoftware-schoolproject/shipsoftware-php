<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    const CREATED_AT = 'Created';
    const UPDATED_AT = 'Updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
        $role = new Role;

        if ($role->getName($this->RoleID)) {
            return true;
        }

        return false;
    }
}
