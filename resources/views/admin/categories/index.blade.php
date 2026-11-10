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

        .error {
          padding: 14px;
          background: #fff0ee;
          border: 1px solid #d9a49c;
          border-radius: 8px;
          color: #8a261d;
        }

        /* ---------- Action buttons ---------- */
        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .actions form {
            margin: 0;
        }

        .act {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 36px;
            padding: 0 14px;
            border: 1px solid transparent;
            border-radius: 8px;
            font: inherit;
            font-size: 14px;
            line-height: 1;
            white-space: nowrap;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }

        .act svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .act:focus-visible {
            outline: 3px solid #bb792b;
            outline-offset: 2px;
        }

        /* View Category: solid green */
        .act-view {
            background: #285943;
            color: #fff;
        }

        .act-view:hover {
            background: #193d2d;
        }

        /* Edit: green outline */
        .act-edit {
            background: #fff;
            color: #285943;
            border-color: #285943;
        }

        .act-edit:hover {
            background: #e4edde;
        }

        /* Delete: soft red, solid red on hover */
        .act-delete {
            background: #fef3f2;
            color: #b42318;
            border-color: #fecdca;
        }

        .act-delete:hover {
            background: #b42318;
            color: #fff;
            border-color: #b42318;
        }

        /* Small screens: show icons only */
        @media (max-width: 700px) {
            .act span {
                display: none;
            }

            .act {
                padding: 0 11px;
            }
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

        @if (session('error'))
            <p class="error" role="alert">
                {{ session('error') }}
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
                                ]) }}"
                                   class="act act-view" aria-label="View category {{ $category->name }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    <span>View Category</span>
                                </a>
                            </td>

                            <td>
                                <div class="actions">

                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="act act-edit" aria-label="Edit {{ $category->name }}">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.1 2.1 0 013 3L7 19l-4 1 1-4 12.5-12.5z"/>
                                        </svg>
                                        <span>Edit</span>
                                    </a>

                                    <form
                                        action="{{ route('admin.categories.destroy', [
                                            'id' => $category->id
                                        ]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this category? This action cannot be undone.');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="act act-delete" aria-label="Delete {{ $category->name }}">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M3 6h18"/>
                                                <path d="M8 6V4h8v2"/>
                                                <path d="M6 6l1 14h10l1-14"/>
                                            </svg>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                </div>
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