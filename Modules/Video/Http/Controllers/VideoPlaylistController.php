<?php

namespace Modules\Video\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Video\DataTables\VideoPlaylistDataTable;
use Modules\Video\DataTables\VideoPlaylistTrashesDataTable;
use Modules\Video\Entities\VideoPlaylist;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class VideoPlaylistController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:videoplaylist-list', ['only' => ['index']]);
		$this->middleware('permission:videoplaylist-create', ['only' => ['create','store']]);
		$this->middleware('permission:videoplaylist-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:videoplaylist-delete', ['only' => ['destroy']]);
	}

    public function index(VideoPlaylistDataTable $dataTable)
    {
        return $dataTable->render('video::playlist.index');
    }

    public function trashes(VideoPlaylistTrashesDataTable $dataTable)
    {
        return $dataTable->render('video::playlist.trashes');
    }

    public function create()
    {
        $videoplaylist = Permission::get();
        return view('video::playlist.create', compact('videoplaylist'));
    }

    public function store(Request $request)
	{
        $rules = [
			'name' 			        => 'required|string',
        ];

        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			$role = VideoPlaylist::create([
                'name' => $request->input('name')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.videoplaylists.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.videoplaylists.index')->with('error',$error_msg);
		}
	}

    public function show($id)
    {
        return view('video::playlist.show');
    }

    public function edit($id)
    {
        $videoplaylist = VideoPlaylist::find($id);
        return view('video::playlist.edit', compact('videoplaylist'));
    }

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 			        => 'required',
        ];
        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$videoplaylist = VideoPlaylist::find($id);
		try {
			$videoplaylist->update($input);
			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.videoplaylists.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.videoplaylists.index')->with('error',$error_msg);
		}

	}


	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    VideoPlaylist::find($request->id)->update(['status' => $request->status]);
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg        = __('core::core.message.success.update');
        return response()->json(['success'=> $success_msg]);

	}

	public function trash()
	{
        DB::beginTransaction();

		$id                 = request()->input('id');
		try {
            $playlist = VideoPlaylist::find($id);

            if($playlist->videos->count() > 0){
                DB::commit();
                $error_msg  = __('video::video.playlist.message.error_video_exist_with_this_playlist');
                return response()->json(['error'=>$error_msg]);
            }

            $playlist->delete();

        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg = __('core::core.message.success.trash');
        return response()->json(['success'=>$success_msg]);

	}

    public function trash_all(Request $request)
    {
        $ids                = explode(",",$request->ids);

        DB::beginTransaction();
        foreach($ids as $id){
            try {
                // Videoplaylist::find($id)->delete();

                $playlist = VideoPlaylist::find($id);

                if($playlist->videos->count() > 0){
                    $error_msg  = __('video::video.playlist.message.error_video_exist_with_this_playlist');
                    return response()->json(['error'=>$error_msg]);
                }

                $playlist->delete();

            } catch (Exception $e) {
                DB::rollBack();
                $error_msg = __('core::core.message.error');
                return response()->json(['error'=>$error_msg]);
            }
        }
        DB::commit();
        $success_msg = __('core::core.message.success.trash');
        return response()->json(['success'=>$success_msg]);
    }

	public function force_destroy()
	{
        DB::beginTransaction();

		$id                 = request()->input('id');

		try {
            $playlist = VideoPlaylist::find($id);

            if($playlist->videos->count() > 0){
                DB::commit();
                $error_msg  = __('video::video.playlist.message.error_video_exist_with_this_playlist');
                return response()->json(['error'=>$error_msg]);
            }

            if ($playlist) {
                $playlist->forceDelete();
            }else{
                VideoPlaylist::onlyTrashed()->find($id)->forceDelete();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }

        DB::commit();
        $success_msg = __('core::core.message.success.destroy');
        return response()->json(['success'=>$success_msg]);

	}

    public function force_destroy_all(Request $request)
    {
        $ids                = explode(",",$request->ids);

        DB::beginTransaction();
        foreach($ids as $id){
            try {

                $playlist = VideoPlaylist::find($id);

                if($playlist->videos->count() > 0){
                    $error_msg  = __('video::video.playlist.message.error_video_exist_with_this_playlist');
                    return response()->json(['error'=>$error_msg]);
                }

                if ($playlist) {
                    $playlist->forceDelete();
                }else{
                    VideoPlaylist::onlyTrashed()->find($id)->forceDelete();
                }
            } catch (Exception $e) {
                DB::rollBack();
                $error_msg = __('core::core.message.error');
                return response()->json(['error'=>$error_msg]);
            }
        }
        DB::commit();
        $success_msg = __('core::core.message.success.destroy');
        return response()->json(['success'=>$success_msg]);
    }

	public function restore()
	{
        DB::beginTransaction();

		$id                 = request()->input('id');

		try {
            VideoPlaylist::onlyTrashed()->find($id)->restore();
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg = __('core::core.message.success.restore');
        return response()->json(['success'=>$success_msg]);

	}

    public function restore_all(Request $request)
	{
        $ids                = explode(",",$request->ids);
        DB::beginTransaction();

		$id                 = request()->input('id');

		try {
            foreach ($ids as $id) {
                VideoPlaylist::onlyTrashed()->find($id)->restore();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg = __('core::core.message.success.restore');
        return response()->json(['success'=>$success_msg]);

	}
}
