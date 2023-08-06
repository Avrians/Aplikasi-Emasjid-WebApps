 @extends('layouts.laporan_admin')
 @section('js')
     <script>
         $(document).ready(function() {
             $("#cetak").click(function(e) {
                 var tanggalMulai = $("#tanggal_mulai").val();
                 var tanggalSelesai = $("#tanggal_selesai").val();
                 var q = $("#q").val();
                 params = "?page=laporan&tanggal_mulai=" + tanggalMulai + "&tanggal_selesai=" +
                     tanggalSelesai + "&q=" + q;
                 window.open("{{ route('kas.index') }}" + params, '_blank');
             });
         });
     </script>
 @endsection
 @section('content')
     <h1 class="h3 mb-3 text-center">{{ auth()->user()->masjid->nama }}</h1>
     <p class="mb-3 text-center">{{ auth()->user()->masjid->alamat }}</p>

     <div class="row m-3">
         <div class="col-md-12">
             <div class="table-responsive mt-3">
                <h5>Laporan Kas Masjid</h5>
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th width="1%">No.</th>
                             <th width="10%">Tanggal</th>
                             <th>Diinput Oleh</th>
                             <th>Keterangan</th>
                             <th class="text-end">Pemasukan</th>
                             <th class="text-end">Pengeluaran</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($kases as $key => $kas)
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{{ $kas->tanggal->translatedFormat('d-m-Y') }}</td>
                                 <td>{{ $kas->createdBy->name }}</td>
                                 <td>{{ $kas->keterangan }}</td>
                                 <td class="text-end">
                                     {{ $kas->jenis == 'masuk' ? formatRupiah($kas->jumlah, true) : '-' }}
                                 </td>
                                 <td class="text-end">
                                     {{ $kas->jenis == 'keluar' ? formatRupiah($kas->jumlah, true) : '-' }}
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                     <tfoot>
                         <tr>
                             <td colspan="4" class="text-center fw-bold">TOTAL</td>
                             <td class="text-end">{{ formatRupiah($totalPemasukan, true) }}</td>
                             <td class="text-end">{{ formatRupiah($totalPengeluaran, true) }}</td>
                         </tr>
                     </tfoot>
                 </table>
             </div>
         </div>
     </div>
 @endsection
