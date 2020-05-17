<nav class="navbar navbar-light mb-2" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="/">
        <img src= "{{asset('image/ecommerce.logo_.png')}}" alt="e-commerce logo" height="60px" >
    </a>

    <div class="p-2">
        <a href="#" ><i class="fas fa-user-circle"></i><span class="mr-5 font-weight-bold"> Profile</span></a>
        <a href="/basket"><span>Panier</span> <i class="fas fa-shopping-basket"></i> @if(session('basket.products')) <span class="badge badge-danger">{{count(session('basket.products'))}}</span> @endif</a>
    </div>
</nav>
