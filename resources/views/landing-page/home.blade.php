@extends('landing-page.layouts.master')

@section('title', 'NEMO Tours – Enjoy Every Moment')

@section('content')

{{-- ===========================
    HERO SECTION
============================ --}}
@include('landing-page.sections.hero-tours')

{{-- ===========================
    CLIENTS CAROUSEL SECTION
============================ --}}
@include('landing-page.sections.clients-carousel')


{{-- ===========================
    FEATURED TOURS SECTION
============================ --}}
@include('landing-page.sections.featured-tours')
    
{{-- ===========================
    SAFARI SPECIALS SECTION
============================ --}}
@include('landing-page.sections.safari-specials')
        
{{-- ===========================
    HOTELS SECTION
============================ --}}
@include('landing-page.sections.hotels')

{{-- ===========================
    CATEGORIES SECTION
============================ --}}
@include('landing-page.sections.categories')

{{-- ===========================
    BANNER SECTION
============================ --}}
@include('landing-page.sections.banner')

{{-- ===========================
    HOW IT WORKS SECTION
============================ --}}
@include('landing-page.sections.how-it-works')

@endsection
