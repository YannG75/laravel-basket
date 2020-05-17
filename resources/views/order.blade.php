@include('partials.head')
<body>
@include('partials.nav')
<h1 class="text-center mb-5">Passer la commande de ({{count($basket)}} {{count($basket)>1 ? 'articles': 'article'}}) </h1>

<main class="container-fluid mb-5">
    <form action="/order" method="post" class="w-75 m-auto">
        @csrf
        <div>
            <section id="customer">
                <h3 class="mb-5">Informations Personnelles</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nom<b class="text-danger">*</b></label>
                        <input type="text" class="form-control @error('form.customer.name') is-invalid @enderror" id="name" name="form[customer][name]" placeholder="Gaspard Arlong" value="{{ old('form.customer.name') }}">
                        @error('form.customer.name')
                        <span class="text-danger">Field required</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email<b class="text-danger">*</b></label>
                        <input type="email" class="form-control @error('form.customer.email') is-invalid @enderror" id="email" name="form[customer][email]" placeholder="LeGenieDuCode@hotmail.fr" value="{{ old('form.customer.email') }}">
                        @error('form.customer.email')
                        <span class="text-danger">Field required with a correct email</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">adresse<b class="text-danger">*</b></label>
                    <input type="text" class="form-control @error('form.customer.address') is-invalid @enderror" id="address" name="form[customer][address]" placeholder="1234 Main St" value="{{ old('form.customer.address') }}">
                    @error('form.customer.address')
                    <span class="text-danger">Field required</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="complement">Complément</label>
                    <input type="text" class="form-control" id="complement" name="form[customer][complement]" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">Ville<b class="text-danger">*</b></label>
                        <input type="text" class="form-control @error('form.customer.city') is-invalid @enderror" id="city" name="form[customer][city]" placeholder="Paris" value="{{ old('form.customer.city') }}">
                        @error('form.customer.city')
                        <span class="text-danger">Field required</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="zip">Code Postal<b class="text-danger">*</b></label>
                        <input type="text" class="form-control @error('form.customer.zip') is-invalid @enderror" id="zip" name="form[customer][zip]" placeholder="75014" value="{{ old('form.customer.zip') }}">
                        @error('form.customer.zip')
                        <span class="text-danger">Field required | integer only</span>
                        @enderror
                    </div>
                </div>

            </section>

            <section id="paiement" class="mt-5">
                <h3 class="mb-5">Informations Bancaires</h3>
                <div class='form-row'>
                    <div class='col-xs-12 form-group required'>
                        <label class='control-label'>Nom sur la Carte<b class="text-danger">*</b></label>
                        <input class='form-control @error('form.card.name') is-invalid @enderror' size='4' type='text' name="form[card][name]" value="{{ old('form.card.name') }}">
                        @error('form.card.name')
                        <span class="text-danger">Field required</span>
                        @enderror
                    </div>
                </div>
                <div class='form-row'>
                    <div class='col-xs-12 form-group card required'>
                        <label class='control-label'>N° de carte<b class="text-danger">*</b></label>
                        <input autocomplete='off' class='form-control @error('form.card.card_number') is-invalid @enderror card-number' size='20' type='text' name="form[card][card_number]">
                        @error('form.card.card_number')
                        <span class="text-danger">Field required | integer only</span>
                        @enderror
                    </div>
                </div>
                <div class='form-row'>
                    <div class='col-xs-4 form-group cvc required'>
                        <label class='control-label'>CVC<b class="text-danger">*</b></label>
                        <input autocomplete='off' class='form-control @error('form.card.cvc') is-invalid @enderror card-cvc' placeholder='ex. 311' size='4' type='text' name="form[card][cvc]">
                        @error('form.card.cvc')
                        <span class="text-danger">Field required | integer only</span>
                        @enderror
                    </div>
                    <div class='col-xs-4 form-group expiration required'>
                        <label class='control-label'>Expiration<b class="text-danger">*</b></label>
                        <input class='form-control @error('form.card.expiration_month') is-invalid @enderror card-expiry-month' placeholder='MM' size='2' type='text' name="form[card][expiration_month]">
                        @error('form.card.expiration_month')
                        <span class="text-danger">Field required | integer only</span>
                        @enderror
                    </div>
                    <div class='col-xs-4 form-group expiration required'>
                        <label class='control-label'> </label>
                        <input class='form-control @error('form.card.expiration_year') is-invalid @enderror card-expiry-year' placeholder='YYYY' size='4' type='text' name="form[card][expiration_year]">
                        @error('form.card.expiration_year')
                        <span class="text-danger">Field required | integer only</span>
                        @enderror
                    </div>
                </div>

            </section>

            <section id="recap" class="mt-5">
                <h3 class="mb-5">Récapitulatif de votre commande </h3>
                @foreach($basket as $id => $product)
                <div class=" mb-3 position-relative" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-8">
                            <div class="">
                                <h5 class="">{{$product['product']->name}}</h5>
                                <div class="d-flex flex-column justify-content-around">
                                    <span><b>Quantité :</b> {{$product['quantity']}}</span>
                                    <span><b>Coloris :</b> {{$product['color']}}</span>
                                    <span><b>taille :</b> {{$product['size']}}</span>
                                    <span><b>Prix unitaire :</b> {{$product['product']->price}} €</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach
            </section>

            <div class="border-top border-dark mb-3 pt-3">
                <span><b>Total :</b> {{session('total')}} €</span>
            </div>

            <button type="submit" class="btn btn-warning">Je passe ma commande !</button>
        </div>

    </form>
</main>
</body>
</html>
