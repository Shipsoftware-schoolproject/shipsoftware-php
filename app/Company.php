<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The table associated with this model
     *
     * @var string
     */
    protected $table = 'Companies';
	public function ship()
	{
		return $this->hasMany('App\Ship', 'CompanyID');
	}
}
