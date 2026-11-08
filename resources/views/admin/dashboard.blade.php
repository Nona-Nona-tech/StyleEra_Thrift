<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | StyleEra Thrift</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 24px;
            font-family: Arial, sans-serif;
            background: #f6f7f3;
            color: #24352b;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
        }

        .panel {
            margin-top: 24px;
            padding: 24px;
            background: white;
            border: 1px solid #dfe5da;
            border-radius: 12px;
        }

        a {
            color: #285943;
        }

        button {
            padding: 10px 16px;
            border: 0;
            border-radius: 7px;
            background: #285943;
            color: white;
            font: inherit;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <main class="container">
        <a href="{{ route('home') }}">Back to Store</a>

        <h1>Admin Dashboard</h1>

        <p>Welcome, {{ auth()->user()->name }}.</p>

        <section class="panel">
            <h2>Shop management</h2>

            <p>Your admin access is working.</p>

            <ul>
                <li>
                    <a href="{{ route('admin.products.index') }}">
                        Manage Products
                    </a>

                </li>

                <li>
                    <a href="{{ route('admin.categories.index') }}">
                        Manage Categories
                    </a>
                    - list and add
                </li>
                <li>User management — not built yet</li>
                <li>Order management — not built yet</li>
            </ul>
        </section>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <p>
                <button type="submit">Logout</button>
            </p>
        </form>
    </main>
</body>
</html>