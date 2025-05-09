{{-- resources/views/pengumuman/index.blade.php --}}
@extends('templates.dashboard')

@section('isi')
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 mt-2 p-0 d-flex">
                        <h4>Daftar Pengumuman</h4>
                    </div>
                    <div class="col-md-6 p-0 text-right">
                        <a href="{{ url('/pengumuman/tambah') }}" class="btn btn-primary ms-2">+ Tambah Pengumuman</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mytable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Pengumuman</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($announcements->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada pengumuman ditemukan.</td>
                                    </tr>
                                @else
                                    @foreach ($announcements as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->is_published == 1 ? 'Dipublikasikan' : 'Draft' }}</td>
                                            <td>{{ $item->creator->name }}</td>
                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                            <td>
                                                <ul class="action">
                                                    <li>
                                                        <a href="{{ url('/pengumuman/'.$item->id.'/edit') }}" aria-label="Edit pengumuman">
                                                            <i style="color:blue" class="fa fa-solid fa-edit"></i>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $announcements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
