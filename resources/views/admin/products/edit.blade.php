<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product | StyleEra Thrift</title>

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
            max-width: 700px;
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

        .field {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd6c6;
            border-radius: 6px;
            font: inherit;
        }

        textarea {
            resize: vertical;
        }

        .current-photo {
            margin: 8px 0 16px;
        }

        .current-photo img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
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
            flex-wrap: wrap;
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

        small {
            color: #596653;
        }
    </style>
</head>

<body>
    <main class="container">
        <a href="{{ route('admin.products.index') }}">
            Back to Manage Products
        </a>

        <h1>Edit Product</h1>

        @if ($errors->any())
            <div class="errors" role="alert">
                <p>Please correct the following:</p>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <p>Please select a new photo again before resubmitting.</p>
            </div>
        @endif

        <form
            action="{{ route('admin.products.update', $product->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="field">
                <label for="name">Product name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $product->name) }}"
                    maxlength="255"
                    required
                >
            </div>

            <div class="field">
                <label for="category_id">Category</label>

                <select id="category_id" name="category_id" required>
                    <option value="">Choose a category</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(
                                (string) old(
                                    'category_id',
                                    $product->category_id
                                ) ===
                                (string) $category->id
                            )
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="price">Price (USD)</label>
                <input
                    id="price"
                    type="number"
                    name="price"
                    value="{{ old('price', $product->price) }}"
                    min="0.01"
                    max="99999999.99"
                    step="0.01"
                    required
                >
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    maxlength="10000"
                    required
                >{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="field">
                <label for="size">Size (optional)</label>
                <input
                    id="size"
                    type="text"
                    name="size"
                    value="{{ old('size', $product->size) }}"
                    maxlength="50"
                    placeholder="For example: M, Age 6-8, One Size"
                >
            </div>

            <div class="field">
                <label for="color">Color (optional)</label>
                <input
                    id="color"
                    type="text"
                    name="color"
                    value="{{ old('color', $product->color) }}"
                    maxlength="50"
                >
            </div>

            <div class="field">
                <label for="condition">Condition</label>

                <select id="condition" name="condition" required>
                    <option value="">Choose a condition</option>

                    <option
                        value="New"
                        @selected(
                            old('condition', $product->condition) === 'New'
                        )
                    >
                        New
                    </option>

                    <option
                        value="Secondhand"
                        @selected(
                            old('condition', $product->condition) ===
                            'Secondhand'
                        )
                    >
                        Secondhand
                    </option>
                </select>
            </div>

            <div class="field">
                <label>Current photo</label>

                <div class="current-photo">
                    <img
                        src="{{ asset($product->main_image_path) }}"
                        alt="{{ $product->name }}"
                    >
                </div>

                <label for="photo">Replace photo (optional)</label>
                <input
                    id="photo"
                    type="file"
                    name="photo"
                    accept="image/jpeg,image/png,image/webp"
                >
                <small>JPG, PNG, or WebP. Maximum size: 2 MB.</small>
            </div>

            <div class="actions">
                <button type="submit">Save Changes</button>

                <a href="{{ route('admin.products.index') }}">Cancel</a>
            </div>
        </form>
    </main>
</body>
</html>