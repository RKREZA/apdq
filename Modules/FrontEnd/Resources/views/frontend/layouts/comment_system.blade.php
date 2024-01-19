@push('css')
<style>
</style>
@endpush

<div class="colmd-12 mt-4">
    <div class="card bg-transparent border-0">
        <div class="card-header p-0 pb-3 bg-transparent">
            <h4 class="m-1 text-light">{{ $post->comments->count() }} Comments</h4>
        </div>
        <div class="card-body p-0 pb-3 bg-transparent">
            <div class="row">
                {{-- <div class="col-2">
                    @if (auth()->check() && isset(auth()->user()->files[0]->path))
                    <img style="height: 90px; width:90px; border-radius: 100px; padding: 5px; background: #fff;" src="/{{ auth()->user()->files[0]->path }}" onerror="this.onerror=null;this.src='{{ asset('assets/frontend/img/no-image.png') }}';" alt="">
                    @else
                    <img style="height: 90px; width:90px; border-radius: 100px; padding: 5px; background: #fff;" src="{{ asset('assets/frontend/img/no-image.png') }}" alt="">
                    @endif
                </div> --}}
                <div class="col-12">
                    @if (auth()->check())
                        <form method="post" action="{{ $comment_store_route }}" id="comment_form">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control tiny" name="body" row="10"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" class="btn btn-red" value="Post Comment" />
                            </div>
                        </form>
                    @else
                        <h4 class="mt-4" id="comment_form">S'il te plaît <a href="{{ route('admin.login') }}">se connecter</a> pour écrire un commentaire</h4>
                    @endif
                </div>
            </div>

        </div>
        <div class="card-footer p-0 bg-transparent">
            @include('frontend::frontend.layouts.comment_system_reply', ['comments' => $post->comments])
        </div>
    </div>
</div>

@push('js')
<script>
    var height                      = 100;
    var selector                    = '.tiny';
    var toolbar                     = [
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol']],
        ['insert', ['link']]
    ];
    $(selector).summernote({
        placeholder: '',
        tabsize: 2,
        height: height,
        width: '100%',
        toolbar: toolbar
    });
</script>

<script>
    // $(document).ready(function () {
    //     $('#comment_form').submit(function (e) {
    //         e.preventDefault();

    //         var form = $(this);

    //         $.ajax({
    //             type: form.attr('method'),
    //             url: form.attr('action'),
    //             data: form.serialize(),
    //             dataType: 'json',
    //             success: function (data) {
    //                 location.reload();
    //             }
    //         });
    //     });

    // });
</script>
@endpush
