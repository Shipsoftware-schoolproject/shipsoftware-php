<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
    /**
     * The table associated with this model
     *
     * @var string
     */
    protected $table = 'Roles';

    /**
     * Table's primary key
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
     * Get role name by it's ID
     *
     * @param $id
     * @return mixed
     */
    public function getName($id)
    {
        return DB::table('Roles')->where('ID', $id)->first();
    }
}
