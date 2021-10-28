<template>
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
      <!-- @php $i=0 @endphp
        @foreach($advertising_campaigns as $advertising_campaign)
            <tr>
                <td scope="row">@php echo ++$i @endphp</td>
                <td>{{$advertising_campaign->name}}</td>
                <td>{{$advertising_campaign->date_from}}</td>
                <td>{{$advertising_campaign->date_to}}</td>
                <td>$@php echo number_format($advertising_campaign->total_budget, 2)@endphp</td>
                <td>$@php echo number_format($advertising_campaign->daily_budget, 2)@endphp</td>
                <td>
                  <a href={{ route('edit-campaign', [$advertising_campaign->id])}} class="btn btn-primary ml-auto d-inline-block px-4">Edit</a> 
                <a href="" data-campaign_id="{{$advertising_campaign->id}}" data-campaign_name={{$advertising_campaign->name}} class="btn btn-info" onclick="showImagesBtn(this); return false">Creative Uploads</a>
              </td>
            </tr>
        @endforeach -->
    </tbody>
  </table>
</template>

<script>
const default_layout = "layout";

export default {
  computed: {},
  data() {
    return {
      message: "Hello world"
    }
  }
}

</script>