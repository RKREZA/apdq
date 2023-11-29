<?php

namespace Modules\Video\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Video\Entities\Video;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Video\Entities\VideoCategory;
use Yajra\DataTables\Facades\DataTables;
use Modules\Video\DataTables\VideosDataTable;
use Modules\Video\DataTables\VideoTrashesDataTable;
use Youtube;
use Alaouy\Youtube\Rules\ValidYoutubeVideo;

use GuzzleHttp\Client;

class VideoController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:video-list', ['only' => ['index']]);
		$this->middleware('permission:video-create', ['only' => ['create','store']]);
		$this->middleware('permission:video-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:video-view', ['only' => ['view']]);
		$this->middleware('permission:video-delete', ['only' => ['destroy']]);
	}

    public function index(VideosDataTable $dataTable)
    {
        return $dataTable->render('video::video.index');
    }
    public function trashes(VideoTrashesDataTable $dataTable)
    {
        return $dataTable->render('video::video.trashes');
    }

    public function create()
    {
        $videocategories = VideoCategory::get();
        return view('video::video.create', compact('videocategories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' 					=> 'required',
			'description' 			    => 'required|string',
			'tag' 			            => 'required|string',
			'category_id' 			    => 'required',
			'embed_html' 			    => 'required|string',
			'thumbnail_url' 			=> 'required|string',
			'external_id' 			    => 'required|string',
			'seo_title' 			    => 'nullable|string',
			'seo_description' 		    => 'nullable|string',
			'seo_keyword' 			    => 'nullable|string'
        ];

        $messages = [
            'title.required'    		=> __('core::core.form.validation.required'),
            'description.required'      => __('core::core.form.validation.required'),
            'tag.required'              => __('core::core.form.validation.required'),
            'category_id.required'      => __('core::core.form.validation.required'),
            'embed_html.required'       => __('core::core.form.validation.required'),
            'thumbnail_url.required'    => __('core::core.form.validation.required'),
            'external_id.required'      => __('core::core.form.validation.required'),
            'seo_title.required'        => __('core::core.form.validation.required'),
            'seo_description.required'  => __('core::core.form.validation.required'),
            'seo_keyword.required'      => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);
        // dd($request->all());
		try {
			Video::create([
                'title'         => $request->input('title'),
                'category_id'   => $request->input('category_id'),
                'description'   => $request->input('description'),
                'tag'           => $request->input('tag'),
                'category_id'   => $request->input('category_id'),
                'embed_html'    => $request->input('embed_html'),
                'thumbnail_url' => $request->input('thumbnail_url'),
                'external_id'   => $request->input('external_id'),
                'seo_title'     => $request->input('seo_title'),
                'seo_description'=> $request->input('seo_description'),
                'seo_keyword'   => $request->input('seo_keyword')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.videos.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.videos.index')->with('error',$error_msg);
		}
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return view('video::video.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' 					=> 'required',
			'description' 	            => 'required|string',
        ];

        $messages = [
            'title.required'    	=> __('core::core.form.validation.required'),
            'description.required'  => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);


        DB::beginTransaction();
		try {
            $input       = $request->all();
            $cms         = Video::find($id);
			$cms->update($input);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.videos.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.videos.index')->with('success',$success_msg);

    }

    public function view($id)
    {
        $video = Video::find($id);
        return view('video::video.view', compact('video'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Video::find($request->id)->update(['status' => $request->status]);
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
            Video::find($id)->delete();
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
                Video::find($id)->delete();
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
            $video = Video::find($id);
            if ($video) {
                $video->forceDelete();
            }else{
                Video::onlyTrashed()->find($id)->forceDelete();
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
                $video = Video::find($id);
                if ($video) {
                    $video->forceDelete();
                }else{
                    Video::onlyTrashed()->find($id)->forceDelete();
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
            Video::onlyTrashed()->find($id)->restore();
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
                Video::onlyTrashed()->find($id)->restore();
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





    public function fetch_youtube_data_from_link(Request $request)
	{

        // $rules = [
        //     'youtube_link' => ['bail', 'required', new ValidYoutubeVideo]
        // ];

        $rules = [
            'youtube_link' => ['bail', 'required']
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
            $video['title']         = $fetch->snippet->title;
            $video['description']   = nl2br($this->convertTimestamps($cleanDescription, $fetch->id));
            $video['thumbnail_url'] = $fetch->snippet->thumbnails->high->url;
            $video['embed_html']    = $fetch->player->embedHtml;
            $video['external_id']   = $fetch->id;

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
