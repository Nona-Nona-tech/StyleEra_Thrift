<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product ? $product->name . ' | StyleEra Thrift' : 'StyleEra Thrift' }}</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f6f7f3;
            color: #24352b;
            line-height: 1.6;
        }

        a { color: inherit; text-decoration: none; }

        a:focus-visible {
            outline: 3px solid #bb792b;
            outline-offset: 4px;
        }

        .container { width: min(1100px, 92%); margin: auto; }

        header {
            background: white;
            border-bottom: 1px solid #dce3da;
        }

        .header-content {
            min-height: 76px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo { font-size: 24px; font-weight: 700; color: #285943; white-space: nowrap; }

        .main-nav {
            display: flex;
            gap: 20px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .main-nav a:hover { text-decoration: underline; text-underline-offset: 4px; }

        .search { display: flex; flex: 1; max-width: 360px; }
        .search input { flex: 1; padding: 9px 14px; border: 1px solid #cbd6c6; border-radius: 24px 0 0 24px; font-size: 15px; }
        .search button { padding: 9px 18px; border: 0; background: #285943; color: white; border-radius: 0 24px 24px 0; cursor: pointer; }

        
        .banner {
            margin-top: 30px;
            padding: 60px 40px;
            border-radius: 18px;
            background: linear-gradient(135deg, #e4edde, #f3ead7);
        }

        .banner h1 {
            margin: 0 0 14px;
            font-family: Georgia, serif;
            font-size: clamp(32px, 6vw, 56px);
            line-height: 1.1;
            font-weight: 400;
        }

        .banner h1 strong { display: block; }

        .banner p { max-width: 420px; margin: 0 0 24px; color: #40552d; }

        .banner-buttons { display: flex; gap: 12px; flex-wrap: wrap; }

        .features {
            position: relative;
            margin: -24px 24px 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            text-align: center;
        }

        .features div { padding: 16px 10px; border-right: 1px solid #eef1ea; }
        .features div:last-child { border-right: 0; }
        .features strong { display: block; font-size: 14px; }
        .features span { font-size: 12px; color: #596653; }

        .section { margin-top: 40px; }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }

        .section-head h2 { margin: 0; font-size: 15px; text-transform: uppercase; letter-spacing: 0.06em; }
        .section-head a { font-size: 13px; color: #596653; text-decoration: underline; }

        .circles { display: flex; gap: 22px; overflow-x: auto; padding: 16px 0 6px; }
        .circle-item { flex: none; width: 96px; text-align: center; font-size: 13px; }

        .circle {
            width: 80px;
            height: 80px;
            margin: 0 auto 8px;
            border-radius: 50%;
            background: #e7ebe2;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            font-family: Georgia, serif;
            font-size: 26px;
            color: #596653;
        }

        .circle img { width: 100%; height: 100%; object-fit: cover; }
        .circle-item span.name { display: block; }

        .row-scroll { display: flex; gap: 16px; overflow-x: auto; padding: 16px 0 8px; }
        .row-item { flex: none; width: 210px; }

        .promos { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 40px; }
        .promo { padding: 26px; border-radius: 14px; background: #e4edde; }
        .promo.dark { background: #285943; color: white; }
        .promo.warm { background: #f3ead7; }
        .promo small { display: block; opacity: 0.8; }
        .promo h3 { margin: 6px 0 16px; font-family: Georgia, serif; font-size: 24px; font-weight: 400; }
        .promo .button { padding: 8px 16px; }
        .promo.dark .button { background: white; color: #285943; }
        .promo .soon { display: inline-block; border: 1px solid #9aa793; border-radius: 7px; padding: 8px 16px; color: #596653; }

        .categories {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 30px 0 28px;
        }

        .category {
            padding: 8px 17px;
            background: white;
            border: 1px solid #cbd6c6;
            border-radius: 24px;
        }

        .category:hover, .category.active {
            background: #285943;
            border-color: #285943;
            color: white;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 15px;
            margin-top: 40px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border: 1px solid #dfe5da;
            border-radius: 12px;
            overflow: hidden;
        }

        .image {
            aspect-ratio: 4 / 5;
            background: #e7ebe2;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .image img { width: 100%; height: 100%; object-fit: cover; }

        .placeholder {
            padding: 20px;
            text-align: center;
            color: #596653;
        }

        .card-body { padding: 16px; }

        .card h3 { margin: 10px 0; font-size: 17px; }

        .badge {
            display: inline-block;
            background: #edf2e6;
            color: #40552d;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .price { color: #285943; font-size: 22px; font-weight: 700; }

        .button {
            display: inline-block;
            background: #285943;
            color: white;
            padding: 10px 16px;
            border-radius: 7px;
            text-align: center;
        }

        .button:hover { background: #193d2d; }
        .button.outline { background: transparent; color: #285943; border: 1px solid #285943; }
        .button.outline:hover { background: #285943; color: white; }
        .card .button { width: 100%; }

    
        .breadcrumb { margin: 25px 0; }
        .breadcrumb a { text-decoration: underline; }

        .detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .detail .image { border-radius: 14px; }
        .detail h1 { line-height: 1.25; }
        .detail .price { font-size: 30px; }

        .specs div {
            display: grid;
            grid-template-columns: 110px 1fr;
            padding: 10px 0;
            border-bottom: 1px solid #dce3d5;
        }

        .specs dt { font-weight: 700; }
        .specs dd { margin: 0; }

        .values { background: #eef1ea; margin-top: 50px; }
        .values-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; padding: 24px 0; text-align: center; }
        .values strong { display: block; }
        .values span { font-size: 13px; color: #596653; }

        footer {
            padding: 20px;
            text-align: center;
            border-top: 1px solid #dce3da;
            color: #596653;
        }


        @media (max-width: 900px) {
            .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .features { grid-template-columns: repeat(2, 1fr); }
            .promos { grid-template-columns: 1fr; }
        }

        @media (max-width: 600px) {
            .detail { grid-template-columns: 1fr; gap: 20px; }
            .banner { padding: 36px 22px; }
            .grid { gap: 12px; }
            .card-body { padding: 12px; }
            .heading { display: block; }
            .header-content { flex-wrap: wrap; padding: 10px 0; }
            .main-nav { order: 2; width: 100%; overflow-x: auto; white-space: nowrap; }
            .search { order: 3; max-width: none; width: 100%; }
            .features { margin: -24px 10px 0; }
            .values-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 360px) {
            .grid { grid-template-columns: 1fr; }
        }

        .account-links {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 14px;
        }

        .account-links form {
            margin: 0;
        }

        .account-links button {
            padding: 8px 12px;
            border: 1px solid #cbd6c6;
            border-radius: 7px;
            background: white;
            color: #285943;
            font: inherit;
            cursor: pointer;

        }
    </style>
</head>

<body>
    @php($isHome = !$product && $selectedCategory === null && empty($search))

    <header>
        <div class="container header-content">
            <a href="{{ route('home') }}" class="logo">StyleEra Thrift</a>

            <nav class="main-nav" aria-label="Main navigation">
                @foreach ($categories as $key => $label)
                    <a href="{{ route('category', $key) }}">{{ $label }}</a>
                @endforeach
            </nav>

            <form action="{{ route('home') }}" method="GET" class="search">
                <input type="search" name="q" value="{{ $search ?? '' }}"
                       placeholder="Search clothing..." aria-label="Search clothing">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="account-links">
            @auth
        <span>Hello, {{ auth()->user()->name }}</span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
            @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
            @endauth
    </div>
    </header>

   <main class="container">

         @if (session('success'))
        <p role="status" style="padding: 14px; background: #e4edde; border-radius: 7px;">
            {{ session('success') }}
        </p>
        @endif

        @if ($product)
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                /
                <a href="{{ route('category', $product->category) }}">
                    {{ $categories[$product->category] }}
                </a>
                / {{ $product->name }}
            </div>

            <section class="detail">
                <div class="image">
                    @if (is_file(public_path($product->main_image_path)))
                        <img
                            src="{{ asset($product->main_image_path) }}"
                            alt="{{ $product->name }}"
                        >
                    @else
                        <div class="placeholder">
                            Add photo:<br>{{ $product->main_image_path }}
                        </div>
                    @endif
                </div>

                <div>
                    <span class="badge">{{ $product->condition }}</span>

                    <h1>{{ $product->name }}</h1>

                    <p class="price">
                        ${{ number_format($product->price, 2) }}
                    </p>

                    <dl class="specs">
                        <div>
                            <dt>Category</dt>
                            <dd>{{ $categories[$product->category] }}</dd>
                        </div>
                        <div>
                            <dt>Size</dt>
                            <dd>{{ $product->size }}</dd>
                        </div>
                        <div>
                            <dt>Color</dt>
                            <dd>{{ $product->color }}</dd>
                        </div>
                        <div>
                            <dt>Condition</dt>
                            <dd>{{ $product->condition }}</dd>
                        </div>
                    </dl>

                    <h2>Description</h2>
                    <p>{{ $product->description }}</p>

                    <a href="{{ route('category', $product->category) }}" class="button">
                        Back to category
                    </a>
                </div>
            </section>
        @else
            @if ($isHome)
                <section class="banner">
                    <h1>Give clothes <strong>a second life</strong></h1>
                    <p>Pre-loved and new pieces from sellers in Cambodia. Trendy styles, friendly prices, good for the planet.</p>
                    <div class="banner-buttons">
                        <a href="#new" class="button">Shop new arrivals</a>
                        <a href="#all" class="button outline">Browse all clothing</a>
                    </div>
                </section>

                <section class="features">
                    <div><strong>Secondhand &amp; new</strong><span>Affordable pieces for everyone</span></div>
                    <div><strong>Ask the seller</strong><span>Questions on every product</span></div>
                    <div><strong>Easy search</strong><span>Find items in seconds</span></div>
                    <div><strong>Sustainable</strong><span>Reuse clothes, reduce waste</span></div>
                </section>

                <section class="section">
                    <div class="section-head">
                        <h2>Shop by category</h2>
                        <a href="#all">View all</a>
                    </div>
                    <div class="circles">
                        @foreach ($categories as $key => $label)
                            @php($first = $products->firstWhere('category', $key))
                            <a href="{{ route('category', $key) }}" class="circle-item">
                                <span class="circle">
                                    @if ($first && is_file(public_path($first->main_image_path)))
                                        <img src="{{ asset($first->main_image_path) }}" alt="">
                                    @else
                                        {{ mb_substr($label, 0, 1) }}
                                    @endif
                                </span>
                                <span class="name">{{ $label }}</span>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="section" id="new">
                    <div class="section-head">
                        <div>
                            <h2>New arrivals</h2>
                            <small>Fresh styles. Just in.</small>
                        </div>
                        <a href="#all">View all</a>
                    </div>
                    <div class="row-scroll">
                        @foreach ($products->sortByDesc('id')->take(6) as $item)
                            <div class="row-item">
                                @include('partials.product_card', ['item' => $item])
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="promos">
                    <div class="promo dark">
                        <small>Student-friendly</small>
                        <h3>Affordable style</h3>
                        <a href="#all" class="button">Shop now</a>
                    </div>
                    <div class="promo warm">
                        <small>Just listed</small>
                        <h3>New arrivals</h3>
                        <a href="#new" class="button">Shop now</a>
                    </div>
                    <div class="promo">
                        <small>Got clothes you no longer wear?</small>
                        <h3>Sell them here</h3>
                        <span class="soon">Coming soon</span>
                    </div>
                </section>
            @else
                <nav class="categories" aria-label="Clothing categories">
                    <a href="{{ route('home') }}"
                       class="category {{ $selectedCategory === null ? 'active' : '' }}">
                        All
                    </a>

                    @foreach ($categories as $key => $label)
                        <a href="{{ route('category', $key) }}"
                           class="category {{ $selectedCategory === $key ? 'active' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>
            @endif
             <div class="heading" id="all">
                <h2>
                    @if (!empty($search))
                        Results for "{{ $search }}"
                    @else
                        {{ $selectedCategory ? $categories[$selectedCategory] : 'All Clothing' }}
                    @endif
                </h2>
                <p>{{ $products->count() }} products</p>
            </div>

            <section class="grid" aria-label="Product listings">
                @forelse ($products as $item)
                    @include('partials.product_card', ['item' => $item])
                @empty
                    <p>{{ !empty($search) ? 'No products match your search.' : 'No products in this category yet.' }}</p>
                @endforelse
            </section>
        @endif
    </main>

    <section class="values">
        <div class="container values-grid">
            <div><strong>Sustainable fashion</strong><span>Better for you, better for the planet.</span></div>
            <div><strong>Affordable prices</strong><span>Good style should not cost a lot.</span></div>
            <div><strong>Community focused</strong><span>Buyers and sellers, side by side.</span></div>
        </div>
    </section>

    <footer>
        StyleEra Thrift
    </footer>
</body>
</html>