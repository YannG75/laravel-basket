@include('partials.head')
<body>
@include('partials.nav')
<main class="container-fluid">
    @if(session('success') )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
        @if(session('error') )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <h1 class="text-center mb-5">Votre Panier</h1>

        @if(!empty($basket))
        <div id="basket" class="d-flex justify-content-around">
            <section>
                @foreach($basket as $id => $product)
                    <div class="card mb-3 shadow-sm position-relative" style="max-width: 540px;">
                        <form action="/basket/{{$id}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn rounded-circle btn-sm position-absolute delBtn"><i class="far fa-times-circle text-danger"></i></button>
                        </form>
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{$product['product']->image}}" class="card-img" alt="">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$product['product']->name}}</h5>
                                    <div class="d-flex flex-column justify-content-around">
                                        <form action="/basket/{{$product['product']->id}}" method="post">
                                            @method('put')
                                            @csrf
                                            <label for="quantity">Quantité :</label>
                                            <select class="form-control" name="quantity" id="quantity" >
                                                @for($i=1; $i<=10; $i++)
                                                    @if ($i == $product['quantity'])
                                                        <option selected value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <button type="submit"  class="btn btn-warning mt-2">changer</button>
                                        </form>
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
            <section>
                <div class="card shadow-sm" >
                    <div class="card-body text-center">
                        <h5 class="card-title">Montant total a payer :</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$total}} €</h6>
                        <a href="/order" class="btn btn-warning">Passer commande</a>

                    </div>
                </div>
            </section>
        </div>
        @else

            <div class="empty text-center">
                <h2>Votre panier est vide pour le moment...</h2>
            </div>
            @endif


</main>
</body>
</hmtl>
