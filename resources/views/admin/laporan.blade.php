
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Daftar Laporan Lesson Learned</h3>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Materi</th>
                <th>Satuan Kerja</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $r)
            <tr>
                <td>{{ $r->tanggal }}</td>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->materi }}</td>
                <td>{{ $r->satuan_kerja }}</td>
                <td>
                    <a href="{{ asset($r->pdf_path) }}" class="btn btn-sm btn-info">Lihat</a>
                    <form action="{{ route('admin.delete', $r->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
