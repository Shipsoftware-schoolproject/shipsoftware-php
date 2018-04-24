<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table associated with this model
     *
     * @var string
     */
    protected $table = 'Country';

    /**
     * The table primary key
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
        'Name'
    ];

    /**
     * Validation rules
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'Name' => 'required|max:36|unique:Country,Name'
        ];
    }
}
