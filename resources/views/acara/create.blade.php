@extends('templates.dashboard')

@section('isi')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Acara</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('acara/tambah-proses') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="judul">Judul Acara</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Upload Gambar Acara</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Acara</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control ckeditor"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="start_datetime">Tanggal Mulai</label>
                        <input type="datetime" name="start_datetime" id="start_datetime" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="start_timestamp">Jam Mulai</label>
                        <input type="time" name="start_timestamp" id="start_timestamp" class="form-control" placeholder="Timestamp Mulai" required>
                    </div>

                    <div class="form-group">
                        <label for="end_datetime">Tanggal Selesai</label>
                        <input type="datetime" name="end_datetime" id="end_datetime" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="end_timestamp">Jam Selesai</label>
                        <input type="time" name="end_timestamp" id="end_timestamp" class="form-control" placeholder="Timestamp Akhir" required>
                    </div>


                    <div class="form-group">
                        <label for="call_to_action">Call to Action</label>
                        <div id="cta-container">
                            <div class="row cta-item mb-2">
                                <div class="col-md-6">
                                    <input type="text" name="cta_title[]" class="form-control" placeholder="Judul Tombol" >
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="cta_link[]" class="form-control" placeholder="Link Tombol" >
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger mt-2 remove-cta" style="display: none;">Hapus</button>
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="add-cta">Tambah Call to Action Lain</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Buat Acara</button>
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
        ctaItem.className = 'row cta-item mb-2'; // Add row and margin class for Bootstrap

        // Create title input
        var titleInput = document.createElement('input');
        titleInput.type = 'text';
        titleInput.name = 'cta_title[]';
        titleInput.className = 'form-control'; // Use Bootstrap grid classes
        titleInput.placeholder = 'Judul Tombol';
        titleInput.required = true; // Make this field required

        // Create link input
        var linkInput = document.createElement('input');
        linkInput.type = 'text';
        linkInput.name = 'cta_link[]';
        linkInput.className = 'form-control'; // Use Bootstrap grid classes
        linkInput.placeholder = 'Link Tombol';
        linkInput.required = true; // Make this field required

        // Create wrapper divs for inputs to use col-md-6
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
        removeButton.className = 'btn btn-danger mt-2 mb-2 remove-cta'; // No col-md class
        removeButton.textContent = 'Hapus';

        // Append cta item to the container
        container.appendChild(ctaItem);
        // Append remove button below the cta item
        container.appendChild(removeButton);

        // Add click event to remove button
        removeButton.onclick = function() {
            container.removeChild(ctaItem); // Remove only this CTA item
            container.removeChild(removeButton); // Remove button itself
        };
    });
</script>


@endsection
