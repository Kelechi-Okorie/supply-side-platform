@php
    $is_edit = isset($advertising_campaign);
@endphp

@extends('layouts.master')


@section('contents')

<div class="row justify-content-center">
    <div class="col-sm-12 col-md-10 col-lg-8">
        <div class="d-flex justify-content-end">
            <a href={{ route('list-campaigns')}} class="btn btn-primary ml-auto d-inline-block px-4">View All Campaigns</a>
        </div>
        <h4 class="h4 mb-4">{{$is_edit?'Edit':'New'}} Campaign</h4>
        
        <form enctype="multipart/form-data" id="campaign_form" action="{{ url('/test')}}" method="post">
            @csrf

            <input type="hidden" name="is_edit" value="{{$is_edit? '1' : '0'}}">
            <input type="hidden" name="id" value="{{$is_edit? $advertising_campaign->id : '0'}}">

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="advertising campaign name" value="{{$is_edit?$advertising_campaign->name:old('name')}}">
            </div>

            <div class="mb-3">
                <fieldset>
                    <legend>Dates</legend>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="date_from">From</label>
                            <input type="date" class="form-control" name="date_from" value="{{$is_edit?$advertising_campaign->date_from:old('date_from')}}">
        
                        </div>
                        <div class="col-sm-6">
                            <label for="date_to">To</label>
                            <input type="date" class="form-control" name="date_to" value="{{$is_edit?$advertising_campaign->date_to:old('date_to')}}">
        
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="mb-3">
                <label for="total_budget">Total budget</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" name="total_budget" value="{{$is_edit?$advertising_campaign->total_budget:old('total_budget')}}">
                </div>
            </div>

            <div class="mb-3">
                <label for="daily_budget">Daily budget</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" name="daily_budget" value="{{$is_edit?$advertising_campaign->daily_budget:old('daily_budget')}}">
                </div>
            </div>

            <div id="creative_upload_container"></div>

            <div class="mb-3">
                <button class="btn btn-info" id="add_creative_upload_btn">Add creative upload</button>
            </div>

            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-danger" name="submit" id="submit">Submit</button>
            </div>     

        </form>
    </div>
</div>


<!-- Creative upload template -->
<template id="creative_upload_input_element">
    <div class="mb-3">
        <label for="">Creative upload</label>
        <input type="file" accept="image/*" class="form-control" name="creative_upload" id="">
    </div>
</template>

<!-- Modal to indicate success or failure -->
<div id="store_response_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="storeResponseModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p id="response_message" class="text-center m-2"></p>
          </div>
      </div>
    </div>
</div>


@stop

@section('js_1')
    <script>
        let numberOfCreativeUploads = 0;
        const addCreativeUploadBtn = document.querySelector('#add_creative_upload_btn');

        addCreativeUploadBtn.addEventListener('click', function(e) {
            e.preventDefault();

            if ('content' in document.createElement('template')) {
                numberOfCreativeUploads++;
                const creativeUploadContainer = document.querySelector('#creative_upload_container');
                const template = document.querySelector('#creative_upload_input_element');

                const clone = template.content.cloneNode(true);

                const input = clone.querySelector('input')
                input.id = `creative_upload_${numberOfCreativeUploads}`;

                creativeUploadContainer.appendChild(clone);

            }
        });

        const submitBtn = document.querySelector('#submit');
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            submitBtn.setAttribute('disabled', true);

            const responseModal = new bootstrap.Modal(document.getElementById('store_response_modal'), {
                keyboard: false
            });

            const fileInputs = document.querySelectorAll('input[type=file]');

            let uploadedFiles = [];

            const formData = new FormData();

            const form = document.querySelector('form#campaign_form');

            formData.append('is_edit', form.is_edit.value);
            formData.append('id', form.id.value);

            formData.append('name', form.name.value); 
            formData.append('date_from', form.date_from.value);
            formData.append('date_to', form.date_to.value);
            formData.append('total_budget', form.total_budget.value);
            formData.append('daily_budget', form.daily_budget.value);
            for (let i = 0; i < fileInputs.length; i++) {
                formData.append(`file_${i}`, fileInputs[i].files[0]);
            }

            const config = {
                method: 'POST',
                body: formData
            };

            fetch('/api/v1/advertising-campaign', config)
            .then(response => {
                console.log(response);
                return response.json();
            })
            .then(response => {
                console.log('from line 158', response);
                const responseMessage = document.querySelector('p#response_message');
                responseMessage.textContent = response.msg;
                responseModal.show();

            })
            .catch(e => {
                console.log('an error occured', e);
                const responseMessage = document.querySelector('p#response_message');
                responseMessage.textContent = 'An error occured';
                responseModal.show();

            })
            .finally(function() {
                submitBtn.removeAttribute('disabled');
            });

        })

        const totalBudget = document.querySelector("input[name='total_budget']");
        const dailyBudget = document.querySelector("input[name='daily_budget']");
        totalBudget.addEventListener('blur', function(e) {
            totalBudget.value = fixToTwoDecimalPlaces(totalBudget.value);
        });
        dailyBudget.addEventListener('blur', function(e) {
            dailyBudget.value = fixToTwoDecimalPlaces(dailyBudget.value);
        });

        const fixToTwoDecimalPlaces = number => Number(number).toFixed(2);

    </script>
@stop