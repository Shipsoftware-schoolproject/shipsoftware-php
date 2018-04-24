<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GPS extends Model
{
    /**
     * The table associated with this model
     *
     * @var string
     */
    protected $table = 'GPS';

    /**
     * The table primary key
     *
     * @var string
     */
    protected $primaryKey = 'IMO';

    /* Timestamps */
    const CREATED_AT = 'UpdatedTime';
    const UPDATED_AT = 'UpdatedTime';

    /**
     * Get the ship that owns the GPS location.
     */
    public function ship()
    {
        return $this->belongsTo('App\Ship', 'IMO');
    }
}
