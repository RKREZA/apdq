{{-- {{ dd(Cookie::get('subscriptionModalClosed')) }} --}}
@if(!Cookie::get('subscriptionModalClosed'))
    <div class="modal fade text-white" id="subscriptionModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="subscriptionModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.85);">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0">
            <h5 class="modal-title" id="subscriptionModalLabel">Accès au contenu premium</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Obtenez un accès exclusif à notre contenu premium en vous abonnant maintenant. Ne manquez pas nos articles approfondis, nos guides et bien plus encore !
            </div>
            <div class="modal-footer border-0">
                <div class="row w-100">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline-light w-100 border-radius-round" data-bs-dismiss="modal">Fermer</button>
                    </div>
                    <div class="col-md-8">
                        <a href="{{ route('frontend.subscription') }}" type="button" class="btn btn-primary w-100 border-radius-round">Abonnez-vous maintenant</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endif
