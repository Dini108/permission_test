<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $fillable = ['category_id', 'permission_id'];

    public const UPLOAD_PERMISSION = 1;
    public const DOWNLOAD_PERMISSION = 2;
    /**
     * Get the index name for the model.
     *
     * @return string
     */

    public function childs()
    {
        return $this->hasOne('App\Category', 'category_id', 'id');
    }
}
