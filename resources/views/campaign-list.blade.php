@extends('layouts.master')


@section('contents')

<h4 class="h4">Advertising Campaigns</h4>
<div class="d-flex justify-content-end">
    <a href={{ route('new-campaign')}} class="btn btn-primary ml-auto d-inline-block px-4">New</a>
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
                <td>$@php echo number_format($advertising_campaign->total_budget, 2)@endphp</td>
                <td>$@php echo number_format($advertising_campaign->daily_budget, 2)@endphp</td>
                <td><a href={{ route('edit-campaign', [$advertising_campaign->id])}} class="btn btn-primary ml-auto d-inline-block px-4">Edit</a> {{-- <a class="btn btn-primary mr-1" href="{{ route('view-campaign', $advertising_campaign->id)}}">View</a> --}} <a href="" data-campaign_id="{{$advertising_campaign->id}}" data-campaign_name={{$advertising_campaign->name}} class="btn btn-info" onclick="showImagesBtn(this); return false">Creative Uploads</a></td>
            </tr>
        @endforeach
    </tbody>
  </table>

  <!-- Uploaded previews modal -->
  <div id="uploaded_previews_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
  </div>
 


@stop

@section('js_1')

  <script>
    const showImagesBtn = element => {

      const campaignId = element.dataset.campaign_id;

      fetch(`/api/v1/advertising-campaign/${campaignId}/images`)
      .then(response => {
        return response.json()
      })
      .then(data => {
        const bootstrapModal = new bootstrap.Modal(document.querySelector('#uploaded_previews_modal'), {backdrop: true});
        const modal = document.querySelector('#uploaded_previews_modal');
        const title = modal.querySelector('.modal-title');
        const body = modal.querySelector('.modal-body');
        title.textContent = `${element.dataset.campaign_name}`;

        data.forEach(datum => {
          const img = document.createElement('img');
          img.className = 'img-fluid';
          img.src = datum;
          body.appendChild(img);
        });



        bootstrapModal.show();

      })
      .catch(e => {
        console.log('an error occured while fetching images', e);
      });

      const modal = document.querySelector('#uploaded_previews_modal');
      modal.addEventListener('hidden.bs.modal', function(e) {
        const body = modal.querySelector('.modal-body');
        body.innerHTML = '';
      })
    }
  </script>

@stop