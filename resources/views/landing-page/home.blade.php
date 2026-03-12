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
    BANNER SECTION
============================ --}}
@include('landing-page.sections.banner')

{{-- ===========================
    HOW IT WORKS SECTION
============================ --}}
@include('landing-page.sections.how-it-works')

@endsection
