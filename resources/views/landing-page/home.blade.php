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
    FEATURED TOURS SECTION
============================ --}}
@include('landing-page.sections.featured-tours')

{{-- ===========================
    SAFARI SPECIALS SECTION
============================ --}}
@include('landing-page.sections.safari-specials')

{{-- ===========================
    HOW IT WORKS SECTION
============================ --}}
@include('landing-page.sections.how-it-works')

{{-- ===========================
    BANNER SECTION
============================ --}}
@include('landing-page.sections.banner')

@endsection
