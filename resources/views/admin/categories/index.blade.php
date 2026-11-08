<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Categories | StyleEra Thrift</title>

    <style>
        body {
            margin: 0;
            padding: 24px;
            font-family: Arial, sans-serif;
            background: #f6f7f3;
            color: #24352b;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
        }

        a {
            color: #285943;
        }

        .button {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 7px;
            background: #285943;
            color: white;
            text-decoration: none;
        }

        .success {
            padding: 14px;
            background: #e4edde;
            border-radius: 8px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid #dfe5da;
            text-align: left;
        }

        th {
            background: #e4edde;
        }
    </style>
</head>

<body>
    <main class="container">
        <a href="{{ route('admin.dashboard') }}">
            Back to Dashboard
        </a>

        <h1>Manage Categories</h1>

        <p>
            <a
                href="{{ route('admin.categories.create') }}"
                class="button"
            >
                Add Category
            </a>
        </p>

        @if (session('success'))
            <p class="success" role="status">
                {{ session('success') }}
            </p>
        @endif

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Products</th>
                        <th>Customer page</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td>
                                <a href="{{ route('category', [
                                    'category' => $category->slug
                                ]) }}">
                                    View Category
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('admin.categories.edit',$category->id) }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>