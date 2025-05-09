@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 mt-2 p-0 d-flex">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/pegawai') }}" class="btn btn-secondary btn-sm ms-2">Lihat Pegawai Aktif</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="alert alert-warning"><strong>Mohon perhatian!</strong> Hati-hati dalam melakukan penghapusan data karyawan karna akan menyebabkan Error atau bugs. Jika ingin menghapus, silahkan lakukan penghapusan data sementara.</div>
                    <form action="{{ url('/pegawai') }}">
                        <div class="row mb-2">
                            <div class="col-2">
                                <input type="text" placeholder="Search...." class="form-control" value="{{ request('search') }}" name="search">
                            </div>
                            <div class="col">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="mytable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Jabatan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_user as $du)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $du->name }}</td>
                                        <td>{{ $du->username }}</td>
                                        <td>{{ $du->Jabatan->nama_jabatan ?? '-' }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="delete">
                                                    <form action="{{ url('/pegawai/soft-delete/'.$du->id) }}" method="post">
                                                        @method('post') <!-- Gunakan method POST untuk update -->
                                                        @csrf
                                                        <button title="Aktifkan Pegawai" class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure?')">
                                                            <i class="fa fa-solid fa-check-circle" style="color: green;"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                                <li class="delete">
                                                    <form action="{{ url('/pegawai/delete/'.$du->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button title="Delete Pegawai Permanen" class="border-0" style="background-color: transparent;" onClick="return confirm('Apakah anda yakin menghapus data ini? penghapusan data permanen berpotensi menyebabkan error!')"><i class="icon-trash" style="color: black"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $data_user->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




