<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | StyleEra Thrift</title>

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
            justify-content: center;
            padding: 24px 16px 40px;
            background: var(--page);
            font-family: Arial, sans-serif;
            color: var(--dark);
            line-height: 1.5;
        }

        a:focus-visible, button:focus-visible, input:focus-visible {
            outline: 3px solid var(--dark);
            outline-offset: 2px;
        }

        .page { width: min(460px, 100%); }

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
            padding: 28px 18px 22px;
            border-radius: 36px;
            background-color: var(--pattern);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120' viewBox='0 0 120 120' fill='none' stroke='white' stroke-opacity='0.45' stroke-width='1.5'%3E%3Cpath d='M14 58C14 30 42 18 64 18C64 46 44 72 14 58Z'/%3E%3Cpath d='M14 58L54 26'/%3E%3Ccircle cx='92' cy='34' r='12'/%3E%3Cpath d='M92 22C92 16 96 12 100 12'/%3E%3Cpath d='M70 96C70 78 88 70 104 72C104 90 90 106 70 96Z'/%3E%3Cpath d='M70 96L96 76'/%3E%3Ccircle cx='28' cy='100' r='7'/%3E%3C/svg%3E");
            box-shadow: 0 12px 30px rgba(30, 106, 20, 0.18);
        }

        .stack { display: grid; gap: 20px; }

        .card {
            padding: 28px 22px 24px;
            border-radius: 26px;
            background: var(--card);
            box-shadow: 0 10px 24px rgba(30, 106, 20, 0.2);
        }

        h1 { margin: 0; text-align: center; font-size: 28px; }
        h2 { margin: 0; text-align: center; font-size: 22px; }
        .sub { margin: 4px 0 6px; text-align: center; color: var(--text); font-size: 14px; }

        /* Summary */
        .summary { text-align: center; }

        .avatar {
            width: 80px;
            height: 80px;
            margin: 0 auto 12px;
            border-radius: 50%;
            background: var(--dark);
            color: white;
            font-size: 32px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .email-text { margin: 2px 0 0; color: var(--text); font-size: 14px; word-break: break-all; }

        .member {
            display: inline-block;
            margin-top: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            background: var(--field);
            color: var(--dark);
            font-size: 12px;
        }

        /* Messages */
        .alert {
            margin-bottom: 16px;
            padding: 12px 16px;
            border-radius: 14px;
            font-size: 14px;
        }

        .alert-success { background: var(--field); color: var(--dark); border: 1px solid var(--dark); }
        .alert-error { background: #fef3f2; color: var(--danger); border: 1px solid #fecdca; }

        /* Fields */
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
            margin-top: 22px;
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
@php
    // Small icons used in the boxes (fixed text, safe to print)
    $userIcon = '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0116 0"/></svg>';
    $mailIcon = '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>';
    $lockIcon = '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V8a4 4 0 018 0v3"/></svg>';
    $eyeIcons = '<svg class="open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg><svg class="off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/><path d="M3 3l18 18"/></svg>';
@endphp

<div class="page">
    <a class="back" href="{{ url('/') }}">&larr; Back to Home</a>

    <div class="screen">

        @if (session('status'))
            <div class="alert alert-success" role="status">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                Please fix the errors below and try again.
            </div>
        @endif

        <div class="stack">

            {{-- Summary --}}
            <section class="card summary">
                <div class="avatar">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</div>
                <h1>My Profile</h1>
                <p class="sub">Manage your account details and password.</p>
                <p class="email-text">{{ $user->name }} &middot; {{ $user->email }}</p>
                @if ($user->created_at)
                    <span class="member">Member since {{ $user->created_at->format('F Y') }}</span>
                @endif
            </section>

            {{-- Personal information --}}
            <section class="card">
                <h2>Personal information</h2>
                <p class="sub">Update your name and email address.</p>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="name">Name</label>
                    <div class="input">
                        {!! $userIcon !!}
                        <input type="text" id="name" name="name"
                               value="{{ old('name', $user->name) }}"
                               autocomplete="name"
                               class="{{ $errors->has('name') ? 'invalid' : '' }}" required>
                    </div>
                    @error('name')
                        <p class="error" role="alert">{{ $message }}</p>
                    @enderror

                    <label for="email">Email</label>
                    <div class="input">
                        {!! $mailIcon !!}
                        <input type="email" id="email" name="email"
                               value="{{ old('email', $user->email) }}"
                               autocomplete="email"
                               class="{{ $errors->has('email') ? 'invalid' : '' }}" required>
                    </div>
                    @error('email')
                        <p class="error" role="alert">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn">Update Profile</button>
                </form>
            </section>

            {{-- Change password --}}
            <section class="card">
                <h2>Change password</h2>
                <p class="sub">Use a strong password that you don't use anywhere else.</p>

                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="current_password">Current password</label>
                    <div class="input">
                        {!! $lockIcon !!}
                        <input type="password" id="current_password" name="current_password"
                               placeholder="••••••••••"
                               autocomplete="current-password"
                               class="{{ $errors->has('current_password') ? 'invalid' : '' }}" required>
                        <button type="button" class="eye" data-target="current_password" aria-label="Show password">{!! $eyeIcons !!}</button>
                    </div>
                    @error('current_password')
                        <p class="error" role="alert">{{ $message }}</p>
                    @enderror

                    <label for="password">New password</label>
                    <div class="input">
                        {!! $lockIcon !!}
                        <input type="password" id="password" name="password"
                               placeholder="••••••••••"
                               autocomplete="new-password"
                               class="{{ $errors->has('password') ? 'invalid' : '' }}" required>
                        <button type="button" class="eye" data-target="password" aria-label="Show password">{!! $eyeIcons !!}</button>
                    </div>
                    @error('password')
                        <p class="error" role="alert">{{ $message }}</p>
                    @else
                        <p class="hint">Use at least 8 characters.</p>
                    @enderror

                    <label for="password_confirmation">Confirm new password</label>
                    <div class="input">
                        {!! $lockIcon !!}
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="••••••••••"
                               autocomplete="new-password" required>
                        <button type="button" class="eye" data-target="password_confirmation" aria-label="Show password">{!! $eyeIcons !!}</button>
                    </div>

                    <button type="submit" class="btn">Change Password</button>
                </form>
            </section>
        </div>

        <p class="brand">StyleEra Thrift</p>
    </div>
</div>

<script>
    // Show / hide password (works for all 3 password boxes)
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