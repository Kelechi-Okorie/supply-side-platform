@extends('layouts.master')


@section('contents')

<h4 class="h4">Advertising Campaigns</h4>
<div class="d-flex justify-content-end">
    <a href={{ route('new-campaign')}} class="btn btn-primary btn-sm ml-auto d-inline-block px-4">New</a>
</div>

<div id="app">
  <list-component></list-component>
</div>

@stop
