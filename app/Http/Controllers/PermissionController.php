<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\File;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param $category_id
     * @return string
     */

    public function getPermissions($category_id): string
    {
        $permissions = Permission::where('category_id', '=', $category_id)->get();
        return $permissions->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * @param $category_id
     * @return false|string
     */
    public function setUploadPermission($category_id){
        $permission = Permission::where('category_id', '=', $category_id)
                                    ->where('permission_id', '=', Permission::UPLOAD_PERMISSION)->first();
        if ($permission){
            $permission->delete();
            return json_encode(false);
        } else {
            Permission::create([
                'category_id' => $category_id,
                'permission_id' => Permission::UPLOAD_PERMISSION
            ]);
            return json_encode(true);
        }
    }

    /**
     * @param $category_id
     * @return false|string
     */
    public function setDownloadPermission($category_id){
        $permission = Permission::where('category_id', '=', $category_id)
            ->where('permission_id', '=', Permission::DOWNLOAD_PERMISSION)->first();
        if ($permission){
            $permission->delete();
            return json_encode(false);
        } else {
            Permission::create([
                'category_id' => $category_id,
                'permission_id' => Permission::DOWNLOAD_PERMISSION
            ]);
            return json_encode(true);
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function searchFileByName($name){
        return \count(File::where('name', '=', $name)->get('version'));
    }
}
