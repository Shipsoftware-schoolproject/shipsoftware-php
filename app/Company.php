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

    /**
     * Table primary key
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * Table has timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name', 'MailingAddress', 'ZipCode', 'City', 'IsPort', 'CountryID'
    ];

    /**
     * Validation rules
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'Name' => 'required|max:100|unique:Companies,Name',
            'MailingAddress' => 'nullable|max:85',
            'ZipCode' => 'nullable|numeric',
            'City' => 'nullable|string|max:85',
            'CountryID' => 'exists:Country,ID'
        ];
    }

    /**
     * Company has many ships
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function ship()
	{
		return $this->hasMany('App\Ship', 'CompanyID');
	}

    /**
     * Company is associated with one country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
	public function country()
    {
        return $this->hasOne('App\Country', 'ID', 'CountryID');
    }
}
