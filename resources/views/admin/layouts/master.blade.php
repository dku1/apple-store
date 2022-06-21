<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/admin/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/admin/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/css/admin/OverlayScrollbars.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item  d-sm-inline">
                <div class="nav-link">
                    <a href="{{ route('index') }}">Apple Store</a>
                </div>
            </li>
            <li>
                <select name="currency" onchange="window.location.href=this.options[this.selectedIndex].value"
                        class="form-select bg-secondary currency" aria-label="Default select example">
                    @foreach($currencies as $currency)
                        <option @if(session('currency') == $currency->code) selected
                                @endif value="{{ route('currency', $currency->code ) }}"><a
                                href="{{ route('currency', $currency->code) }}">{{ $currency->symbol }}</a>
                        </option>
                    @endforeach
                </select>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('products.index') }}" class="brand-link text-center">
            <span class="brand-text font-weight-light">Admin panel</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class=" mt-3 pb-3 mb-3 d-flex justify-content-center">
                <a>
                    {{ \Illuminate\Support\Facades\Auth::user()->email }}
                </a>
            </div>
            @if(session()->has('success'))
                <p class="alert alert-success text-center">{{ session()->get('success') }}</p>
            @elseif(session()->has('warning'))
                <p class="alert alert-danger text-center">{{ session()->get('warning') }}</p>
        @endif

        <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="{{ route('products.index') }}">Товары</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="{{ route('modifier.change.options') }}">Выбор опций модификаторов</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="{{ route('add-modifier') }}">Присвоение модификаторов</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="{{ route('modifiers.index') }}">Модификаторы товаров</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="{{ route('categories.index') }}" >Категории</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="{{ route('admin.orders.index') }}">Заказы</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="{{ route('admin.users.index') }}">Пользователи</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="{{ route('currencies.index') }}">Валюты</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="{{ route('coupons.index') }}">Купоны</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="#">Локализация</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn btn-secondary">
                        <a href="#">Контакты</a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper iframe-mode bg-dark" data-widget="iframe" data-auto-dark-mode="true"
         data-loading-screen="750">
        @yield('content')
    </div>

</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="/js/admin/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/js/admin/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/js/admin/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/js/admin/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/admin/adminlte.js"></script>
</body>
</html>

