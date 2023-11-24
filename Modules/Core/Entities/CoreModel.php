<?php

namespace Modules\Core\Entities;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class CoreModel extends Model
{
    use HasFactory;

    public static function mine()
    {
        return parent::where('deleted_at','null');
    }

    public static function custom_trash($model, $id)
    {
        DB::beginTransaction();
        try {
            $data = $model::find($id);
            $data->delete();
            if (isset($data->status)) {
                $data->status = 'Inactive';
                $data->save();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }

        DB::commit();
    }

    public static function custom_destroy($model, $id)
    {
        DB::beginTransaction();
        try {
            $data = $model::find($id);
            if ($data) {
                $data->forceDelete();
            }else{
                $data = $model::onlyTrashed()->find($id);
                $data->forceDelete();
            }

            // Delete File
            if (count($data->files) > 0) {
                foreach ($data->files as $value) {
                    $file = File::find($value->id);
                    unlink($file->path);
                    $file->delete();
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }

        DB::commit();
    }

    public static function custom_restore($model, $id){
        DB::beginTransaction();
		try {
            $data = $model::onlyTrashed()->find($id);
            $data->restore();
            if (isset($data->status)) {
                $data->status = 'Active';
                $data->save();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
    }

    public static function custom_status_update($model, $id, $status){
        DB::beginTransaction();
        try {
		    $model::find($id)->update(['status' => $status]);
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
    }


}
