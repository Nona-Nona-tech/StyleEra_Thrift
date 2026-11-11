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
        .logo { font-size: 24px; font-weight: 700; color: #285943; white-space: nowrap; }

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
            .features { margin: -24px 10px 0; }
            .values-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 360px) {
            .grid { grid-template-columns: 1fr; }
        }

        .product-questions {
           margin-top: 32px;
           padding: 24px;
           background: white;
           border: 1px solid #dce3da;
           border-radius: 12px;
        }

        .question-form {
           margin-bottom: 28px;
        }

        .question-form label {
           display: block;
           font-weight: 700;
        }

        .question-form textarea {
           display: block;
           width: 100%;
           margin: 12px 0;
           padding: 12px;
           border: 1px solid #9aa793;
           border-radius: 7px;
           font: inherit;
           resize: vertical;
        }

        .question-form button {
           border: 0;
           font: inherit;
           cursor: pointer;
        }

        .question-help,
        .question-meta {
           color: #596653;
           font-size: 14px;
        }

        .question-success {
           padding: 12px;
           background: #e4edde;
           color: #285943;
           border-radius: 7px;
        }

        .question-error {
           color: #b91c1c;
        }

       .question-item {
           padding: 20px 0;
           border-top: 1px solid #dce3da;
      }

      .question-text {
          white-space: pre-wrap;
          overflow-wrap: anywhere;
     }

    .shop-answer {
        margin-top: 12px;
        padding: 14px;
        background: #f6f7f3;
        border-left: 3px solid #285943;
    }

    .answer-label {
        margin-top: 0;
        font-weight: 700;
    }

    .question-pagination {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 16px;
        margin-top: 20px;
    }

    .question-pagination a,
    .product-questions > p a {
       text-decoration: underline;
     }

    .site-header {
    background: #fff;
    border-bottom: 1px solid #dce3da;
    }

    .shop-header-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    min-height: 88px;
    padding: 16px 0;
    }

    .shop-header-top .logo {
    flex-shrink: 0;
    font-size: 25px;
    letter-spacing: -0.5px;
    }

    .shop-search {
    display: flex;
    flex: 1;
    min-width: 0;
    max-width: 420px;
    margin: 0;
    }

    .shop-search input {
    flex: 1;
    width: 100%;
    min-width: 0;
    padding: 11px 16px;
    border: 1px solid #cbd6c6;
    border-right: 0;
    border-radius: 24px 0 0 24px;
    background: #f8faf6;
    color: #24352b;
    font: inherit;
    font-size: 14px;
    }

    .shop-search button {
    padding: 11px 18px;
    border: 1px solid #285943;
    border-radius: 0 24px 24px 0;
    background: #285943;
    color: #fff;
    font: inherit;
    font-size: 14px;
    cursor: pointer;
    }

    .shop-search button:hover {
    background: #193d2d;
    }

    .shop-account {
    flex-shrink: 0;
    }

    .account-dropdown{
        position: relative;
    }

    .account-trigger {
       display: flex;
       align-items: center;
       gap: 9px;
       padding: 10px 14px;
       border: 1px solid #dce3da;
       border-radius: 24px;
       background: #fff;
       color: #285943;
       font-size: 14px;
       font-weight: 600;
       list-style: none;
       cursor: pointer;
       white-space: nowrap;
    }
    .account-trigger::-webkit-details-marker {
       display: none;
    }

    .account-trigger:hover,
    .account-dropdown[open] .account-trigger {
       background: #edf2e9;
       border-color: #9caf9b;
    }

    .account-chevron {
       font-size: 13px;
       transition: transform 0.15s ease;
    }

    .account-dropdown[open] .account-chevron{
        transform: rotate(180deg);
    }

    .account-pannel{
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        z-index: 100;
        width: 240px;
        max-width: calc(100vw - 32px);
        padding: 8px;
        border: 1px solid #dce3da;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 12px 32px rgba(36, 53, 43, 0.14);
    }

    .account-pannel-heading{
        padding: 10px 12px 14pz;
        margin-bottom: 6px;
        border-bottom: 1px solid #edf0e9;
    }

    .account-pannel-heading span{
        display: block;
        color:#687565;
        font-size: 12px;
    }

    .account-pannel-heading strong{
        display: block;
        margin-top: 3px;
        font-size: 14px;
        overflow-wrap: anywhere;
    }

    .account-panel > a,
    .account-logout button {
       display: block;
       width: 100%;
       padding: 10px 12px;
       border: 0;
       border-radius: 7px;
       background: transparent;
       color: #285943;
       text-align: left;
       font: inherit;
       font-size: 14px;
       cursor: pointer;
    }

    .account-panel>a:hover,
    .account-logout button:hover{
        background: #edf2e9;
    }

    .account-logout {
    margin: 6px 0 0;
    padding-top: 6px;
    border-top: 1px solid #edf0e9;
}

