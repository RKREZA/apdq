<?php

namespace Modules\Live\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Live\Entities\Live;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Modules\Live\DataTables\LivesDataTable;
use Modules\Live\DataTables\LiveTrashesDataTable;
use Youtube;
use Alaouy\Youtube\Rules\ValidYoutubeVideo;

class LiveController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:live-list', ['only' => ['index']]);
		$this->middleware('permission:live-create', ['only' => ['create','store']]);
		$this->middleware('permission:live-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:live-view', ['only' => ['view']]);
		$this->middleware('permission:live-delete', ['only' => ['destroy']]);
	}

    public function index(LivesDataTable $dataTable)
    {
        return $dataTable->render('live::live.index');
    }
    public function trashes(LiveTrashesDataTable $dataTable)
    {
        return $dataTable->render('live::live.trashes');
    }

    public function create()
    {
        return view('live::live.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'publish_type' 			    => 'required',
            'content_type' 			    => 'required',
            'title' 					=> 'required',
			'description' 			    => 'nullable|string',
			'youtube_link' 			    => 'required|string',
			'embed_html' 			    => 'required|string',
			'thumbnail_url' 			=> 'required|string',
			'external_id' 			    => 'required|string',
			'seo_title' 			    => 'nullable|string',
			'seo_description' 		    => 'nullable|string',
			'seo_keyword' 			    => 'nullable|string'
        ];

        $messages = [
            'publish_type.required'    	=> __('core::core.form.validation.required'),
            'content_type.required'    	=> __('core::core.form.validation.required'),
            'title.required'    		=> __('core::core.form.validation.required'),
            'description.required'      => __('core::core.form.validation.required'),
            'youtube_link.required'     => __('core::core.form.validation.required'),
            'embed_html.required'       => __('core::core.form.validation.required'),
            'thumbnail_url.required'    => __('core::core.form.validation.required'),
            'external_id.required'      => __('core::core.form.validation.required'),
            'seo_title.required'        => __('core::core.form.validation.required'),
            'seo_description.required'  => __('core::core.form.validation.required'),
            'seo_keyword.required'      => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			Live::create([
                'publish_type'         => $request->input('publish_type'),
                'content_type'         => $request->input('content_type'),
                'title'         => $request->input('title'),
                'description'   => $request->input('description'),
                'live_url'      => $request->input('youtube_link'),
                'embed_html'    => $request->input('embed_html'),
                'thumbnail_url' => $request->input('thumbnail_url'),
                'external_id'   => $request->input('external_id'),
                'seo_title'     => $request->input('seo_title'),
                'seo_description'=> $request->input('seo_description'),
                'seo_keyword'   => $request->input('seo_keyword')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.lives.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.lives.index')->with('error',$error_msg);
		}
    }

    public function edit($id)
    {
        $live = Live::find($id);
        return view('live::live.edit', compact('live'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'content_type' 			    => 'required',
            'content_type' 			    => 'required',
            'title' 					=> 'required',
			'description' 	            => 'required|string',
        ];

        $messages = [
            'publish_type.required'    	=> __('core::core.form.validation.required'),
            'content_type.required'    	=> __('core::core.form.validation.required'),
            'title.required'    	    => __('core::core.form.validation.required'),
            'description.required'      => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);


        DB::beginTransaction();
		try {
            $input       = $request->all();
            $live         = Live::find($id);
			$live->update($input);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.lives.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.lives.index')->with('success',$success_msg);

    }

    public function view($id)
    {
        $live = Live::find($id);
        return view('live::live.view', compact('live'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Live::find($request->id)->update(['status' => $request->status]);
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg        = __('core::core.message.success.update');
        return response()->json(['success'=> $success_msg]);

	}

	public function archive_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Live::find($request->id)->update(['archive' => $request->archive]);
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
            Live::find($id)->delete();
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
                Live::find($id)->delete();
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
            $live = Live::find($id);
            if ($live) {
                $live->forceDelete();
            }else{
                Live::onlyTrashed()->find($id)->forceDelete();
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
                $live = Live::find($id);
                if ($live) {
                    $live->forceDelete();
                }else{
                    live::onlyTrashed()->find($id)->forceDelete();
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
            Live::onlyTrashed()->find($id)->restore();
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
                Live::onlyTrashed()->find($id)->restore();
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

    public function get()
    {
        $live = Live::find(request()->id);
        if($live){
            return $live;
        }else{
            return null;
        }
    }





    public function fetch_youtube_data_from_link(Request $request)
	{

        $rules = [
            'youtube_link' => ['bail', 'required', new ValidYoutubeVideo]
        ];

        $messages = [
            'youtube_link.required'  => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);

        if (!$validate) {
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        } else {
            $youtube_link = $request->youtube_link;
            $query = parse_url($youtube_link, PHP_URL_QUERY);
            parse_str($query, $params);
            $youtube_id =  isset($params['v']) ? $params['v'] : null;

            $fetch = Youtube::getVideoInfo($youtube_id);

            $videoDescription = $fetch->snippet->description;
            $cleanDescription = strip_tags($videoDescription, '<br><a><strong><em><ul><ol><li>');

            // dd($fetch);
            $video['title'] = $fetch->snippet->title;
            $video['description'] = nl2br($this->convertTimestamps($cleanDescription, $fetch->id));
            $video['thumbnail_url'] = $fetch->snippet->thumbnails->high->url;
            $video['embed_html'] = $fetch->player->embedHtml;
            $video['external_id'] = $fetch->id;

            return $video;
        }


    }



    // Function to convert YouTube timestamps to clickable links
    public function convertTimestamps($description, $videoId) {
        // Regular expression to match YouTube timestamps
        $pattern = '/(\d{1,2}:\d{1,2}\s?[apAPmM]*)/';

        // Replace timestamps with clickable links
        $descriptionWithLinks = preg_replace_callback($pattern, function ($matches) use ($videoId) {
            // Convert matched timestamp to seconds
            $seconds = strtotime("1970-01-01 " . $matches[0] . " UTC");

            // Generate YouTube video URL with the timestamp
            $videoUrl = "https://www.youtube.com/watch?v=$videoId&t=$seconds";

            // Create a clickable link
            return "<a href=\"$videoUrl\">$matches[0]</a>";
        }, $description);

        return $descriptionWithLinks;
    }


}
