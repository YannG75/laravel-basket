@include('partials.head')
<body>
@include('partials.nav')
<h1 class="text-center mb-5">Commande passé avec succès !</h1>
<main class="container-fluid mt-3 text-center mb-5">
    <h2 class="mb-4">Récapitulatif de votre commande :</h2>
<section id="products" class="d-flex flex-column justify-content-center align-items-center mb-5">
    <h3 class="mb-4">Produit acheté :</h3>

    @foreach($products as $product)

        <div class="mb-3 w-25">
            <div class="row no-gutters d-flex justify-content-center">
                <div class="col-md-8 ">
                    <div class="">
                        <h5 class="">{{$product['product']['name']}}</h5>
                        <div class="d-flex flex-column justify-content-around">
                            <span><b>Quantité :</b> {{$product['quantity']}}</span>
                            <span><b>Coloris :</b> {{$product['color']}}</span>
                            <span><b>taille :</b> {{$product['size']}}</span>
                            <span><b>Prix unitaire :</b> {{$product['product']['price']}} €</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <h4>Pour un total de {{@session('total')}} €</h4>
</section>
    <section id="data" class="mb-5">
        <h3>Vos informations :</h3>
            <div class="d-flex flex-column">
                <span><b>Nom :</b> {{$customer['name']}}</span>
                <span><b>Mail :</b> {{$customer['email']}}</span>
                <span><b>Adresse :</b> {{$customer['address']}}</span>
            </div>
    </section>

    <a href="/" class="btn btn-warning">Retour sur la Page d'accueil</a>

</main>
</body>
