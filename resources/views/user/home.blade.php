@extends('layouts.app')

@section('title', 'Home - Revola Clinic')

@section('meta')
<meta name="description" content="Revola Clinic offers expert dermatology services including skin treatments, hair care, and cosmetic solutions. Book your appointment today for personalized care." />
<meta name="keywords" content="Dermatology Services, Skin Treatments, Hair Care, Cosmetic Solutions, Book Appointment, Revola Clinic" />
@endsection

@section('content')
<div class="text-center mt-16">
    <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
</div>
@endsection