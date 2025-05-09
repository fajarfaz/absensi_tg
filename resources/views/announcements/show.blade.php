@extends('templates.blogs')
@section('container')

  <!-- /preload -->
  <div class="header-style2" style="background-image: url('{{ asset('storage/'.$announcement->banner) }}');">
      <div class="tf-container">
          <a href="{{ url()->previous() }}" class="back-btn"> <i class="icon-left"></i></a>
      </div>
  </div>
  <div class="mb-8">
      <div class="app-section bg_white_color giftcard-detail-section-1">
      <div class="tf-container">
          <div class="voucher-info">
            <h2 class="fw_6">{{ $announcement->title }}</h2>
          </div>
          <div class="mt-2">
            <p class="mt-2 fw_4">Diumumkan pada {{ $announcement->created_at->format('d/m/Y') }}</p>
          </div>
      </div>

      </div>
      <div class="app-section mt-1 bg_white_color giftcard-detail-section-2">
      <div class="tf-container">
          <div class="voucher-desc">
            <h4 class="fw_6">Informasi</h4>
            {!! $announcement->content !!}
          </div>
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
