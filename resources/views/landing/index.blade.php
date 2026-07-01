@extends('layouts.landing')

@section('title', 'AzagiPrint — Cetak Tali Lanyard Custom Jakarta | Desa Percetakan Online')

@section('meta_description', 'AzagiPrint — Cetak Tali Lanyard custom Jakarta. MOQ 40 pcs, cetak 2 sisi Full Colour, gratis desain, sudah termasuk kait + stopper. Desa Percetakan Online No.1.')

@section('content')
  {{-- Hero Section --}}
  @include('landing.hero')

  {{-- Keunggulan Layanan --}}
  @include('landing.keunggulan')

  {{-- Galeri Contoh Produk --}}
  @include('landing.galeri')

  {{-- Kalkulator Harga --}}
  @include('landing.kalkulator')

  {{-- FAQ --}}
  @include('landing.faq')

  {{-- Footer --}}
  @include('landing.footer')
@endsection
