<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Lesson Learned</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <h2>Laporan Kegiatan Lesson Learned</h2>
    <hr>
    <p><strong>Nama:</strong> {{ $data['nama'] }}</p>
    <p><strong>NPP:</strong> {{ $data['npp'] }}</p>
    <p><strong>Pangkat:</strong> {{ $data['pangkat'] }}</p>
    <p><strong>Jabatan:</strong> {{ $data['jabatan'] }}</p>
    <p><strong>Unit Kerja:</strong> {{ $data['unit_kerja'] }}</p>
    <p><strong>Satuan Kerja:</strong> {{ $data['satuan_kerja'] }}</p>
    <p><strong>Tanggal:</strong> {{ $data['tanggal'] }}</p>
    <p><strong>Jenis Pembelajaran:</strong> {{ $data['jenis_pembelajaran'] }}</p>
    <p><strong>Nama Pembelajaran:</strong> {{ $data['nama_pembelajaran'] }}</p>
    <p><strong>Jam Pembelajaran:</strong> {{ $data['jam_pembelajaran'] }}</p>
    <p><strong>Materi:</strong> {{ $data['materi'] }}</p>
    <p><strong>Narasumber:</strong> {{ $data['narasumber'] }}</p>
    <hr>
    <p><strong>Poin Pembelajaran (Lesson Learned):</strong></p>
    <p>{{ $data['lesson_learned'] }}</p>
</body>
</html>
