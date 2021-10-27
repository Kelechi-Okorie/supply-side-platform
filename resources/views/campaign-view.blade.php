@extends('layouts.master')


@section('contents')

<div class="row justify-content-center">
    <div class="col-sm-12 col-md-10 col-lg-8">
        <div class="d-flex justify-content-end">
            <a href={{ url('/')}} class="btn btn-primary ml-auto d-inline-block px-4">View All Campaigns</a>&nbsp;<a href={{ route('edit-campaign', [$advertising_campaign->id])}} class="btn btn-primary ml-auto d-inline-block px-4">Edit Campaign</a>
        </div>
        <h4 class="h4 mb-4">View Campaign</h4>
        
        <div>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <div class="form-control" name="name" id="name">{{$advertising_campaign->name}}</div>
            </div>

            <div class="mb-3">
                <fieldset>
                    <legend>Dates</legend>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="date_from">From</label>
                            <div type="date" class="form-control" name="date_from">{{$advertising_campaign->date_from}}</div>
        
                        </div>
                        <div class="col-sm-6">
                            <label for="date_to">To</label>
                            <div class="form-control" name="date_to">{{$advertising_campaign->date_to}}</div>
        
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="mb-3">
                <label for="total_budget">Total budget</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <div class="form-control" name="total_budget">{{$advertising_campaign->total_budget}}</div>
                </div>
            </div>

            <div class="mb-3">
                <label for="daily_budget">Daily budget</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <div class="form-control" name="daily_budget">{{$advertising_campaign->daily_budget}}</div>
                </div>
            </div>

            <div>
                @foreach($creative_uploads as $upload)
                    <img src="{{asset('storage/' . $upload->filepath)}}" class="img-fluid" alt="...">
                @endforeach
            <div>
  
        </div>
    </div>
</div>


@stop

@section('js_1')
    <script>

    </script>
@stop