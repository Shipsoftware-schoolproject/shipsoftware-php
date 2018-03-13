<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
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
