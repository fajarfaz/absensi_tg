{{-- resources/views/acara/index.blade.php --}}
@extends('templates.dashboard')

@section('isi')
<div class="row">
    <div class="col-md-12">
        <h1>Daftar Acara</h1>

        <!-- Search Form -->
        <form action="{{ url('/acara') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <a href="{{ url('/acara/tambah') }}" class="btn btn-primary mb-3">Tambah Acara Baru</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Acara</th>
                                    <th>Tanggal Acara</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($acaras as $acara)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ url('/acara/'.$acara->slug) }}">{{ $acara->judul }}</a></td>
                                    <td>{{ \Carbon\Carbon::parse($acara->start_time)->format('d-m-Y H:i') }} s.d {{ \Carbon\Carbon::parse($acara->end_time)->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <ul class="action">
                                            <li>
                                                <a href="{{ url('/acara/'.$acara->id.'/edit') }}" aria-label="Edit Acara">
                                                    <i class="fa fa-solid fa-edit" style="color:blue"></i>
                                                </a>
                                            </li>
                                            <li class="delete">
                                                <form action="{{ url('/acara/'.$acara->id.'/delete') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button title="Hapus Acara" class="border-0" style="background-color: transparent;" onClick="return confirm('Apakah Anda yakin?')">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada acara tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $acaras->links() }} <!-- Pagination links, if applicable -->
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
@endsection
