<?php

namespace Modules\Setting\Http\Controllers;

use DB;
use Session;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Support\Renderable;

class BackupController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:backup-list', ['only' => ['index']]);
        $this->middleware('permission:backup-create', ['only' => ['create']]);
        $this->middleware('permission:backup-clean', ['only' => ['clean']]);
        $this->middleware('permission:backup-monitor', ['only' => ['monitor']]);
        $this->middleware('permission:backup-delete', ['only' => ['delete']]);
        $this->middleware('permission:backup-download', ['only' => ['download']]);

        $permissions_backup_list = Permission::get()->filter(function ($item) {
            return $item->name == 'backup-list';
        })->first();
        $permissions_backup_create = Permission::get()->filter(function ($item) {
            return $item->name == 'backup-create';
        })->first();
        $permissions_backup_clean = Permission::get()->filter(function ($item) {
            return $item->name == 'backup-clean';
        })->first();
        $permissions_backup_monitor = Permission::get()->filter(function ($item) {
            return $item->name == 'backup-monitor';
        })->first();
        $permissions_backup_delete = Permission::get()->filter(function ($item) {
            return $item->name == 'backup-delete';
        })->first();
        $permissions_backup_download = Permission::get()->filter(function ($item) {
            return $item->name == 'backup-download';
        })->first();


        if ($permissions_backup_list == null) {
            Permission::create(['name' => 'backup-list']);
        }
        if ($permissions_backup_create == null) {
            Permission::create(['name' => 'backup-create']);
        }
        if ($permissions_backup_clean == null) {
            Permission::create(['name' => 'backup-clean']);
        }
        if ($permissions_backup_monitor == null) {
            Permission::create(['name' => 'backup-monitor']);
        }
        if ($permissions_backup_delete == null) {
            Permission::create(['name' => 'backup-delete']);
        }
        if ($permissions_backup_download == null) {
            Permission::create(['name' => 'backup-download']);
        }
    }


    public function index(Request $request)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        // dd($disk);
        $files = $disk->files('/backup/');
        $backups = [];
        foreach ($files as $k => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        $backups = array_reverse($backups);

        // dd($backups);

        return view('setting::backup.index', compact('backups'));
    }



    public static function humanFileSize($size, $unit = "")
    {
        if ((!$unit && $size >= 1 << 30) || $unit == "GB")
            return number_format($size / (1 << 30), 2) . "GB";
        if ((!$unit && $size >= 1 << 20) || $unit == "MB")
            return number_format($size / (1 << 20), 2) . "MB";
        if ((!$unit && $size >= 1 << 10) || $unit == "KB")
            return number_format($size / (1 << 10), 2) . "KB";
        return number_format($size) . " bytes";
    }

    public function create()
    {
        try {
            Artisan::call('backup:run');
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started \r\n" . $output);

            $success_msg = __('setting::backup.message.backup.success');
            return response()->json(['success'=> $success_msg]);


        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function clean()
    {
        try {
            Artisan::call('backup:clean');
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- old backup cleaning started \r\n" . $output);

            $success_msg = __('setting::backup.message.clean.success');
            return response()->json(['success'=> $success_msg]);


        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function monitor()
    {
        try {
            Artisan::call('backup:monitor');
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- old backup monitoring started \r\n" . $output);

            $success_msg = __('setting::backup.message.monitor.success');
            return response()->json(['success'=> $success_msg]);


        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        if ($disk->exists($file)) {
            $mimeType = $disk->mimeType($file);
            $fileSize = $disk->size($file);

            $stream = $disk->readStream($file);

            return \Response::stream(
                function () use ($stream) {
                    fpassthru($stream);
                },
                200,
                [
                    "Content-Type" => $mimeType,
                    "Content-Length" => $fileSize,
                    "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
                ]
            );
        } else {
            abort(404, __('setting::backup.message.abort'));
        }
    }

    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);

            $success_msg =  __('setting::backup.message.delete.success');
            return redirect()->route('admin.setting.backup.index')->with('success',$success_msg);
        } else {
            $error_msg = __('setting::backup.message.delete.error');
            return redirect()->route('admin.setting.backup.index')->with('error',$error_msg);
        }
    }
}
