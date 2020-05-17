@include('partials.head')
<body>
@include('partials.nav')

@if(session('success') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


<main id="product">
    <article>
        <img width="100%" src="{{$product->image}}" alt="">
    </article>

    <article class="d-flex flex-column">
        <h2>{{$product->name}}</h2>
        <span><b>Prix :</b> {{$product->price}} €</span>
        <span><b>date de sortie:</b> {{\Illuminate\Support\Carbon::parse($product->release_date)->toFormattedDateString()}}
        </span>
        <span> <b>Coloris :</b> Unique</span>
        <p>
            <b>Description:</b>
            {{$product->description}}
        </p>



        <form action="/product/{{$product->id}}" method="post">
            @csrf
            <input type="hidden" name="color" value="Unique">
            <div class="form-group">
                <label for="size" class="font-weight-bold">Selectionnez une taille</label>
                <select class="form-control" name="size" id="size">
                    @for($i=36; $i<=49; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>

                <label for="quantity" class="font-weight-bold">Quantité </label>
                <select class="form-control" name="quantity" id="quantity">
                    @for($i=1; $i<=10; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
        </form>

    </article>
</main>

</body>
</html>