.account-logout button {
    color: #9b3434;
}

.account-logout button:hover {
    background: #fff1f0;
}
.guest-account-links {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 14px;
    white-space: nowrap;
}

.signin-link {
    color: #285943;
}
.signin-link:hover {
    text-decoration: underline;
    text-underline-offset: 4px;
}

.register-link {
    padding: 9px 16px;
    border: 1px solid #285943;
    border-radius: 24px;
    background: #285943;
    color: #fff;
}
.register-link:hover {
    background: #193d2d;
}

.shop-category-nav {
    display: flex;
    align-items: center;
    gap: 28px;
    padding: 0 0 12px;
    overflow-x: auto;
}
.shop-category-nav a {
    flex-shrink: 0;
    padding: 7px 0;
    border-bottom: 2px solid transparent;
    color: #52614e;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    white-space: nowrap;
}

.shop-category-nav a:hover,
.shop-category-nav a.active {
    border-bottom-color: #285943;
    color: #285943;
}
.shop-search input:focus-visible,
.shop-search button:focus-visible,
.account-trigger:focus-visible,
.account-logout button:focus-visible {
    outline: 3px solid #bb792b;
    outline-offset: 3px;
}
@media (max-width: 900px) {
    .shop-header-top {
        flex-wrap: wrap;
        gap: 14px;
    }

    .shop-account {
        margin-left: auto;
    }

    .shop-search {
        order: 3;
        flex: 0 0 100%;
        max-width: none;
    }
    .shop-category-nav {
        gap: 24px;
    }
}

@media (max-width: 600px) {
    .shop-header-top {
        padding: 14px 0;
    }

    .shop-header-top .logo {
        font-size: 21px;
    }
     .account-trigger {
        gap: 6px;
        padding: 9px 11px;
        font-size: 12px;
    }

    .guest-account-links {
        gap: 10px;
        font-size: 12px;
    }

    .register-link {
        padding: 8px 12px;
    }
}
@media (max-width: 360px) {
    .shop-header-top .logo {
        font-size: 18px;
    }

    .account-trigger svg {
        display: none;
    }
}


    </style>
</head>

