@extends('site.layout.master')

@section('title', 'Igreja Batista Nova Vida')

@section('content')
    @include('site.layout.partials.about')

    @include('site.layout.partials.speakers')

    @include('site.layout.partials.schedule')

    @include('site.layout.partials.venue')

{{--    @include('site.layout.partials.hotels')--}}

    @include('site.layout.partials.gallery')

{{--    @include('site.layout.partials.sponsors')--}}

{{--    @include('site.layout.partials.faq')--}}

{{--    @include('site.layout.partials.subscribe')--}}

{{--    @include('site.layout.partials.buy-ticket')--}}

    @include('site.layout.partials.contact')
@endsection
