<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | StyleEra Thrift</title>

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
            max-width: 520px;
            margin: 30px auto;
        }

        a {
            color: #285943;
        }

        form {
            margin-top: 20px;
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

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd6c6;
            border-radius: 6px;
            font: inherit;
        }

        .error {
            margin: 6px 0 0;
            color: #a32620;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #285943;
            color: white;
            border: 0;
            border-radius: 7px;
            font: inherit;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <main class="container">
        <a href="{{ route('home') }}">Back to Home</a>

        <h1>Login</h1>
        <p>Use the email and password you registered with.</p>

        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <div class="field">
                <label for="email">Email address</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                >

                @error('email')
                    <p class="error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    autocomplete="current-password"
                    required
                >

                @error('password')
                    <p class="error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Login</button>
        </form>

        <p>
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </p>
    </main>
</body>
</html>