<body>
    @php($isHome = !$product && $selectedCategory === null && empty($search))

    <header class="site-header">
        <div class="container">
            <div class="shop-header-top">
            <a href="{{ route('home') }}" class="logo">StyleEra Thrift</a>

            <form action="{{ route('home') }}" method="GET" class="shop-search" role="search">

            <input type="search" name="q" value="{{ $search?? '' }}" placeholder="Search clothing..." ari-label="Search clothing">
            
            <button type="submit">Search</button>
            
        </form>

        <div class="shop-account">
            @auth
            <details class="account-dropdown">
                <summary class="account-trigger">
                 <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <circle cx="12" cy="8" r="4" ></circle>
                    <path d="M4 21v-2a8 8 0 0 1 16 0v2"></path>
                </svg>

                <span>
                    @can ('access-admin') 
                    Admin Account
                    @else
                        My Account
                    @endcan
                </span>

                <span class="account=chevron" aria-hidden="true"></span>
                </summary>

                <div class="account-pannel">
                    <div class="account-pannel-heading">
                        <span>Signed is as</span>
                        <strong>{{ auth()->user()->name }}</strong>
                    </div>

                    @can('access-admin')
                        <a href="{{ route('admin.dashboard')}}">
                            Admin Dashboard
                        </a>
                        @endcan

                        <a href="{{ route('profile.edit') }}" >
                            My Profile
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="account-logout"> 
                            @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </details>
        @else
            <div class="guest-account-links">
                <a href="{{ route('login') }}" class="signin-link">Sign in</a>

                <a href="{{ route('register') }}" class="register-link">Register</a>
                </div>
            @endauth
        </div>
    </div>

    <nav class="shop-category-nav" aria-label="main navigation">
        <a href="{{ route('home') }}" class="{{ $isHome ? 'active': '' }}"
        @if ($isHome) aria-current="page" 
        @endif>Home</a>
    
    @foreach ($categories as $key=> $label )
        <a href="{{ route('category',$key) }}" class={{ $selectedCategory=== $key ? 'active' : '' }}
        @if ($selectedCategory===$key)
         aria-current="page"
        @endif
        >
        {{ $label }}
        </a>
    @endforeach
    </nav>
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

            <section class="product-questions" id="questions">
                <h2>Questions &amp; Answers</h2>
                
                @if (session('status') || session('success'))
        <p class="question-success" role="status">
            {{ session('status')?? session('success') }}
        </p>
    @endif

     @auth
        @if (auth()->user()->role === 'customer')
            <form
                action="{{ route('products.questions.store', [
                    'product' => $product->id
                ]) }}"
                method="POST"
                class="question-form"
            >
                @csrf
                 <label for="question">Ask about this product</label>

                <p class="question-help" id="question-help">
                    Your question will be public. Do not include your
                    email address, phone number, or delivery address.
                </p>

                 <textarea
                    id="question"
                    name="question"
                    rows="4"
                    maxlength="1000"
                    aria-describedby="question-help"
                    required
                >{{ old('question') }}</textarea>

                @error('question')
                    <p class="question-error">{{ $message }}</p>
                @enderror

                <button type="submit" class="button">
                    Submit Question
                </button>
            </form>
        @else
                <a href="{{ route('admin.questions.index') }}">
                </a>
        @endif
    @else
        <p>
            <a href="{{ route('login') }}">Log in</a>
            to ask a question about this product.
        </p>

        @endauth

    <div class="question-list">
        @forelse ($questions as $question)
            <article class="question-item">
                <p class="question-meta">
                    {{ $question->customer_name }}
                    ·
                    {{ \Illuminate\Support\Carbon::parse(
                        $question->created_at
                    )->format('d M Y') }}
                </p>

                <p class="question-text">{{ $question->question }}</p>

                @if ($question->answer !== null)
                    <div class="shop-answer">
                        <p class="answer-label">
                            Reply from StyleEra Thrift
                        </p>

                        <p class="question-text">{{ $question->answer }}</p>
                    </div>
                @else
                    <p class="question-help">Waiting for a reply.</p>
                @endif

                @can('access-admin')
                    <form action="{{ route('admin.questions.update', ['id' => $question->id]) }}"method="POST" class="question-form admin-answer-form">
    

                @csrf
                @method('PUt')
                <label for="answer-{{ $question->id }}">{{ $question->answer === null? 'Write a public shop reply': 
                'Edit your public shop reply' }}
            </label>
            
            <textarea id="answer-{{ $question->id }}" name="answer" row="4" maxlength="2000"
                required> {{ (string) old('question_id')===(string) $question->id? old('answer',$question->answer):$question->answer }}</textarea>

            <input type="hidden" name="question_id" value="{{ $question->id }}"
        >

        @if ((string) old('question_id') === (string) $question->id)
            @error('answer')
                <p class="question-error">{{ $message }}</p>
            @enderror
        @endif

        <button type="submit" class="button"> {{ $question->answer === null? 'Save Answer': 'Update Answer' }}</button>
    </form>
@endcan
        

        @empty
            <p>No questions yet.</p>
        @endforelse
    </div>

    @if ($questions->hasPages())
        <nav class="question-pagination" aria-label="Questions pagination">
            @if ($questions->previousPageUrl())
                <a href="{{ $questions->previousPageUrl() }}#questions">
                    Previous
                </a>
            @endif

            <span>
                Page {{ $questions->currentPage() }}
                of {{ $questions->lastPage() }}
            </span>

            @if ($questions->nextPageUrl())
                <a href="{{ $questions->nextPageUrl() }}#questions">
                    Next
                </a>
            @endif
        </nav>
    @endif
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