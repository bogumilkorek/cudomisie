@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>{{ __('Edit page') }}</h1>
      <hr>

      @component('alert', ['errors' => $errors])
      @endcomponent

      <form method="POST" action="{{ route('pages.update', $page) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('pages.form')

        <input type="hidden" name="id" value="{{ $page->id }}" />

        <button type="submit" class="btn btn-primary"
          data-loading-text="<i class='fa fa-cog fa-spin'></i> {{ __('Loading') }}">
          {{ __('Save') }}
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
      </form>

    @include('layouts.partials.admin.wysiwyg')

    @endsection
