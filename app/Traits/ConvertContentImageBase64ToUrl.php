<?php

namespace App\Traits;

use Storage;

trait ConvertContentImageBase64ToUrl
{

  protected function convertContentImageBase64ToUrl($content)
  {
    // Mencocokan semua gambar yang terdapat dalam konten menggunakan regular
    $pattern = '/<img.*?src="(data:image\/.*?;base64,.*?)".*?>/i';
    preg_match_all($pattern, $content, $matches);

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
      $content = str_replace($gambar, $namaFile, $content);
    }
    return $content;
  }

  public function setAttribute($key, $value)
  {
    if ($key === $this->contentName) {
      $value = $this->convertContentImageBase64ToUrl($value);
    }

    return parent::setAttribute($key, $value); 
  }
}
