<div class="card" style="width: 13rem;">
    <div class="text-center">
        <img src="{{  '/storage/' . $product->img }}" class="card-img-top" alt="...">
    </div>
    @if($product->issetFilter())
    <div class="card-header filters">
        <ul class="nav nav-pills card-header-pills d-flex justify-content-between">
            @if($product->isNew())
                <li class="nav-item" style="color: green">
                    Новинка
                </li>
            @endif
            @if($product->isPopular())
                <li class="nav-item" style="color: blue">
                    Популярный
                </li>
            @endif
            @if($product->isRecommend())
                <li class="nav-item" style="color: red">
                    Рекомендуем
                </li>
            @endif
        </ul>
    </div>
    @endif
    <div class="card-body">
        <h5><a href="{{ route('product', $product) }}">{{ $product->name }}</a></h5>
        <div class="details d-flex justify-content-between">
            @if($product->available())
                <div class="price">
                    @if($product->old_price)
                        <small>{{ ceil($currency->convert($product->old_price)) }}</small>
                    @endif
                    {{ ceil($currency->convert($product->price))  }}{{ $currency->getSymbol() }}
                </div>
                <div class="add-cart">
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-cart-plus" viewBox="0 0 16 16">
                            <path
                                d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                            <path
                                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </a>
                </div>
            @else
                <div class="not-available">
                    <span>Товар недоступен</span>
                </div>
            @endif
        </div>
    </div>
</div>
