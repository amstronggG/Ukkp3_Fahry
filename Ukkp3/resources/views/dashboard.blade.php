<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard</h2>
    </x-slot>

    <div class="glass-card">
        <h3 style="font-size: 1.5rem; margin-top:0; color: #f8fafc;">Halo, {{ Auth::user()->name }}!</h3>
        
        @if(Auth::user()->isAdmin())
            <div style="margin-top: 1.5rem; padding: 1.5rem; background: rgba(251, 191, 36, 0.1); border-left: 4px solid #fbbf24; border-radius: 8px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                    <!-- Ikon Shield Admin -->
                    <svg width="20" height="20" fill="none" stroke="#fbbf24" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <p style="color: #fbbf24; font-weight: 700; font-size: 1.1rem; margin: 0;">Anda login sebagai ADMIN</p>
                </div>
                <p style="color: #cbd5e1; margin-bottom: 1.5rem;">Di sini Anda memiliki akses penuh untuk mengelola data user.</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 8px;">
                    Kelola User 
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        @else
            <div style="margin-top: 1.5rem; padding: 1.5rem; background: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; border-radius: 8px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                    <!-- Ikon User Biasa -->
                    <svg width="20" height="20" fill="none" stroke="#60a5fa" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <p style="color: #60a5fa; font-weight: 700; font-size: 1.1rem; margin: 0;">Anda login sebagai USER</p>
                </div>
                <p style="color: #cbd5e1;">Selamat datang di dashboard. Silakan buat laporan jika ada keluhan.</p>
            </div>
        @endif
    </div>
</x-app-layout>