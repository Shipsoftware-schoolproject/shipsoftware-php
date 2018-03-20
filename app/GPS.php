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
}
