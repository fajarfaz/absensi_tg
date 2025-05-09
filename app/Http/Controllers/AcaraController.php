<?php


namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AcaraController extends Controller
{
    public function index(Request $request)
    {
        $title = "Daftar Acara";

        // Ambil query pencarian dari input
        $search = $request->input('search');

        // Ambil data acara dengan pencarian dan urutkan berdasarkan tanggal terbaru
        $acaras = Acara::when($search, function ($query, $search) {
                return $query->where('judul', 'LIKE', "%{$search}%");
            })
            ->orderBy('start_time', 'desc') // Mengurutkan berdasarkan tanggal terbaru
            ->paginate(10); // Mengatur pagination, misal 10 data per halaman

        return view('acara.index', compact('acaras', 'title'));
    }

    public function create()
    {
        $title = "Tambah Acara";

        return view('acara.create', compact('title'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'start_datetime' => 'required|date',
            'start_timestamp' => 'required|date_format:H:i',
            'end_datetime' => 'required|date',
            'end_timestamp' => 'required|date_format:H:i',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $startDateTime = $request->start_datetime . ' ' . $request->start_timestamp;
        $endDateTime = $request->end_datetime . ' ' . $request->end_timestamp;
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $startDateTime);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $endDateTime);

        // Menyimpan Call to Action sebagai array
        $callToActions = [];
        if($request->cta_title !== [] && $request->cta_link !== []) {
            foreach ($request->cta_title as $index => $title) {
                $callToActions[] = [
                    'title' => $title,
                    'link' => $request->cta_link[$index],
                ];
            }
        } else {
            $callToActions [] = [];
        }

        if ($request->hasFile('gambar')) {
           $bannerPath = $request->file('gambar')->store('acara', 'public');
        }

        // Buat data acara baru dengan CTA
        Acara::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'start_time' => $startDateTime, // Simpan waktu mulai
            'end_time' => $endDateTime, // Simpan waktu selesai
            'slug' => Str::slug($request->judul), // Menghasilkan slug berdasarkan judul
            'call_to_actions' => json_encode($callToActions), // Mengonversi ke JSON
            'image' => $bannerPath,
        ]);

        return redirect('/acara')->with('success', 'Acara berhasil dibuat.');
    }


    public function edit($id)
    {
        $acara = Acara::findOrFail($id);
        $title = $acara->judul;

        // Kirim data acara ke view 'acara.edit'
        return view('acara.edit', compact('acara','title'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'start_datetime' => 'required|date',
            'start_timestamp' => 'required|date_format:H:i',
            'end_datetime' => 'required|date',
            'end_timestamp' => 'required|date_format:H:i',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari acara berdasarkan ID
        $acara = Acara::findOrFail($id);

        // Menggabungkan tanggal dan jam
        $startDateTime = $request->start_datetime . ' ' . $request->start_timestamp;
        $endDateTime = $request->end_datetime . ' ' . $request->end_timestamp;

        // Konversi ke format datetime menggunakan Carbon
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $startDateTime);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $endDateTime);

        // Simpan Call to Action (CTA) sebagai JSON
        $callToActions = [];
        if ($request->cta_title && $request->cta_link) {
            foreach ($request->cta_title as $index => $title) {
                $callToActions[] = [
                    'title' => $title,
                    'link' => $request->cta_link[$index],
                ];
            }
        }

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($acara->image) {
                Storage::delete('public/' . $acara->image);
            }
            // Upload gambar baru
            $bannerPath = $request->file('gambar')->store('acara', 'public');
            $acara->image = $bannerPath;
        }

        // Update data acara
        $acara->judul = $request->judul;
        $acara->slug = Str::slug($request->judul);
        $acara->deskripsi = $request->deskripsi;
        $acara->start_time = $startDateTime;
        $acara->end_time = $endDateTime;
        $acara->call_to_actions = json_encode($callToActions);

        $acara->save();

        return redirect()->back()->with('success', 'Acara berhasil diupdate!');
    }


    public function destroy($id)
    {
        $acara = Acara::destroy($id);
        return redirect('/acara')->with('success', 'Acara berhasil dihapus.');
    }
    public function show($slug)
    {
        $acara = Acara::where('slug', $slug)->firstOrFail();
        $title = $acara->title;

        return view('acara.show', compact('acara','title'));
    }
    public function listuser(Request $request)
    {
        $title = 'All Events';

        $search = $request->input('search');

        // Ambil data acara dengan pencarian dan urutkan berdasarkan tanggal terbaru
        $acara = Acara::when($search, function ($query, $search) {
                return $query->where('judul', 'LIKE', "%{$search}%");
            })
            ->orderBy('start_time', 'desc') // Mengurutkan berdasarkan tanggal terbaru
            ->paginate(10); // Mengatur pagination, misal 10 data per halaman


        return view('acara.list', compact('acara','title'));
    }
}
