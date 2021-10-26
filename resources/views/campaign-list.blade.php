@extends('layouts.master')


@section('contents')

<h4 class="h4">Advertising Campaigns</h4>
<div class="d-flex justify-content-end">
    <a href={{ url('/edit')}} class="btn btn-primary ml-auto d-inline-block px-4">New</a>
</div>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Start date</th>
        <th scope="col">End date</th>
        <th scope="col">Total Budget</th>
        <th scope="col">Daily Budget</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @php $i=0 @endphp
        @foreach($advertising_campaigns as $advertising_campaign)
            <tr>
                <td scope="row">@php echo ++$i @endphp</td>
                <td>{{$advertising_campaign->name}}</td>
                <td>{{$advertising_campaign->date_from}}</td>
                <td>{{$advertising_campaign->date_to}}</td>
                <td>{{$advertising_campaign->total_budget}}</td>
                <td>{{$advertising_campaign->daily_budget}}</td>
                <td><a class="btn btn-primary mr-1" href="{{ route('view-campaign', $advertising_campaign->id)}}">View</a><button class="btn btn-info">Creative Uploads</button></td>
            </tr>
        @endforeach
    </tbody>
  </table>

@stop