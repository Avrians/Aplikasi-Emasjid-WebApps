<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Models\Profil;
use Illuminate\Http\Request;
use Storage;
use Str;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = Profil::UserMasjid()->latest()->paginate(50);
        return view('profil.index', compact('profil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['profil'] = new Profil();
        $data['route'] = 'profil.store';
        $data['method'] = 'POST';
        $data['listKategori'] = [
            'visi-misi' => 'Misi Visi',
            'sejarah' => 'Sejarah',
            'struktur-organisasi' => 'Struktur Organisasi'
        ];
        return view('profil.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $konten = $validateData['konten']; // mendapatkan nilai konten dari permintaan

        // Mencocokan semua gambar yang terdapat dalam konten menggunakan regular
        $pattern = '/<img.*?src="(data:image\/.*?;base64,.*?)".*?>/i';
        preg_match_all($pattern, $konten, $matches);

        // Mendapatkan semua gambar yang cocok
        $gambarBase64 = $matches[1];
        $masjidId = auth()->user()->masjid_id;

        foreach ($gambarBase64 as $gambar) {
            $data = explode(',', $gambar);
            $gambarData = $data[1]; // mendapatkan data gambar base64

            // mendapatkan ekstensi file 
            $finfo = finfo_open();
            $ext = finfo_buffer($finfo, base64_decode($gambarData), FILEINFO_MIME_TYPE);
            finfo_close($finfo);
            $ext = explode('/', $ext)[1];

            // membuat nama file unik untuk gambar
            $namaFile = "profil/$masjidId/" . uniqid() . '.' . $ext; // Ubah ekstensi file sesuai format gambar

            // Mengubah data gambar base64 menjadi file dan menyimpannya menggunakan storage
            Storage::disk('public')->put($namaFile, base64_decode($gambarData));

            // Medapatkan URL gambar 
            $namaFile = "/storage/$namaFile";

            // Mengganti data gambar base64 degan url gambar
            $konten = str_replace($gambar, $namaFile, $konten);
        }
        // Mengganti nilai konten dengan konten yang telah diubah
        $validateData['konten'] = $konten;

        $validateData['created_by'] =  auth()->user()->id;
        $validateData['masjid_id'] =  auth()->user()->masjid_id;
        $validateData['slug'] =  Str::slug($request->judul);
        Profil::create($validateData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil $profil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfilRequest $request, Profil $profil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {
        //
    }
}
