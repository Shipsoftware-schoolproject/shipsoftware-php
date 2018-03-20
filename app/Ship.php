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
}
