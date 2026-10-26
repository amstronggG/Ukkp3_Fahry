<?php
namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    private function cekAdmin()
    {
        if (auth()->user()->isAdmin()) {
            abort(403, 'Admin tidak diizinkan mengakses halaman pengaduan.');
        }
    }

    public function index(Request $request)
    {
        $this->cekAdmin();
        $search = $request->input('search');
        $query = Pengaduan::where('user_id', auth()->id())->latest();

        if ($search) {
            $query->where('nama_pelanggan', 'like', "%{$search}%")
                  ->orWhere('no_meja', 'like', "%{$search}%");
        }
        
        $pengaduans = $query->paginate(10)->withQueryString();
        return view('pengaduan.index', compact('pengaduans', 'search'));
    }

    public function create()
    {
        $this->cekAdmin();
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $this->cekAdmin();

        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telepon' => 'required|string',
            'no_meja' => 'required|string',
            'kategori' => 'required|string',
            'isi_pengaduan' => 'required|string',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'proses';

        if ($request->hasFile('bukti_foto')) {
            $validated['bukti_foto'] = $request->file('bukti_foto')->store('pengaduan', 'public');
        }

        Pengaduan::create($validated);
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $this->cekAdmin();
        if (auth()->id() !== $pengaduan->user_id) {
            abort(403, 'Anda tidak berhak menghapus pengaduan ini.');
        }

        if ($pengaduan->bukti_foto) {
            Storage::disk('public')->delete($pengaduan->bukti_foto);
        }
        
        $pengaduan->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
    }
}