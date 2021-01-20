<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param $category_id
     * @return Application|Factory|Response|View
     */

    public function getFiles($category_id)
    {
        $permission = $this->getDownloadPermission($category_id);
        $files = File::where('category_id', '=', $category_id)->get();
        return view('file/fileView', compact('files','permission'));
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return RedirectResponse
     */

    public function addFile(Request $request): RedirectResponse
    {
        $input = $request->all();

        if ($request->hasFile('file') ) {
            $file = $request->file('file');
            $version = $this->searchFileByName($file->getClientOriginalName());
            if ($version) {
                $input['version'] = $version + 1;
            } else {
                $input['version'] = 1;
            }
            $destinationPath = public_path('/uploads/files');
            $name = $file->getClientOriginalName();
            $filePath = $destinationPath. "/". $input['version'] . '_' . $name ;
            $file->move($destinationPath, $filePath);
            $input['path'] = $filePath;
            $input['name'] = $name;
            $input['user_id'] = Auth::user()->getId();
        }

        $input['category_id'] = empty($input['category_id']) ? 0 : $input['category_id'];

        File::create($input);
        return back()->with('success', 'New Category added successfully.');
    }

    /**
     * @param $file_id
     * @return RedirectResponse|BinaryFileResponse
     */
    public function downloadFile($file_id){
        $file = File::where('id', '=', $file_id)->first();
        if ($this->getDownloadPermission($file->category_id)){
            return response()->download($file->path, $file->name);
        }

        return back()->with('success', 'New Category added successfully.');
    }

    /**
     * @param $category_id
     * @return bool
     */
    public function getDownloadPermission($category_id): bool
    {
        $permission = Permission::where('category_id', '=', $category_id)
            ->where('permission_id','=',Permission::DOWNLOAD_PERMISSION)->first();
        if ($permission){
            return true;
        }
        return false;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function searchFileByName($name){
        return \count(File::where('name', '=', $name)->get('version'));
    }
}
