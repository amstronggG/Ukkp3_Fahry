<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2>Buat Pengaduan</h2>
                <p style="margin: 0; font-size: 0.9rem; color: #94a3b8;">Sampaikan keluhan Anda untuk pelayanan yang lebih baik.</p>
            </div>
            <a href="{{ route('pengaduan.index') }}" class="btn" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);">&larr; Kembali</a>
        </div>
    </x-slot>

    <div class="glass-card">
        <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Baris 1: Nama & Email -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label-icon">Nama Lengkap</label>
                    <div class="input-group">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <input type="text" name="nama_pelanggan" required class="form-control" placeholder="Masukkan nama Anda">
                    </div>
                </div>
                <div>
                    <label class="form-label-icon">Alamat Email</label>
                    <div class="input-group">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <input type="email" name="email" required class="form-control" placeholder="contoh@email.com">
                    </div>
                </div>
            </div>

            <!-- Baris 2: No Telp & No Meja -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label-icon">No Telepon</label>
                    <div class="input-group">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <input type="text" name="no_telepon" required class="form-control" placeholder="08xxxxxxxxxx">
                    </div>
                </div>
                <div>
                    <label class="form-label-icon">Nomor Meja</label>
                    <div class="input-group">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <select name="no_meja" required class="form-control is-select">
                            <option value="">-- Pilih Nomor Meja --</option>
                            <option value="1">Meja 1</option>
                            <option value="2">Meja 2</option>
                            <option value="3">Meja 3</option>
                            <!-- Tambahkan opsi meja lain sesuai kebutuhan -->
                        </select>
                    </div>
                </div>
            </div>

            <!-- Baris 3: Kategori -->
            <div style="margin-bottom: 1.5rem;">
                <label class="form-label-icon">Kategori Masalah</label>
                <div class="input-group">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    <select name="kategori" required class="form-control is-select">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Makanan & Minuman">Makanan & Minuman</option>
                        <option value="Keamanan & Kenyamanan">Keamanan & Kenyamanan</option>
                        <option value="Pelayanan">Pelayanan</option>
                        <option value="Fasilitas">Fasilitas</option>
                    </select>
                </div>
            </div>

            <!-- Baris 4: Isi Pengaduan -->
            <div style="margin-bottom: 1.5rem;">
                <label class="form-label-icon">Isi Pengaduan</label>
                <div class="input-group">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="top: 1.5rem; transform: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    <textarea name="isi_pengaduan" required class="form-control" rows="5" placeholder="Jelaskan detail keluhan Anda di sini..." style="padding-left: 1rem; resize: vertical;"></textarea>
                </div>
            </div>

            <!-- Baris 5: Upload Bukti -->
            <div style="margin-bottom: 2rem;">
                <label class="form-label-icon">Upload Bukti (Foto)</label>
                <div style="background: rgba(15, 23, 42, 0.6); border: 1px dashed #475569; border-radius: 10px; padding: 1.5rem; text-align: center;">
                    <input type="file" name="bukti_foto" accept="image/*" style="color: #cbd5e1; width: 100%;">
                    <p style="font-size: 0.8rem; color: #64748b; margin-top: 0.5rem; margin-bottom: 0;">Format: JPG, JPEG, PNG. Ukuran maksimal 10MB.</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('pengaduan.index') }}" class="btn" style="background: rgba(255,255,255,0.1); color: white; padding: 0.8rem 2rem;">Batal</a>
                <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem;">Kirim Pengaduan</button>
            </div>
        </form>
    </div>
</x-app-layout>
