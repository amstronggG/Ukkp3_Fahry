<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <!-- Ikon Dokumen (SVG) -->
                <div style="background: rgba(251, 191, 36, 0.1); padding: 10px; border-radius: 12px; border: 1px solid rgba(251, 191, 36, 0.2);">
                    <svg width="28" height="28" fill="none" stroke="#fbbf24" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 style="margin: 0; font-size: 1.5rem; color: #f8fafc;">Pengaduan Saya</h2>
                    <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: #94a3b8;">Pantau status laporan pengaduan Anda.</p>
                </div>
            </div>
            
            @if(!Auth::user()->isAdmin())
                <a href="{{ route('pengaduan.create') }}" class="btn btn-primary" style="display: flex; align-items: center; gap: 8px; padding: 0.7rem 1.5rem;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Buat Pengaduan
                </a>
            @endif
        </div>
    </x-slot>

    <div class="glass-card">
        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.1); border-left: 4px solid #4ade80; color: #4ade80; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Pencarian -->
        <form method="GET" style="margin-bottom: 2rem; display: flex; gap: 12px;">
            <div style="position: relative; flex: 1;">
                <!-- Ikon Search di dalam Input -->
                <svg style="position: absolute; left: 12px; top: 12px; color: #64748b;" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, email, atau meja..." 
                       style="width: 100%; padding: 0.7rem 1rem 0.7rem 2.5rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: rgba(15,23,42,0.6); color: white; outline: none; box-sizing: border-box; transition: 0.3s;"
                       onfocus="this.style.borderColor='#fbbf24'; this.style.boxShadow='0 0 0 3px rgba(251, 191, 36, 0.2)'"
                       onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'">
            </div>
            <button class="btn" style="background: rgba(255,255,255,0.05); color: white; border: 1px solid rgba(255,255,255,0.1); padding: 0.7rem 1.5rem;">Cari</button>
        </form>

        <!-- Tabel Pengaduan -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 10%; text-align: center;">Bukti</th>
                        <th style="width: 20%;">Pelanggan</th>
                        <th style="width: 15%;">Kategori</th>
                        <th style="width: 25%;">Ringkasan</th>
                        <th style="width: 10%; text-align: center;">Status</th>
                        <th style="width: 15%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengaduans as $i => $p)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td style="color: #94a3b8;">{{ $pengaduans->firstItem() + $i }}</td>
                            
                            <!-- Kolom Bukti Foto -->
                            <td style="text-align: center;">
                                @if($p->bukti_foto)
                                    <img src="{{ asset('storage/' . $p->bukti_foto) }}" alt="Bukti" style="width: 45px; height: 45px; border-radius: 8px; object-fit: cover; border: 1px solid #fbbf24; cursor: pointer;" onclick="window.open(this.src)">
                                @else
                                    <div style="width: 45px; height: 45px; border-radius: 8px; border: 1px dashed #475569; display: inline-flex; align-items: center; justify-content: center;">
                                        <svg width="20" height="20" fill="none" stroke="#64748b" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </td>

                            <!-- Kolom Pelanggan -->
                            <td>
                                <div style="font-weight: 500; color: #f8fafc;">{{ $p->nama_pelanggan }}</div>
                                <div style="font-size: 0.8rem; color: #94a3b8; display: flex; align-items: center; gap: 4px; margin-top: 4px;">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Meja {{ $p->no_meja }}
                                </div>
                            </td>

                            <!-- Kolom Kategori -->
                            <td>
                                <span class="badge" style="background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3);">
                                    {{ $p->kategori }}
                                </span>
                            </td>

                            <!-- Kolom Ringkasan -->
                            <td style="color: #cbd5e1;">{{ Str::limit($p->isi_pengaduan, 40) }}</td>

                            <!-- Kolom Status -->
                            <td style="text-align: center;">
                                @if($p->status === 'proses')
                                    <span class="badge" style="background: rgba(251, 191, 36, 0.1); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3);">Proses</span>
                                @else
                                    <span class="badge" style="background: rgba(34, 197, 94, 0.1); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3);">Direspon</span>
                                @endif
                            </td>

                            <!-- Kolom Aksi -->
                            <td>
                                <div style="display: flex; justify-content: center; gap: 8px;">
                                    <form method="POST" action="{{ route('pengaduan.destroy', $p) }}" onsubmit="return confirm('Hapus pengaduan ini?')">
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
                        <tr><td colspan="7" style="text-align: center; padding: 3rem; color: #94a3b8;">Belum ada pengaduan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div style="margin-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem;">
            {{ $pengaduans->links() }}
        </div>
    </div>
</x-app-layout>