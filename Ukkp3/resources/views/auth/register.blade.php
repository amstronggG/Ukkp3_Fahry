<x-guest-layout>
    <style>
        .login-title { text-align: center; margin-bottom: 0.5rem; font-size: 1.5rem; font-weight: 700; color: #ffffff; }
        .login-subtitle { text-align: center; margin-bottom: 2rem; font-size: 0.875rem; color: #94a3b8; }
        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #cbd5e1; }
        .form-input { width: 100%; padding: 0.75rem 1rem; background-color: rgba(15, 23, 42, 0.6); border: 1px solid #475569; border-radius: 8px; color: #ffffff; font-size: 0.95rem; box-sizing: border-box; transition: all 0.2s; }
        .form-input:focus { outline: none; border-color: #fbbf24; box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.2); }
        .btn-submit { width: 100%; padding: 0.85rem; background: linear-gradient(to right, #fbbf24, #f59e0b); border: none; border-radius: 8px; color: #0f172a; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 14px 0 rgba(251, 191, 36, 0.3); margin-top: 1rem;}
        .btn-submit:hover { background: linear-gradient(to right, #fcd34d, #fbbf24); transform: translateY(-1px); }
        .register-text { text-align: center; margin-top: 1.5rem; font-size: 0.875rem; color: #94a3b8; }
        .link-gold { color: #fbbf24; text-decoration: none; font-weight: 500; }
        .link-gold:hover { text-decoration: underline; }
    </style>

    <h2 class="login-title">Daftar Akun</h2>
    <p class="login-subtitle">Silakan isi data diri Anda</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required class="form-input" placeholder="Nama Anda">
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-input" placeholder="email@example.com">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" required class="form-input" placeholder="••••••••">
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="form-input" placeholder="••••••••">
        </div>

        <button type="submit" class="btn-submit">DAFTAR SEKARANG</button>

        <div class="register-text">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="link-gold">Masuk di sini</a>
        </div>
    </form>
</x-guest-layout>