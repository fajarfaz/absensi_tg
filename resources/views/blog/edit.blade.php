@extends('templates.dashboard')

@section('isi')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Berita atau Artikel</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/blog/'.$blog->id.'/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control ckeditor">{{ $blog->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="call_to_action">Call to Action</label>
                        <div id="cta-container">
                            @php
                                $callToActions = json_decode($blog->call_to_action);
                            @endphp
                            @if ($callToActions)
                                @foreach ($callToActions as $cta)
                                    <div class="row cta-item mb-2">
                                        <div class="col-md-6">
                                            <input type="text" name="cta_title[]" class="form-control" value="{{ $cta->title }}" placeholder="Button Title" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="cta_link[]" class="form-control" value="{{ $cta->link }}" placeholder="Button Link" required>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <button type="button" class="btn btn-danger remove-cta">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            <div class="row cta-item mb-2">
                                <div class="col-md-6">
                                    <input type="text" name="cta_title[]" class="form-control" placeholder="Button Title" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="cta_link[]" class="form-control" placeholder="Button Link" required>
                                </div>
                            </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="add-cta">Add Another Call to Action</button>
                    </div>

                    <div class="form-group">
                        <label for="banner_image">Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">
                        @if($blog->banner_image)
                            <img src="{{ asset('storage/' . $blog->banner_image) }}" class="img-fluid mt-2" width="300">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="is_published">Published</label>
                        <input type="checkbox" name="is_published" id="is_published" {{ $blog->is_published ? 'checked' : '' }}>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Blog</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Add event listener for the "Add Another Call to Action" button
    document.getElementById('add-cta').addEventListener('click', function() {
        var ctaContainer = document.getElementById('cta-container');

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

        // Create remove button
        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'btn btn-danger mt-2 remove-cta'; // No col-md class
        removeButton.textContent = 'Remove';

        // Append remove button
        var buttonWrapper = document.createElement('div');
        buttonWrapper.className = 'col-md-12 mt-2';
        buttonWrapper.appendChild(removeButton);
        ctaItem.appendChild(buttonWrapper);

        // Append cta item to the container
        ctaContainer.appendChild(ctaItem);
    });

    // Event delegation to handle click events for dynamically added remove buttons
    document.getElementById('cta-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-cta')) {
            // Remove the entire row for the CTA item
            e.target.closest('.cta-item').remove();
        }
    });
</script>

@endsection
