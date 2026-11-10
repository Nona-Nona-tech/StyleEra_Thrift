<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | StyleEra Thrift</title>

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
            max-width: 1150px;
            margin: 20px auto;
        }

        a {
            color: #285943;
        }

        .navigation {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .heading h1 {
            margin-bottom: 8px;
        }

        .table-wrapper {
            overflow-x: auto;
            background: white;
            border: 1px solid #dfe5da;
            border-radius: 12px;
        }

        table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px;
            text-align: left;
            vertical-align: middle;
            border-bottom: 1px solid #e5eadd;
        }

        th {
            background: #e4edde;
            font-size: 14px;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .product-photo {
            display: block;
            width: 65px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }

        .no-photo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 65px;
            height: 80px;
            padding: 6px;
            background: #eef1ea;
            border-radius: 6px;
            font-size: 12px;
            text-align: center;
            color: #596653;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            background: #edf2e6;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .button {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 6px;
            background: #285943;
            color: white;
            text-decoration: none;
            white-space: nowrap;
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .pagination-links {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .disabled {
            color: #777;
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

        /* View Details: solid green */
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
        <nav class="navigation" aria-label="Admin navigation">
            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            <a href="{{ route('home') }}">View Store</a>
        </nav>

        <div class="heading">
            <h1>Manage Products</h1>
            <p>Total products: {{ $products->total() }}</p>
        </div>

        <p>
           <a href="{{ route('admin.products.create') }}" class="button">Add Product</a>
        </p>

        @if(session('success'))
        <p
            role="status"
            style="padding:14px; background:#e4edde; border-radius:8px;">
            {{ session('success') }}
        </p>
        @endif
        <p>View your shop's products below.Editting and deletion will be added later</p>

        <div class="table-wrapper">
            <table>
                <caption style="padding: 12px; text-align: left;">
                    Shop product catalogue
                </caption>

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Condition</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>

                            <td>
                                @if (
                                    $product->main_image_path &&
                                    is_file(public_path($product->main_image_path))
                                )
                                    <img
                                        class="product-photo"
                                        src="{{ asset($product->main_image_path) }}"
                                        alt="{{ $product->name }}"
                                        loading="lazy"
                                    >
                                @else
                                    <span class="no-photo">No photo</span>
                                @endif
                            </td>

                            <td>{{ $product->name }}</td>

                            <td>{{ $product->category_name }}</td>

                            <td>
                                ${{ number_format($product->price, 2) }}
                            </td>

                            <td>
                                <span class="badge">
                                    {{ $product->condition }}
                                </span>
                            </td>

                            <td>
                                <div class="actions">

                                    <a href="{{ route('product.show', ['id' => $product->id]) }}"
                                       class="act act-view" aria-label="View details of {{ $product->name }}">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                        <span>View Details</span>
                                    </a>

                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="act act-edit" aria-label="Edit {{ $product->name }}">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.1 2.1 0 013 3L7 19l-4 1 1-4 12.5-12.5z"/>
                                        </svg>
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="act act-delete" aria-label="Delete {{ $product->name }}">
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
                            <td colspan="7">
                                No products have been added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($products->total() > 0)
            <nav class="pagination" aria-label="Product list pages">
                <span>
                    Showing {{ $products->firstItem() }}
                    to {{ $products->lastItem() }}
                    of {{ $products->total() }} products
                </span>

                <div class="pagination-links">
                    @if ($products->onFirstPage())
                        <span class="disabled">Previous</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" rel="prev">
                            Previous
                        </a>
                    @endif

                    <span>
                        Page {{ $products->currentPage() }}
                        of {{ $products->lastPage() }}
                    </span>

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" rel="next">
                            Next
                        </a>
                    @else
                        <span class="disabled">Next</span>
                    @endif
                </div>
            </nav>
        @endif
    </main>
</body>
</html>