<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Category;
use App\File;
use App\Permission;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|Response|View
     */

    public function index()
    {
        $categories = Category::where('parent_id', '=', 0)->get();

        $allCategories = Category::all();

        return view('category.categoryTreeview',compact('categories','allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addCategory(Request $request): RedirectResponse
    {
        $permission = $this->getUploadPermission($request->category_id);
        if ($permission) {
            $this->validate($request, [
                'title' => 'required',
            ]);

            $input = $request->all();
            $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

            Category::create($input);
        }
        return back();
    }

    /**
     * @param $category_id
     * @return false|Application|Factory|View|string
     */
    public function getOperations($category_id)
    {
        $permission = $this->getUploadPermission($category_id);
        if ($permission){
            $category = Category::where('id', '=', $category_id)->first();
            return view('category/operationsView', compact('category','permission'));
        }
        return json_encode('No permission for category upload');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function editCategory(Request $request): RedirectResponse
    {
        $permission = $this->getUploadPermission($request->category_id);
        if ($permission) {
            $category = Category::findOrFail($request->category_id);
            $category->update($request->all());
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteCategory(Request $request): RedirectResponse
    {
        $permission = $this->getUploadPermission($request->category_id);
        if ($permission) {
            $category = Category::findOrFail($request->category_id);
            $asd = $category->parent_id;
            if ($category->parent_id !== 0){
                $this->findAndDeleteAllChildrenCategory($request->category_id);
                $category->delete();
            }
        }
        return back();
    }

    /**
     * @param $category_id
     * @return bool
     */
    public function findAndDeleteAllChildrenCategory($category_id): bool
    {
        $categories = Category::where('parent_id', '=', $category_id)->get();
        $permissions = Permission::where('category_id', '=', $category_id)->get();
        $files = File::where('category_id', '=', $category_id)->get();
        foreach ($categories as $category){
            $this->findAndDeleteAllChildrenCategory($category->id);
            $category->delete();
        }
        foreach ($files as $file){
            unlink($file->path);
            $file->delete();
        }
        foreach ($permissions as $permission){
            $permission->delete();
        }
        return true;
    }

    /**
     * @param $category_id
     * @return bool
     */
    public function getUploadPermission($category_id): bool
    {
        $permission = Permission::where('category_id', '=', $category_id)
            ->where('permission_id','=',Permission::UPLOAD_PERMISSION)->first();
        if ($permission){
            return true;
        }
//        $category = Category::where('id', '=', $category_id)->first();
//        if ($category->parent_id !== 0){
//            return $this->getUploadPermission($category->parent_id);
//        }
        return false;
    }
}
