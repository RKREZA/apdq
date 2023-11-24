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

            $input                              = $request->all();
            $file                               = $request->file('file');
            $extension                          = $file->getClientOriginalExtension();
            $size                               = $file->getSize();
            $originalFileName                   = $request->file->getClientOriginalName(); //Get Image Name
            $originalFileNameWithoutExtension   = pathinfo($originalFileName, PATHINFO_FILENAME);
            $uniqueFileName                     = uniqid().'.'.$extension;
            $uniqueFileNameWithoutExtension     = pathinfo($uniqueFileName, PATHINFO_FILENAME);
            $compressImage                      = $size > 409600; // Check if the image is a large image (greater than 409600 bytes, i.e., 400 KB)

            // Convert Image to .webp if it's an image file
            if (preg_match('/(png|jpg|gif|jpeg)/', $extension)) {
                $image = Image::make($file);

                // Resize and compress the image if it's a large image
                // Refactor this code. compress not working
                if ($compressImage) {
                    // Resize the image by 10% and apply compression
                    $image->fit((int)($image->width() * 0.7), (int)($image->height() * 0.7), function ($constraint) {
                        $constraint->upsize();
                    });
                    $image->encode($extension, 70); // You can adjust the compression quality (0 to 100) as needed.
                }

                // Convert the image to .webp format
                $webpFileName   = $uniqueFileNameWithoutExtension.'.webp';
                $webpFilePath   = storage_path('app/' . $input['uploaded_from'] . '/' . date('Y/M/d') . '/' . $webpFileName);
                $image->save($webpFilePath, 75); // You can adjust the quality (0 to 100) as needed.
                $size           = $image->filesize();

                // Save the original image with compression
                $filePath       = $file->storeAs($input['uploaded_from'] . '/' . date('Y/M/d'), $uniqueFileName, 'public');
            } else {
                // For non-image files, store them as they are with the unique file name
                $filePath       = $file->storeAs($input['uploaded_from'] . '/' . date('Y/M/d'), $uniqueFileName, 'public');
            }

            try {
                $file = File::create([
                    'path'          => 'storage/' . $filePath,
                    'uploaded_from' => $input['uploaded_from'],
                    'name'          => $originalFileNameWithoutExtension, // Store the original file name without the extension
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
