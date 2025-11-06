<!-- resources/views/pdf/laporan.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Zoom</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <h2>Laporan Kegiatan Zoom</h2>
    <hr>
    <p><strong>Nama:</strong> {{ $data['nama'] }}</p>
    <p><strong>NIP/NIK:</strong> {{ $data['nip'] }}</p>
    <p><strong>Jabatan:</strong> {{ $data['jabatan'] }}</p>
    <p><strong>Unit Kerja:</strong> {{ $data['unitKerja'] }}</p>
    <p><strong>Tanggal:</strong> {{ $data['tanggal'] }}</p>
    <p><strong>Judul:</strong> {{ $data['judul'] }}</p>
    <p><strong>Narasumber:</strong> {{ $data['narasumber'] }}</p>
    <hr>
    <p><strong>Ringkasan:</strong> {{ $data['ringkasan'] }}</p>
    <p><strong>Catatan:</strong> {{ $data['catatan'] }}</p>
    <p><strong>Saran:</strong> {{ $data['saran'] }}</p>
</body>
</html>
