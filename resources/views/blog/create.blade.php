@extends('templates.dashboard')

@section('isi')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Berita atau Artikel</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('blog/tambah-proses') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control ckeditor"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="call_to_action">Call to Action</label>
                        <div id="cta-container">
                            <div class="row cta-item mb-2">
                                <div class="col-md-6">
                                    <input type="text" name="cta_title[]" class="form-control" placeholder="Button Title" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="cta_link[]" class="form-control" placeholder="Button Link" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="add-cta">Add Another Call to Action</button>
                    </div>

                    <div class="form-group">
                        <label for="banner_image">Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="is_published">Published</label>
                        <input type="checkbox" name="is_published" id="is_published">
                    </div>

                    <button type="submit" class="btn btn-primary">Create Blog</button>
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
        titleInput.placeholder = 'Button Title';
        titleInput.required = true; // Make this field required

        // Create link input
        var linkInput = document.createElement('input');
        linkInput.type = 'text';
        linkInput.name = 'cta_link[]';
        linkInput.className = 'form-control'; // Use Bootstrap grid classes
        linkInput.placeholder = 'Button Link';
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

        // Append cta item to the container
        container.appendChild(ctaItem);

        // Create remove button
        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'btn btn-danger mt-2 remove-cta'; // No col-md class
        removeButton.textContent = 'Remove';

        // Append the remove button below the last cta item
        container.appendChild(removeButton);
    });

    // Event delegation to handle click events for dynamically added remove buttons
    document.getElementById('cta-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-cta')) {
            e.target.previousElementSibling.remove(); // Remove the previous CTA item
            e.target.remove(); // Remove the button itself
        }
    });
</script>

@endsection
