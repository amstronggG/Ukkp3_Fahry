<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <!-- Ikon Clipboard (SVG) -->
                <div style="background: rgba(251, 191, 36, 0.1); padding: 10px; border-radius: 12px; border: 1px solid rgba(251, 191, 36, 0.2);">
                    <svg width="28" height="28" fill="none" stroke="#fbbf24" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <h2 style="margin: 0; font-size: 1.5rem; color: #f8fafc;">Kelola Pengaduan</h2>
                    <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: #94a3b8;">Daftar laporan pengaduan dari pengguna</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="glass-card">
        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.1); border-left: 4px solid #4ade80; color: #4ade80; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Pengaduan -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 10%;">Bukti</th>
                        <th style="width: 20%;">Pelapor</th>
                        <th style="width: 25%;">Kategori & Aduan</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 25%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengaduans as $i => $p)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td style="color: #94a3b8;">{{ $pengaduans->firstItem() + $i }}</td>
                            
                            <!-- Kolom Bukti Foto -->
                            <td>
                                @if($p->bukti_foto)
                                    <img src="{{ asset('storage/' . $p->bukti_foto) }}" alt="Bukti" style="width: 45px; height: 45px; border-radius: 8px; object-fit: cover; border: 1px solid #fbbf24; cursor: pointer;" onclick="window.open(this.src)">
                                @else
                                    <div style="width: 45px; height: 45px; border-radius: 8px; border: 1px dashed #475569; display: flex; align-items: center; justify-content: center;">
                                        <svg width="20" height="20" fill="none" stroke="#64748b" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </td>

                            <!-- Kolom Pelapor -->
                            <td>
                                <div style="font-weight: 500; color: #f8fafc;">{{ $p->nama_pelanggan }}</div>
                                <div style="font-size: 0.8rem; color: #94a3b8; display: flex; align-items: center; gap: 4px; margin-top: 4px;">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Meja {{ $p->no_meja }}
                                </div>
                            </td>

                            <!-- Kolom Kategori & Aduan -->
                            <td>
                                <div style="font-weight: 500; color: #f8fafc;">{{ $p->kategori }}</div>
                                <div style="font-size: 0.8rem; color: #cbd5e1; margin-top: 2px;">{{ Str::limit($p->isi_pengaduan, 40) }}</div>
                            </td>

                            <!-- Kolom Status -->
                            <td>
                                @if($p->status === 'proses')
                                    <span class="badge" style="background: rgba(251, 191, 36, 0.1); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3);">Proses</span>
                                @else
                                    <span class="badge" style="background: rgba(34, 197, 94, 0.1); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3);">Direspon</span>
                                @endif
                            </td>

                            <!-- Kolom Aksi -->
                            <td>
                                <div style="display: flex; justify-content: center; gap: 8px;">
                                    @if($p->status === 'proses')
                                        <form method="POST" action="{{ route('admin.pengaduan.respon', $p) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn" style="background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3); padding: 0.4rem 1rem;">
                                                Beri Respon
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.pengaduan.destroy', $p) }}" onsubmit="return confirm('Hapus permanen?')">
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
                        <tr><td colspan="6" style="text-align: center; padding: 3rem; color: #94a3b8;">Belum ada pengaduan.</td></tr>
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