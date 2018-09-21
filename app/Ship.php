<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    /**
     * The table associated with this model
     *
     * @var string
     */
    protected $table = 'Ships';

    /**
     * The table primary key
     *
     * @var string
     */
    protected $primaryKey = 'IMO';

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
        'IMO', 'CompanyID', 'ShipName', 'TypeID', 'CommentText', 'ShipLength',
        'Width', 'Draught', 'MMSI', 'RefFront', 'RefLeft'
    ];

    /**
     * Validation rules
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'IMO' => 'integer|digits_between:3,7',
            'CompanyID' => 'nullable|exists:Companies,ID',
            'ShipName' => 'required|max:40',
            'TypeID' => 'exists:ShipTypes,ID',
            'CommentText' => 'nullable|max:100',
            'ShipLength' => 'required|numeric',
            'Width' => 'required|numeric',
            'Draught' => 'required|numeric',
            'MMSI' => 'required|integer',
            'RefFront' => 'nullable|integer',
            'RefLeft' => 'nullable|integer'
        ];
    }

    /**
     * Get ship GPS history
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gps()
    {
        return $this->hasMany('App\GPS', 'IMO');
    }

    /**
     * Get ship latest GPS location
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function latestGps()
    {
        return $this->hasOne('App\GPS', 'IMO')->latest('UpdatedTime')->withDefault([
            'Lat' => 0,
            'Lng' => 0,
            'UpdatedTime' => 0
        ]);
    }

    /**
     * Get ship type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne('App\ShipType', 'ID', 'TypeID');
    }

    /**
     * Get company associated with the ship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne('App\Company', 'ID', 'CompanyID')->with('Country');
    }
}
