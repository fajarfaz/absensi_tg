@extends('templates.dashboard')

@section('isi')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Pengumuman</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/pengumuman/tambah-proses') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul Pengumuman</label>
                        <input type="text" name="title" class="form-control" id="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="konten">Konten Pengumuman</label>
                        <textarea name="content" class="form-control" id="konten" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="banner">Gambar Banner</label>
                        <input type="file" name="banner" class="form-control" id="banner" accept="image/*">
                    </div>
                    <!-- Checkbox for "Ditujukan untuk Semua" -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="is_for_all" id="is_for_all" value="1" onchange="toggleTargetUsers()">
                        <label class="form-check-label" for="is_for_all">Ditujukan untuk Semua</label>
                    </div>

                    <!-- Target Users Section -->
                    <div class="form-group" id="target_users_section">
                        <label>Tujukan Kepada</label><br>
                        @foreach ($jabatans as $jabatan)
                            <div class="form-check">
                                <input type="checkbox" name="target_users[]" value="{{ $jabatan->id }}" class="form-check-input" id="jabatan_{{ $jabatan->id }}">
                                <label class="form-check-label" for="jabatan_{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</label>
                            </div>
                        @endforeach
                        <small class="form-text text-muted">Pilih satu atau lebih jabatan.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Pengumuman</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleTargetUsers() {
        const isForAll = document.getElementById('is_for_all').checked;
        const targetUsersSection = document.getElementById('target_users_section');

        if (isForAll) {
            targetUsersSection.style.display = 'none';
        } else {
            targetUsersSection.style.display = 'block';
        }
    }
</script>
@endsection
