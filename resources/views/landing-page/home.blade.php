@extends('landing-page.layouts.master')

@section('title', 'NEMO Tours – Enjoy Every Moment')

@section('content')

{{-- ===========================
    HERO SECTION
============================ --}}
@include('landing-page.sections.hero-tours')

{{-- ===========================
    ADS AREA SECTION
============================ --}}
@include('landing-page.sections.ads-area')

{{-- ===========================
    TRIPS SECTION
============================ --}}
@include('landing-page.sections.trips')

@endsection
