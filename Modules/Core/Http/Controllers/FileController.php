<?php

namespace Modules\Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Core\Entities\File;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{

    function __construct()
	{
		// $this->middleware('auth');
	}

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->hasFile('file')) {
            $request->validate([
                'file' => 'required|mimes:png,jpg,gif,jpeg,pdf,doc,docx,xls,xlsx',
            ]);

            $input              = $request->all();
            $file               = $request->file('file');
            $extension          = $file->getClientOriginalExtension();
            $size               = $file->getSize();
            $originalFileName   = $file->getClientOriginalName();
            $originalFileNameWithoutExtension = pathinfo($originalFileName, PATHINFO_FILENAME);
            $uniqueFileName     = uniqid().'.'.$extension;

            $filePath = $file->storeAs($input['uploaded_from'] . '/' . date('Y/M/d'), $uniqueFileName, 'public');

            try {
                $file = File::create([
                    'path'          => 'storage/' . $filePath,
                    'uploaded_from' => $input['uploaded_from'],
                    'name'          => $originalFileNameWithoutExtension,
                    'type'          => $extension,
                    'size'          => $size,
                ]);

                $success_msg = __('core::core.message.success.store');
                return response()->json([
                    'success' => $success_msg,
                    'id' => $file->id
                ]);

            } catch (Exception $e) {
                $error_msg = __('core::core.message.error');
                return response()->json(['danger' => $error_msg]);
            }
        }

        return 'Error!';
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $file = File::find($request->id);
        $file->delete();
        if ($file) {
            if (file_exists($file->path)) {
                unlink($file->path);
            }
        }

        $success_msg = __('core::core.message.success.destroy');
        return response()->json(['success'=> $success_msg]);
    }

}
