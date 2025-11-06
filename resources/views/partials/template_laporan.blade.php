<!-- resources/views/partials/template_laporan.blade.php -->

<div class="space-y-4">
    <h2 class="text-xl font-bold text-gray-800 mb-2">Preview Laporan Kegiatan</h2>
    <hr class="border-gray-300 mb-4">

    <p><strong>Nama:</strong> {{ $data['nama'] }}</p>
    <p><strong>NIP/NIK:</strong> {{ $data['nip'] }}</p>
    <p><strong>Jabatan:</strong> {{ $data['jabatan'] }}</p>
    <p><strong>Unit Kerja:</strong> {{ $data['unitKerja'] }}</p>
    <p><strong>Tanggal:</strong> {{ $data['tanggal'] }}</p>
    <p><strong>Judul:</strong> {{ $data['judul'] }}</p>
    <p><strong>Narasumber:</strong> {{ $data['narasumber'] }}</p>
    <hr class="border-gray-300 my-4">
    <p><strong>Ringkasan:</strong> {{ $data['ringkasan'] }}</p>
    <p><strong>Catatan:</strong> {{ $data['catatan'] }}</p>
    <p><strong>Saran:</strong> {{ $data['saran'] }}</p>
</div>
