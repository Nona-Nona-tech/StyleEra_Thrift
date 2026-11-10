<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | StyleEra Thrift</title>

    <style>
        * { box-sizing: border-box; }

        :root {
            --bg: #edf1f0;
            --mint: #6fdcbd;
            --mint-soft: #d6f4ea;
            --mint-dark: #1f9f7f;
            --text: #1f2d2a;
            --muted: #6b7b76;
            --line: #dde4e1;
            --amber: #b7791f;
            --amber-soft: #fef3c7;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
        }

        a { color: inherit; text-decoration: none; }

        a:focus-visible, button:focus-visible {
            outline: 3px solid var(--mint-dark);
            outline-offset: 2px;
        }

        .app { display: flex; min-height: 100vh; }

        .sidebar {
            width: 264px;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--bg);
            border-right: 1px solid var(--line);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 26px 24px;
            border-bottom: 1px solid var(--line);
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--mint);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
        }

        .brand-name { font-weight: 700; line-height: 1.2; }

        .menu { padding: 22px 18px; display: grid; gap: 8px; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 16px;
            border: 0;
            border-radius: 12px;
            background: none;
            color: #4a5b56;
            font: inherit;
            font-size: 15px;
            text-align: left;
            cursor: pointer;
        }

        .nav-item:hover { background: rgba(255, 255, 255, 0.7); }

        .nav-item.active {
            background: var(--mint);
            color: var(--text);
            font-weight: 700;
            box-shadow: 0 6px 14px rgba(111, 220, 189, 0.45);
        }

        .nav-item.disabled { color: #9aa7a3; cursor: not-allowed; }
        .nav-item.disabled:hover { background: none; }

        .nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }
        .nav-item .label { flex: 1; }

        .soon {
            padding: 2px 8px;
            border-radius: 20px;
            background: var(--amber-soft);
            color: var(--amber);
            font-size: 11px;
            font-weight: 700;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 18px;
            border-top: 1px solid var(--line);
            display: grid;
            gap: 8px;
        }

        .main { flex: 1; min-width: 0; }

        .topbar {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 22px 32px;
        }

        .topbar h1 { margin: 0; font-size: 24px; }

        .menu-btn {
            display: none;
            padding: 9px 14px;
            border: 0;
            border-radius: 10px;
            background: white;
            font: inherit;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .user {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px 6px 6px;
            border-radius: 999px;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            font-size: 14px;
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--mint);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .content { padding: 0 32px 40px; }

        .card {
            background: white;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .welcome { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px; }
        .welcome h2 { margin: 0 0 4px; font-size: 22px; }
        .welcome p { margin: 0; color: var(--muted); }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            background: var(--mint-soft);
            color: var(--mint-dark);
            font-size: 13px;
            font-weight: 700;
        }

        .status::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--mint-dark);
        }

        .section-title { margin: 28px 0 14px; font-size: 18px; }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .tile { display: block; position: relative; transition: transform 0.15s, box-shadow 0.15s; }
        a.tile:hover { transform: translateY(-3px); box-shadow: 0 10px 22px rgba(0, 0, 0, 0.08); }

        .tile-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; }
        .tile h3 { margin: 0; font-size: 16px; }
        .tile .desc { margin: 2px 0 0; font-size: 13px; color: var(--muted); }

        .icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--mint-soft);
            color: var(--mint-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-circle svg { width: 22px; height: 22px; }
        .icon-circle.amber { background: var(--amber-soft); color: var(--amber); }

        .tile-foot {
            margin-top: 22px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .number { font-size: 32px; font-weight: 700; line-height: 1; }
        .go { font-size: 13px; font-weight: 700; color: var(--mint-dark); }
        .tile.off { opacity: 0.75; }
        .tile.off .go { color: var(--amber); }

        /* ---------- Small screens ---------- */
        .backdrop { display: none; }

        @media (max-width: 1100px) {
            .cards { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 900px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.2s;
            }

            .sidebar.open { transform: none; }

            .backdrop.show {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 40;
                background: rgba(0, 0, 0, 0.35);
            }

            .menu-btn { display: block; }
            .topbar, .content { padding-left: 16px; padding-right: 16px; }
        }

        @media (max-width: 560px) {
            .cards { grid-template-columns: 1fr; }
            .user span.name { display: none; }
            .user { padding-right: 6px; }
        }
    </style>
</head>

<body>
@php
    $icons = [
        'home' => 'M3 12l9-9 9 9M5 10v10h5v-6h4v6h5V10',
        'box' => 'M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3zM12 12l8-4.5M12 12v9M12 12L4 7.5',
        'grid' => 'M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z',
        'user' => 'M12 12a4 4 0 100-8 4 4 0 000 8zM4 21a8 8 0 0116 0',
        'bag' => 'M6 8h12l1 12H5L6 8zM9 8V7a3 3 0 016 0v1',
        'shop' => 'M3 9l1.5-5h15L21 9M3 9v11h18V9M3 9c0 2 4 2 4.5 0 .5 2 4 2 4.5 0 .5 2 4 2 4.5 0 .5 2 4.5 2 4.5 0',
        'logout' => 'M15 4h4v16h-4M10 8l-4 4 4 4M6 12h10',
    ];

    $userName = auth()->user()->name;

    // Quick cards. Numbers show only if the page is given $productCount, $categoryCount, $customerCount
    $cards = [
        ['Products', 'Add, edit and remove clothing items.', 'admin.products.index', 'box', $productCount ?? null],
        ['Categories', 'List and add categories.', 'admin.categories.index', 'grid', $categoryCount ?? null],
        ['Customers', 'Registered customer list.', 'admin.users.index', 'user', $customerCount ?? null],
    ];
@endphp

<div class="app">

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-mark">S</div>
            <div class="brand-name">StyleEra<br>Thrift</div>
        </div>

        <nav class="menu" aria-label="Admin menu">
            <a href="{{ url('/admin/dashboard') }}" class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icons['home'] }}"/></svg>
                <span class="label">Dashboard</span>
                @if (request()->is('admin/dashboard'))<span aria-hidden="true">&rsaquo;</span>@endif
            </a>

            <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icons['box'] }}"/></svg>
                <span class="label">Products</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icons['grid'] }}"/></svg>
                <span class="label">Categories</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icons['user'] }}"/></svg>
                <span class="label">Customers</span>
            </a>

            <a href="{{ route('admin.questions.index') }}"class="nav-item {{ request()->routeIs('admin.questions.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none"stroke="currentColor"stroke-width="1.8"stroke-linecap="round"stroke-linejoin="round"aria-hidden="true">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
            </svg>
            <span class="label">Customer Questions</span>
        </a>


            <span class="nav-item disabled" aria-disabled="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icons['bag'] }}"/></svg>
                <span class="label">Orders</span>
                <span class="soon">Soon</span>
            </span>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ route('home') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icons['shop'] }}"/></svg>
                <span class="label">Back to Store</span>
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icons['logout'] }}"/></svg>
                    <span class="label">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="backdrop" id="backdrop"></div>

    <div class="main">
        <header class="topbar">
            <button type="button" class="menu-btn" id="menuBtn" aria-label="Open menu">Menu</button>
            <h1>Overview</h1>

            <div class="user">
                <div class="avatar">{{ mb_strtoupper(mb_substr($userName, 0, 1)) }}</div>
                <span class="name">{{ $userName }}</span>
            </div>
        </header>

        <main class="content">

            <section class="card welcome">
                <div>
                    <h2>Welcome, {{ $userName }}.</h2>
                    <p>Manage your shop from here.</p>
                </div>
                <span class="status">Your admin access is working</span>
            </section>

            <h2 class="section-title">Shop management</h2>

            <div class="cards">
                @foreach ($cards as [$title, $desc, $route, $icon, $count])
                    <a href="{{ route($route) }}" class="card tile">
                        <div class="tile-head">
                            <div>
                                <h3>{{ $title }}</h3>
                                <p class="desc">{{ $desc }}</p>
                            </div>
                            <div class="icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icons[$icon] }}"/></svg>
                            </div>
                        </div>
                        <div class="tile-foot">
                            @if ($count !== null)
                                <span class="number">{{ $count }}</span>
                            @else
                                <span></span>
                            @endif
                            <span class="go">Manage &rarr;</span>
                        </div>
                    </a>
                @endforeach

                <div class="card tile off">
                    <div class="tile-head">
                        <div>
                            <h3>Orders</h3>
                            <p class="desc">Order management is not built yet.</p>
                        </div>
                        <div class="icon-circle amber">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $icons['bag'] }}"/></svg>
                        </div>
                    </div>
                    <div class="tile-foot">
                        <span></span>
                        <span class="go">Coming soon</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    var sidebar = document.getElementById('sidebar');
    var backdrop = document.getElementById('backdrop');

    function toggleMenu() {
        sidebar.classList.toggle('open');
        backdrop.classList.toggle('show');
    }

    document.getElementById('menuBtn').addEventListener('click', toggleMenu);
    backdrop.addEventListener('click', toggleMenu);
</script>

</body>
</html>