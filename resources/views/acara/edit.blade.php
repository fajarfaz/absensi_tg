@extends('templates.dashboard')

@section('isi')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Acara</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('acara/'.$acara->id.'/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul">Judul Acara</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ $acara->judul }}" required>
                    </div>

                    <div class="form-group">
                        <label for="gambar">Upload Gambar Acara</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                        @if ($acara->image)
                            <p>Gambar saat ini:</p>
                            <img src="{{ asset('storage/'.$acara->image) }}" alt="Gambar Acara" width="150">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Acara</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control ckeditor">{{ $acara->deskripsi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="start_datetime">Tanggal Mulai</label>
                        <input type="date" name="start_datetime" id="start_datetime" class="form-control" value="{{ \Carbon\Carbon::parse($acara->start_time)->format('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="start_timestamp">Jam Mulai</label>
                        <input type="time" name="start_timestamp" id="start_timestamp" class="form-control" value="{{ \Carbon\Carbon::parse($acara->start_time)->format('H:i') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_datetime">Tanggal Selesai</label>
                        <input type="date" name="end_datetime" id="end_datetime" class="form-control" value="{{ \Carbon\Carbon::parse($acara->end_time)->format('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_timestamp">Jam Selesai</label>
                        <input type="time" name="end_timestamp" id="end_timestamp" class="form-control" value="{{ \Carbon\Carbon::parse($acara->end_time)->format('H:i') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="call_to_action">Call to Action</label>
                        <div id="cta-container">
                            @foreach (json_decode($acara->call_to_actions, true) as $index => $cta)
                                <div class="row cta-item mb-2">
                                    <div class="col-md-6">
                                        <input type="text" name="cta_title[]" class="form-control" value="{{ $cta['title'] }}" placeholder="Judul Tombol" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="cta_link[]" class="form-control" value="{{ $cta['link'] }}" placeholder="Link Tombol" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger mt-2 mb-2 remove-cta">Hapus</button>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="add-cta">Tambah Call to Action Lain</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Acara</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-cta').addEventListener('click', function() {
        var container = document.getElementById('cta-container');

        // Create a new div for the CTA item
        var ctaItem = document.createElement('div');
        ctaItem.className = 'row cta-item mb-2';

        // Create title input
        var titleInput = document.createElement('input');
        titleInput.type = 'text';
        titleInput.name = 'cta_title[]';
        titleInput.className = 'form-control';
        titleInput.placeholder = 'Judul Tombol';
        titleInput.required = true;

        // Create link input
        var linkInput = document.createElement('input');
        linkInput.type = 'text';
        linkInput.name = 'cta_link[]';
        linkInput.className = 'form-control';
        linkInput.placeholder = 'Link Tombol';
        linkInput.required = true;

        // Create wrapper divs for inputs
        var titleWrapper = document.createElement('div');
        titleWrapper.className = 'col-md-6';
        titleWrapper.appendChild(titleInput);

        var linkWrapper = document.createElement('div');
        linkWrapper.className = 'col-md-6';
        linkWrapper.appendChild(linkInput);

        // Append inputs to the cta item
        ctaItem.appendChild(titleWrapper);
        ctaItem.appendChild(linkWrapper);

        // Create remove button
        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'btn btn-danger mt-2 mb-2 remove-cta';
        removeButton.textContent = 'Hapus';

        // Append cta item and remove button to container
        container.appendChild(ctaItem);
        container.appendChild(removeButton);

        // Add click event to remove button
        removeButton.onclick = function() {
            container.removeChild(ctaItem);
            container.removeChild(removeButton);
        };
    });

    // Add event listeners to all existing "remove" buttons for already loaded CTA items
    document.querySelectorAll('.remove-cta').forEach(function(removeButton) {
        removeButton.onclick = function() {
            // Find the corresponding CTA item and remove it
            var ctaItem = removeButton.previousElementSibling;
            ctaItem.remove();
            removeButton.remove();
        };
    });
</script>
@endsection
