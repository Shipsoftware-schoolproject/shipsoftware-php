<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipType extends Model
{
    /**
     * The table associated with this model
     *
     * @var string
     */
    protected $table = 'ShipTypes';

    public function ship()
    {
        return $this->hasMany('App\Ship', 'TypeID');
    }
}
