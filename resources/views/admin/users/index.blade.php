<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registered Customers | StyleEra Thrift</title>

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
            max-width: 1000px;
            margin: 20px auto;
        }

        a {
            color: #285943;
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

        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .page-link {
            display: inline-block;
            padding: 8px 14px;
            border: 1px solid #cbd6c6;
            border-radius: 6px;
            background: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main class="container">
        <a href="{{ route('admin.dashboard') }}">
            Back to Dashboard
        </a>

        <h1>Registered Customers</h1>

        <p>
            Total customers: {{ $users->total() }}
        </p>

        <p>
            This page lists customer accounts only.
            Admin accounts are not shown.
        </p>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered on</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->created_at ?? 'Not recorded' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                No customer accounts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <nav class="pagination" aria-label="Customer list pages">
                <div>
                    @if (! $users->onFirstPage())
                        <a
                            class="page-link"
                            href="{{ $users->previousPageUrl() }}"
                        >
                            Previous
                        </a>
                    @endif
                </div>

                <span>
                    Page {{ $users->currentPage() }}
                    of {{ $users->lastPage() }}
                </span>

                <div>
                    @if ($users->hasMorePages())
                        <a
                            class="page-link"
                            href="{{ $users->nextPageUrl() }}"
                        >
                            Next
                        </a>
                    @endif
                </div>
            </nav>
        @endif
    </main>
</body>
</html>