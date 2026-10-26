<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with('user')->latest()->paginate(10);
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function respon(Pengaduan $pengaduan)
    {
        // Paksa update status menjadi direspon
        $pengaduan->status = 'direspon';
        $pengaduan->save();

        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil direspon!');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->bukti_foto) {
            Storage::disk('public')->delete($pengaduan->bukti_foto);
        }
        $pengaduan->delete();
        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
    }
}