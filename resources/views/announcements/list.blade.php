{{-- resources/views/pengumuman/index.blade.php --}}
@extends('templates.blogs')

@section('container')

      <!-- preloade -->
      <div class="preload preload-container">
        <div class="preload-logo">
          <div class="spinner"></div>
        </div>
      </div>
    <!-- /preload -->
    <div class="header is-fixed">
        <div class="tf-container">
            <div class="tf-statusbar d-flex justify-content-center align-items-center">
                <a href="{{ url()->previous() }}" class="back-btn"> <i class="icon-left"></i> </a>
                <h3>{{ $title}}</h3>
            </div>
        </div>
    </div>
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <div class="tf-tab">
                <div class="content-tab mt-2">
                    @if ($filtered_announcements->isNotEmpty())
                        <div class="tab-gift-item">
                            <!-- Loop through each announcement -->
                            @foreach ($filtered_announcements as $announcement)
                            <div class="food-box">
                                <a href="{{ url('/pengumuman/show/'.$announcement->id) }}">
                                    <div class="img-box">
                                        <!-- Display the announcement image if available, else use a placeholder -->
                                        <img src="{{ asset('storage/' . $announcement->banner) }}" alt="Announcement Banner">

                                    </div>
                                    <div class="content">
                                        <!-- Link to the detailed view of the announcement -->
                                        <h4>
                                            {{ $announcement->title }}
                                        </h4>
                                        <!-- You can add more fields from the announcement like date, created_by, etc. -->
                                        <span>{{ $announcement->created_at->format('d M Y') }}</span>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Show a message if no announcements are found -->
                        <p>No announcements available for you.</p>
                    @endif

                </div>
            </div>


        </div>
    </div>

@endsection
