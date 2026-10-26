<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <!-- Ikon Users (SVG) -->
                <div style="background: rgba(251, 191, 36, 0.1); padding: 10px; border-radius: 12px; border: 1px solid rgba(251, 191, 36, 0.2);">
                    <svg width="28" height="28" fill="none" stroke="#fbbf24" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 style="margin: 0; font-size: 1.5rem; color: #f8fafc;">Kelola User</h2>
                    <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: #94a3b8;">Manajemen data pengguna aplikasi</p>
                </div>
            </div>
            
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="display: flex; align-items: center; gap: 8px; padding: 0.7rem 1.5rem;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                Tambah User
            </a>
        </div>
    </x-slot>

    <div class="glass-card">
        <!-- Pencarian -->
        <form method="GET" style="margin-bottom: 2rem; display: flex; gap: 12px;">
            <div style="position: relative; flex: 1;">
                <!-- Ikon Search di dalam Input -->
                <svg style="position: absolute; left: 12px; top: 12px; color: #64748b;" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau email..." 
                       style="width: 100%; padding: 0.7rem 1rem 0.7rem 2.5rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: rgba(15,23,42,0.6); color: white; outline: none; box-sizing: border-box; transition: 0.3s;"
                       onfocus="this.style.borderColor='#fbbf24'; this.style.boxShadow='0 0 0 3px rgba(251, 191, 36, 0.2)'"
                       onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'">
            </div>
            <button class="btn" style="background: rgba(255,255,255,0.05); color: white; border: 1px solid rgba(255,255,255,0.1); padding: 0.7rem 1.5rem;">Cari</button>
        </form>

        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.1); border-left: 4px solid #4ade80; color: #4ade80; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel User -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama</th>
                        <th style="width: 30%;">Email</th>
                        <th style="width: 15%;">Role</th>
                        <th style="width: 25%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $i => $u)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td style="color: #94a3b8;">{{ $users->firstItem() + $i }}</td>
                            <td style="font-weight: 500; color: #f8fafc;">{{ $u->name }}</td>
                            <td style="color: #cbd5e1;">{{ $u->email }}</td>
                            <td>
                                @if($u->role === 'admin')
                                    <span class="badge" style="background: rgba(251, 191, 36, 0.1); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3);">Admin</span>
                                @else
                                    <span class="badge" style="background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3);">User</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; justify-content: center; gap: 8px;">
                                    <a href="{{ route('admin.users.edit', $u) }}" class="btn" style="background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3); padding: 0.4rem 1rem;">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn" style="background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.4rem 1rem;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align: center; padding: 3rem; color: #94a3b8;">Belum ada data user.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div style="margin-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem;">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>