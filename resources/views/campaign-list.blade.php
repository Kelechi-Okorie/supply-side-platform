@extends('layouts.master')


@section('contents')

<h4 class="h4">Advertising Campaigns</h4>
<div class="d-flex">
    <a href={{ url('/edit')}} class="btn btn-primary ml-auto d-inline-block px-4">New</a>
</div>

<p class>this is the list of all the advertising campaigns</p>

@stop