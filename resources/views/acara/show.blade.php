{{-- resources/views/blog/show.blade.php --}}
@extends('templates.blogs')
@section('container')

  <!-- /preload -->
  <div class="header-style2" style="background-image: url('{{ asset('storage/'.$acara->image) }}');">
      <div class="tf-container">
          <a href="{{ url()->previous() }}" class="back-btn"> <i class="icon-left"></i></a>
      </div>
  </div>

  <div class="mb-8">
      <div class="app-section bg_white_color giftcard-detail-section-1">
          <div class="tf-container">
              <div class="voucher-info">
                  <h2 class="fw_6">{{ $acara->judul }}</h2>
              </div>
              <div class="mt-2">
                  <p class="mt-2 fw_4">Waktu acara : {{ \Carbon\Carbon::parse($acara->start_time)->format('d-m-Y H:i') }} s.d {{ \Carbon\Carbon::parse($acara->end_time)->format('d-m-Y H:i') }}</p>
              </div>
          </div>
      </div>
      <div class="app-section mt-1 bg_white_color giftcard-detail-section-2">
          <div class="tf-container">
              <div class="voucher-desc">
                  <h4 class="fw_6">Informasi</h4>
                  {!! $acara->deskripsi !!}
              </div>
          </div>
      </div>
      <!-- Call to Action Section -->
      <div class="app-section mt-1 bg_white_color giftcard-detail-section-3" style="margin-bottom: 100px">
        <div class="tf-container">
            <div class="cta-buttons">
                @php
                    $callToActions = json_decode($acara->call_to_actions);
                @endphp
                @if ($callToActions)
                    @foreach ($callToActions as $cta)
                    @php
                    // Ensure the link is a full URL
                        $link = (preg_match('/^https?:\/\//', $cta->link)) ? $cta->link : 'http://' . $cta->link;
                    @endphp
                    <div class="mb-4">
                        <a href="{{ $link }}" class="tf-btn accent large" target="_blank">{{ $cta->title }}</a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
  </div>

  <div class="bottom-navigation-bar bottom-btn-fixed">
      <div class="tf-container">
          <a href="{{ url()->previous() }}" class="tf-btn accent large">Kembali</a>
      </div>
  </div>


@endsection
