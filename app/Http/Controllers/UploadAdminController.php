<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\UploadEditRequest;
use \Storage;

class UploadAdminController extends Controller
{
    public function __construct()
    {
        Controller::__construct();
        $this->middleware(['auth', 'checkAdmin']);
    }

    public function index()
    {
        $files = File::orderBy('id', 'desc')->get();

        return view('upload-admin.index', [
            'files' => $files,
        ]);
    }

    public function create()
    {
        return view('upload-admin.create');
    }

    public function storeFile(UploadRequest $request)
    {
        $dbFile = new \App\File();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $storedFileUrl = $file->store('public/upload');

            if($storedFileUrl !== false) {
                $dbFile->name = $request->name;
                $dbFile->url = "/storage/upload/" . $file->hashName();
                $dbFile->extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $dbFile->size = $file->getSize();
                $dbFile->save();
            }
        }

        return redirect()->route('upload-admin.index');
    }

    public function edit(File $file)
    {
        return view('upload-admin.edit', [
            'file' => $file
        ]);
    }

    public function update(UploadEditRequest $request, File $file)
    {
        $file->name = $request->input('name');
        $file->save();

        return redirect()->route('upload-admin.index');
    }

    public function destroy(File $file)
    {
        $link = '/public' . $this->getPathToDelete($file->url);
        Storage::delete($link);
        $file->delete();

        return redirect()->route('upload-admin.index');
    }

    public function getPathToDelete($link)
    {
        $link = explode('/', $link);
        if($link[1] == 'storage'){
            unset($link[1]);
        }
        $link = implode('/',$link);

        return $link;
    }
}
