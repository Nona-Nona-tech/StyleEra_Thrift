<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | StyleEra Thrift</title>

    <style>
        * { box-sizing: border-box; }

        :root {
            --page: #dffbd6;
            --pattern: #7fdc93;
            --card: #ccf7c4;
            --field: #f1fff0;
            --dark: #1e6a14;
            --brand: #14420d;
            --text: #2f7a25;
            --icon: #7fb77a;
            --danger: #a32620;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            background: var(--page);
            font-family: Arial, sans-serif;
            color: var(--dark);
            line-height: 1.5;
        }

        a:focus-visible, button:focus-visible, input:focus-visible {
            outline: 3px solid var(--dark);
            outline-offset: 2px;
        }

        .page { width: min(420px, 100%); }

        .back {
            display: inline-block;
            margin: 0 0 12px 6px;
            font-size: 14px;
            color: var(--brand);
            text-decoration: none;
        }

        .back:hover { text-decoration: underline; }

        /* Green leafy background */
        .screen {
            padding: 36px 20px 22px;
            border-radius: 36px;
            background-color: var(--pattern);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120' viewBox='0 0 120 120' fill='none' stroke='white' stroke-opacity='0.45' stroke-width='1.5'%3E%3Cpath d='M14 58C14 30 42 18 64 18C64 46 44 72 14 58Z'/%3E%3Cpath d='M14 58L54 26'/%3E%3Ccircle cx='92' cy='34' r='12'/%3E%3Cpath d='M92 22C92 16 96 12 100 12'/%3E%3Cpath d='M70 96C70 78 88 70 104 72C104 90 90 106 70 96Z'/%3E%3Cpath d='M70 96L96 76'/%3E%3Ccircle cx='28' cy='100' r='7'/%3E%3C/svg%3E");
            box-shadow: 0 12px 30px rgba(30, 106, 20, 0.18);
        }

        .card {
            padding: 32px 24px 24px;
            border-radius: 26px;
            background: var(--card);
            box-shadow: 0 10px 24px rgba(30, 106, 20, 0.2);
        }

        h1 { margin: 0; text-align: center; font-size: 28px; }
        .sub { margin: 4px 0 10px; text-align: center; color: var(--text); }

        label {
            display: block;
            margin: 16px 0 6px 6px;
            font-size: 14px;
            color: var(--text);
        }

        .input { position: relative; }

        .input input {
            width: 100%;
            padding: 14px 46px;
            border: 0;
            border-radius: 14px;
            background: var(--field);
            font: inherit;
            font-size: 15px;
            color: var(--dark);
        }

        .input input::placeholder { color: #9ccb97; }
        .input input.invalid { box-shadow: 0 0 0 2px var(--danger); }

        .icon {
            position: absolute;
            left: 16px;
            top: 50%;
            width: 20px;
            height: 20px;
            transform: translateY(-50%);
            color: var(--icon);
            pointer-events: none;
        }

        .eye {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            padding: 6px;
            border: 0;
            background: none;
            color: var(--icon);
            cursor: pointer;
        }

        .eye svg { width: 20px; height: 20px; }
        .eye .off { display: none; }
        .eye.on .off { display: block; }
        .eye.on .open { display: none; }

        .hint { margin: 6px 0 0 6px; font-size: 12px; color: var(--text); }
        .error { margin: 6px 0 0 6px; font-size: 13px; color: var(--danger); }

        .btn {
            width: 100%;
            margin-top: 24px;
            padding: 14px;
            border: 0;
            border-radius: 999px;
            background: var(--dark);
            color: white;
            font: inherit;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover { background: var(--brand); }

        .switch { margin: 18px 0 0; text-align: center; font-size: 13px; color: var(--text); }
        .switch a { color: var(--dark); font-weight: 700; }

        .brand {
            margin: 22px 0 0;
            text-align: center;
            font-family: Georgia, serif;
            font-size: 26px;
            font-style: italic;
            font-weight: 700;
            color: var(--brand);
        }
    </style>
</head>

<body>
    <div class="page">
        <a class="back" href="{{ route('home') }}">&larr; Back to Home</a>

        <div class="screen">
            <div class="card">
                <h1>Sign up</h1>
                <p class="sub">Register as a customer of StyleEra Thrift.</p>

                <form action="{{ route('register.store') }}" method="POST">
                    @csrf

                    @error('role')
                        <p class="error" role="alert">{{ $message }}</p>
                    @enderror

                    {{-- Name --}}
                    <label for="name">Name</label>
                    <div class="input">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 21a8 8 0 0116 0"/>
                        </svg>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Your name"
                            maxlength="255"
                            autocomplete="name"
                            class="{{ $errors->has('name') ? 'invalid' : '' }}"
                            required
                        >
                    </div>
                    @error('name')
                        <p class="error" role="alert">{{ $message }}</p>
                    @enderror

                    {{-- Email --}}
                    <label for="email">Email</label>
                    <div class="input">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2"/>
                            <path d="M3 7l9 6 9-6"/>
                        </svg>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="example@gmail.com"
                            maxlength="255"
                            autocomplete="email"
                            class="{{ $errors->has('email') ? 'invalid' : '' }}"
                            required
                        >
                    </div>
                    <p class="hint">Use lowercase letters in your email address.</p>
                    @error('email')
                        <p class="error" role="alert">{{ $message }}</p>
                    @enderror

                    {{-- Password --}}
                    <label for="password">Password</label>
                    <div class="input">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="5" y="11" width="14" height="10" rx="2"/>
                            <path d="M8 11V8a4 4 0 018 0v3"/>
                        </svg>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••••"
                            minlength="8"
                            autocomplete="new-password"
                            class="{{ $errors->has('password') ? 'invalid' : '' }}"
                            required
                        >
                        <button type="button" class="eye" data-target="password" aria-label="Show password">
                            <svg class="open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg class="off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>
                    <p class="hint">Use at least 8 characters, including letters and numbers.</p>
                    @error('password')
                        <p class="error" role="alert">{{ $message }}</p>
                    @enderror

                    {{-- Confirm password --}}
                    <label for="password_confirmation">Confirm password</label>
                    <div class="input">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="5" y="11" width="14" height="10" rx="2"/>
                            <path d="M8 11V8a4 4 0 018 0v3"/>
                        </svg>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="••••••••••"
                            minlength="8"
                            autocomplete="new-password"
                            required
                        >
                        <button type="button" class="eye" data-target="password_confirmation" aria-label="Show password">
                            <svg class="open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg class="off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="btn">Create Customer Account</button>
                </form>

                <p class="switch">
                    Already have an account?
                    <a href="{{ route('login') }}">Log in</a> here!
                </p>
            </div>

            <p class="brand">StyleEra Thrift</p>
        </div>
    </div>

    <script>
        // Show / hide password (works for both password boxes)
        document.querySelectorAll('.eye').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.dataset.target);
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.classList.toggle('on', show);
                btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            });
        });
    </script>
</body>
</html>