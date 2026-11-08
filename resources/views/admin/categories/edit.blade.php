<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Category | StyleEra Thrift</title>

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
            max-width: 650px;
            margin: 20px auto;
        }

        a {
            color: #285943;
        }

        form {
            padding: 24px;
            background: white;
            border: 1px solid #dfe5da;
            border-radius: 12px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd6c6;
            border-radius: 6px;
            font: inherit;
        }

        .help {
            color: #596653;
        }

        .errors {
            margin-bottom: 20px;
            padding: 16px;
            background: #fff0ee;
            border: 1px solid #d9a49c;
            border-radius: 8px;
            color: #8a261d;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 24px;
        }

        button {
            padding: 12px 20px;
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
        <a href="{{ route('admin.categories.index') }}">
            Back to Manage Categories
        </a>

        <h1>Edit Category</h1>

        @if ($errors->any())
            <div class="errors" role="alert">
                <p>Please correct the following:</p>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.categories.update', $category->id) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <label for="name">Category name</label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $category->name) }}"
                maxlength="100"
                required
            >

            <p class="help">
                Current URL slug:
                <code>{{ $category->slug }}</code>
            </p>

            <p class="help">
                Renaming this category will not change its URL slug
                or move its products.
            </p>

            <div class="actions">
                <button type="submit">Save Changes</button>

                <a href="{{ route('admin.categories.index') }}">
                    Cancel
                </a>
            </div>
        </form>
    </main>
</body>
</html>