<?php

namespace Modules\Blog\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Blog\Entities\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Blog\Entities\PostCategory;
use Yajra\DataTables\Facades\DataTables;
use Modules\Blog\DataTables\PostsDataTable;
use Modules\Blog\DataTables\PostTrashesDataTable;
use Youtube;
use Alaouy\Youtube\Rules\ValidYoutubePost;

class PostController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:post-list', ['only' => ['index']]);
		$this->middleware('permission:post-create', ['only' => ['create','store']]);
		$this->middleware('permission:post-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:post-view', ['only' => ['view']]);
		$this->middleware('permission:post-delete', ['only' => ['destroy']]);
	}

    public function index(PostsDataTable $dataTable)
    {
        return $dataTable->render('blog::post.index');
    }
    public function trashes(PostTrashesDataTable $dataTable)
    {
        return $dataTable->render('blog::post.trashes');
    }

    public function create()
    {
        $postcategories = PostCategory::get();
        return view('blog::post.create', compact('postcategories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' 					=> 'required',
			'description' 			    => 'nullable|string',
			'tag' 			            => 'required|string',
			'category_id' 			    => 'required',
			'subcategory_id' 			=> 'required',
			'seo_title' 			    => 'nullable|string',
			'seo_description' 		    => 'nullable|string',
			'seo_keyword' 			    => 'nullable|string',
			'created_at' 			    => 'required',

            'publish_type'              => 'required',
            'content_type'              => 'required',
        ];

        $messages = [
            'title.required'    		=> __('core::core.form.validation.required'),
            'description.required'      => __('core::core.form.validation.required'),
            'tag.required'              => __('core::core.form.validation.required'),
            'category_id.required'      => __('core::core.form.validation.required'),
            'subcategory_id.required'   => __('core::core.form.validation.required'),
            'seo_title.required'        => __('core::core.form.validation.required'),
            'seo_description.required'  => __('core::core.form.validation.required'),
            'seo_keyword.required'      => __('core::core.form.validation.required'),
            'created_at.required'       => __('core::core.form.validation.required'),

            'publish_type.required'     => __('core::core.form.validation.required'),
            'content_type.required'     => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);
        // dd($request->all());
		try {
			$post = Post::create([
                'title'         => $request->input('title'),
                'description'   => $request->input('description'),
                'tag'           => $request->input('tag'),
                'category_id'   => $request->input('category_id'),
                'subcategory_id'=> $request->input('subcategory_id'),
                'seo_title'     => $request->input('seo_title'),
                'seo_description'=> $request->input('seo_description'),
                'seo_keyword'   => $request->input('seo_keyword'),
                'created_at'    => $request->input('created_at'),
                'publish_type'    => $request->input('publish_type'),
                'content_type'    => $request->input('content_type')
            ]);

            if (!empty($request->input('files'))) {
                $files = explode(',',$request->input('files'));
                $files = array_filter($files);
                $post->files()->attach($files);
            }

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.posts.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.posts.index')->with('error',$error_msg);
		}
    }

    public function edit($id)
    {
        $post = Post::find($id);

        if(count($post->files)>0){
            foreach($post->files as $file){
                $files[]    = $file->id;
            }
            $file_ids       = implode(',',$files);
        }else{
            $file_ids       = '';
        }

        return view('blog::post.edit', compact('post','file_ids'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' 					=> 'required',
			'description' 	            => 'nullable|string',
			'created_at' 			    => 'required',
        ];

        $messages = [
            'title.required'    	=> __('core::core.form.validation.required'),
            'description.required'  => __('core::core.form.validation.required'),
            'created_at.required'       => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);


        DB::beginTransaction();
		try {
            $input       = $request->all();
            $post        = Post::find($id);
			$post->update($input);

            if (!empty($input['files'])) {
                $files          = explode(',',$input['files']);
                $files          = array_filter($files);
                $post->files()->sync($files);
            }

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.posts.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.posts.index')->with('success',$success_msg);

    }

    public function view($id)
    {
        $post = Post::find($id);
        return view('blog::post.view', compact('post'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Post::find($request->id)->update(['status' => $request->status]);
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
            Post::find($id)->delete();
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
                Post::find($id)->delete();
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
            $post = Post::find($id);
            if ($post) {
                $post->forceDelete();
            }else{
                Post::onlyTrashed()->find($id)->forceDelete();
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
                $post = Post::find($id);
                if ($post) {
                    $post->forceDelete();
                }else{
                    Post::onlyTrashed()->find($id)->forceDelete();
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
            Post::onlyTrashed()->find($id)->restore();
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
                Post::onlyTrashed()->find($id)->restore();
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
