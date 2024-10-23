@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('page') 404 Not Found @endsection

<script>
    location.replace("/")
</script>