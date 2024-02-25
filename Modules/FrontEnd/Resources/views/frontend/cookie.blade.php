<div id="cookie">
    <div class="wrapper">
        <header>
            <i class="bx bx-cookie"></i>
            <h2>Consentement aux cookies</h2>
        </header>

        <div class="data">
            <p>Ce site Web utilise des cookies pour vous aider à avoir une expérience de navigation supérieure et plus pertinente sur le site Web.
                <a href="#"> En savoir plus...</a>
                <a href="{{ route('frontend.page.single','termes-et-conditions') }}" target="_blank">En savoir plus...</a></
            </p>
        </div>

        <div class="buttons">
            <button class="button" id="acceptBtn">Accepter</button>
            <a href="{{ route('frontend.subscription') }}" class="button" id="declineBtn">Déclin</a>
        </div>
    </div>
</div>
