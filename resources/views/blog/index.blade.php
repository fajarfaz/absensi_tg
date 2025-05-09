{{-- resources/views/blog/index.blade.php --}}
@extends('templates.dashboard')

@section('isi')
<div class="row">
    <div class="col-md-12">
        <h1>Blog & News</h1>

        <!-- Search Form -->
        <form action="{{ url('/blog') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <a href="{{ url('/blog/tambah') }}" class="btn btn-primary mb-3">Tambah Berita/Artikel Baru</a>

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
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Published</th>
                                    <th>Banner</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($blogs as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ url('/blog/'.$blog->slug) }}">{{ $blog->title }}</a></td>
                                    <td>{{ $blog->slug }}</td>
                                    <td>{{ $blog->is_published ? 'Yes' : 'No' }}</td>
                                    <td>
                                        @if($blog->banner_image)
                                            <img src="{{ asset('storage/' . $blog->banner_image) }}" class="img-fluid" width="100" alt="Banner">
                                        @else
                                            No Banner
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="action">
                                            <li>
                                                <a href="{{ url('/blog/'.$blog->id.'/edit') }}" aria-label="Edit Blog">
                                                    <i class="fa fa-solid fa-edit" style="color:blue"></i>
                                                </a>
                                            </li>
                                            <li class="delete">
                                                <form action="{{ url('/blog/'.$blog->id.'/delete') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button title="Delete Blog" class="border-0" style="background-color: transparent;" onClick="return confirm('Are you sure?')">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No blogs available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $blogs->links() }} <!-- Pagination links, if applicable -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
