{{-- {{ dd(Cookie::get('subscriptionModalClosed')) }} --}}
@if(!Cookie::get('subscriptionModalClosed'))
    <div class="modal fade text-white" id="subscriptionModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="subscriptionModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.85);">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0">
            <h5 class="modal-title" id="subscriptionModalLabel">Premium Content Access</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Get exclusive access to our premium content by subscribing now. Don't miss out on our in-depth articles, guides, and more!
            </div>
            <div class="modal-footer border-0">
                <div class="row w-100">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-outline-light w-100 border-radius-round" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('frontend.subscription') }}" type="button" class="btn btn-primary w-100 border-radius-round">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endif
