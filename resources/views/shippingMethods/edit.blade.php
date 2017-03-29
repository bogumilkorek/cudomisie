@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>{{ __('Edit shipping method') }}</h1>
      <hr>

      @component('alert', ['errors' => $errors])
      @endcomponent

      <form method="POST" action="{{ route('shippingMethods.update', $shipping_method) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('shippingMethods.form')

        <input type="hidden" name="id" value="{{ $shipping_method->id }}" />

        <button type="submit" class="btn btn-primary"
          data-loading-text="<i class='fa fa-cog fa-spin'></i> {{ __('Loading') }}">
          {{ __('Save') }}
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
      </form>

    @include('layouts.partials.admin.wysiwyg')

    @endsection
