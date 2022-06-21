@extends('layouts.master')

@section('title', 'Товар - ' . $product->name)

@section('content')

    <section class="product">
        <div class="container">
            <div class="row">
                <img src="{{ '/storage/'.$product->img }} " alt="Изображение недоступно">
                <h3>{{ $product->name }}</h3>
                <h5 class="text-center"><p
                        class="price">{{ ceil($currency->convert($product->price)) }} {{ $currency->getSymbol() }}</p>
                </h5>
                <p class="description">
                    {{ $product->description }}
                </p>
                @if($product->available())
                    <div class="bottom d-flex justify-content-end">
                        <p>
                            <a href="{{ route('cart.add', $product) }}" class="btn btn-success add-cart">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path
                                        d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                    <path
                                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </a>
                        </p>
                    </div>
                @else
                    <div class="d-flex justify-content-end">
                        <p>Товар недоступен для заказа</p>
                    </div>
                    @if(Auth::check() and $subscriber->isEmailSigned(Auth::user()->email, $product))
                        <form action="{{ route('subscribers.destroy', $product) }}" class="row g-3" method="POST" style="width: 450px; margin: auto">
                            @csrf
                            <span>Вы подписаны на рассылку о данном товаре</span>
                            <input type="email" value="{{ Auth::user()->email }}" name="email" hidden>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-danger mb-3" style="margin-left: 110px">Отписаться</button>
                            </div>
                        </form>

                    @else
                        <form action="{{ route('subscribers.add', $product) }}" class="row g-3" method="post">
                            @csrf
                            <h5 class="text-center">Вы можете подписаться на рассылку!</h5>
                            <p class="text-center">Вам придёт email уведомление когда товар появится в наличии</p>
                            <div class="col-auto" style="width: 350px; margin-left: 150px">
                                <label for="email" class="visually-hidden">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                       @if(Auth::check()) value="{{ Auth::user()->email }}" @endif placeholder="email">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success mb-3">Подписаться</button>
                            </div>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </section>
@endsection
