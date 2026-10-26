<x-guest-layout>
    <style>
        /* CSS Khusus Form Login */
        .login-title {
            text-align: center;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
        }
        .login-subtitle {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 0.875rem;
            color: #94a3b8;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #cbd5e1;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: rgba(15, 23, 42, 0.6);
            border: 1px solid #475569;
            border-radius: 8px;
            color: #ffffff;
            font-size: 0.95rem;
            box-sizing: border-box;
            transition: all 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #fbbf24;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.2);
        }
        .form-input::placeholder {
            color: #64748b;
        }
        .flex-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            color: #94a3b8;
            cursor: pointer;
        }
        .checkbox-label input {
            margin-right: 0.5rem;
            accent-color: #fbbf24;
        }
        .link-gold {
            color: #fbbf24;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .link-gold:hover {
            color: #fcd34d;
            text-decoration: underline;
        }
        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(to right, #fbbf24, #f59e0b);
            border: none;
            border-radius: 8px;
            color: #0f172a;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 14px 0 rgba(251, 191, 36, 0.3);
        }
        .btn-submit:hover {
            background: linear-gradient(to right, #fcd34d, #fbbf24);
            box-shadow: 0 6px 20px 0 rgba(251, 191, 36, 0.4);
            transform: translateY(-1px);
        }
        .register-text {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #94a3b8;
        }
    </style>

    <h2 class="login-title">Selamat Datang</h2>
    <p class="login-subtitle">Silakan masuk ke akun Anda</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-input" placeholder="admin@test.com">
            @error('email')
                <p style="color: #f87171; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" required class="form-input" placeholder="••••••••">
            @error('password')
                <p style="color: #f87171; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex-row">
            <label class="checkbox-label">
                <input type="checkbox" name="remember">
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link-gold">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="btn-submit">MASUK</button>

        <div class="register-text">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="link-gold">Daftar sekarang</a>
        </div>
    </form>
</x-guest-layout>