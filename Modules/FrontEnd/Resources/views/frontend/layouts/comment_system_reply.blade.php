@push('css')
<style>
    .display-comment {
        padding: 0 15px;
        border-left: 0;
        background: #161616;
        color: #9d9d9d;
        border-radius: 15px;
    }
    .display-comment-row{
        border-bottom: 0;
        margin-left: -16px;
    }
</style>
@endpush
@foreach($comments as $comment)
    <div class="display-comment mb-2 @if($comment->parent_id != null) ms-3 @endif">
        <div class="row display-comment-row py-3">
            <div class="col-1">
                @if (auth()->check() && isset(auth()->user()->files[0]->path))
                <img style="height: 50px; width:50px; border-radius: 100px; padding: 5px; background: #fff;" src="/{{ auth()->user()->files[0]->path }}" onerror="this.onerror=null;this.src='{{ asset('assets/frontend/img/no-image.webp') }}';" alt="">
                @else
                <img style="height: 50px; width:50px; border-radius: 100px; padding: 5px; background: #fff;" src="{{ asset('assets/frontend/img/no-image.webp') }}" alt="">
                @endif
            </div>

            <div class="col-11">
                <div class="row">
                    <div class="col mt-2">
                        <strong>{{ $comment->user->name }}</strong>
                    </div>
                    <div class="col text-end">
                        <small style="    position: absolute;
                        right: 15px;">{{date("jS M Y", strtotime($comment->created_at))}}</small>
                    </div>
                </div>
                <p>{!! $comment->body !!}</p>
                <a href="#" class="reply-link" data-key="{{ $comment->id }}"><i class="fi fi-ss-redo"></i> Répondre</a>
                @if (auth()->check())
                    <form method="post" action="{{ $comment_store_route }}" class="mt-3 reply-form reply-form-{{ $comment->id }}" id="reply_form_{{ $comment->id }}" style="display: none;">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="body" class="form-control tiny"></textarea>
                                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                                </div>
                                <button type="submit" class="btn btn-warning mt-2 pt-2 text-white"><i class="fi fi-ss-redo"></i> Répondre</button>
                            </div>
                        </div>
                    </form>
                @else
                    <h4 class="mt-4" id="comment_form">S'il te plaît <a href="{{ route('admin.login') }}">se connecter</a> pour écrire un commentaire</h4>
                @endif


            </div>
        </div>

        {{-- <hr> --}}
        @include('frontend::frontend.layouts.comment_system_reply', ['comments' => $comment->replies, 'parentKey' => $comment->id])
    </div>
@endforeach

@push('js')
<script>
    $(document).ready(function(){
        $('.reply-form').hide(); // Initially hide all forms
        $(document).on('click', '.reply-link', function(e){
            e.preventDefault();
            var key = $(this).data('key');
            $('.reply-form').hide(); // Hide all forms
            $('#reply_form_' + key).toggle(); // Toggle the corresponding form
        });
    });
</script>
@endpush
