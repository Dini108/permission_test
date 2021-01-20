<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
      public $fillable = ['name','path','version','category_id','user_id'];

    /**

     * Get the index name for the model.

     *

     * @return string

     */

    public function childs() {

        return $this->hasOne('App\Category','category_id','id') ;

    }

    public function user()
    {
        return $this->hasOne('App\User','id','user_id') ;
    }
}
