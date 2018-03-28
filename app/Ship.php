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
     * Get the GPS location for ship.
     */
    public function gps()
    {
        return $this->hasMany('App\GPS', 'IMO');
    }

    public function latestGps()
    {
        return $this->hasOne('App\GPS', 'IMO')->latest('UpdatedTime');
    }

    /**
     * Get the type of this ship.
     */
    public function type()
    {
        return $this->hasOne('App\ShipTypes');
    }
}
