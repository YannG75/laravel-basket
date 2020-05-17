@include('partials.head')
    <body>
    @include('partials.nav')

        <main id="home">
                @foreach($products as $product)
                <a href="/product/{{$product->id}}" id="article" class="rounded">
                    <article  >
                        <div class="text-center mb-3">
                            <img  src="{{$product->image}}" alt="" width="90%">
                        </div>
                        <h3>{{$product->name}}</h3>
                        <span>{{$product->price}} €</span>
                    </article>
                </a>
                    @endforeach

        </main>
    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>

    </body>
</html>
