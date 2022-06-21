<aside class="left">
    <div class="row">
        <div class="col-sm-3 col-sm-8">
            <form action="{{ route('filters') }}" method="post" class="filter">
                @csrf
                @foreach(['new' => 'Новинка', 'recommend' => 'Рекомендуем', 'popular' => 'Популярные'] as $filter => $name)
                    <div class="form-check" style="margin-left: 25px;margin-top: 15px">
                        <input class="form-check-input" type="checkbox" id="{{ $filter }}" name="{{ $filter }}"
                               @if(isset($activeFilters) and in_array($filter, $activeFilters)) checked @endif >
                        <label class="form-check-label" for="{{ $filter }}">
                            {{ $name }}
                        </label>
                    </div>
                @endforeach
                <div class="form-check" style="margin-top: 30px">
                    <div class="input-group mb-3">
                        <span class="input-group-text">От</span>
                        <span class="input-group-text">{{ $currency->getSymbol() }}</span>
                        <input type="text" name="price_from" class="form-control" style="width: 90px"
                               aria-label="Dollar amount (with dot and two decimal places)"
                               @if(isset($activeFilters) and key_exists('price_from', $activeFilters))  value="{{ $activeFilters['price_from'] }}" @endif>
                    </div>
                </div>
                <div class="form-check">
                    <div class="input-group">
                        <input type="text" name="price_to" class="form-control" style="width: 90px"
                               aria-label="Dollar amount (with dot and two decimal places)"
                               @if(isset($activeFilters) and key_exists('price_to', $activeFilters))  value="{{ $activeFilters['price_to'] }}" @endif>
                        <span class="input-group-text">{{ $currency->getSymbol() }}</span>
                        <span class="input-group-text">До</span>
                    </div>
                </div>
                <div class="form-check" style="margin-top: 30px">
                    <button class="btn btn-primary">Применить</button>
                </div>
            </form>
        </div>
    </div>
</aside>
