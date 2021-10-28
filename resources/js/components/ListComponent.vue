<template>
  <div>
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
        <tr
          v-for="(campaign, index) in advertisingCampaings"
          :key="campaign.id"
        >
          <td scope="row">{{ ++index }}</td>
          <td>{{ campaign.name }}</td>
          <td>{{ campaign.date_from }}</td>
          <td>{{ campaign.date_to }}</td>
          <td>{{ campaign.total_budget.toFixed(2) }}</td>
          <td>{{ campaign.daily_budget.toFixed(2) }}</td>
          <td>
            <creative-button :campaign_id="campaign.id" :campaign_name="campaign.name"></creative-button>
            <a v-bind:href="'/campaign/edit/' + campaign.id" class="btn btn-danger btn-sm ml-auto d-inline-block px-4">Edit</a>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Uploaded previews modal -->

    <div id="uploaded_previews_modal" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      advertisingCampaings: [],
    };
  },

  mounted() {
    this.loadAdvertisingCampaings();
  },

  methods: {
    loadAdvertisingCampaings: function () {
      fetch("/api/v1/advertising-campaign")
        .then((response) => {
          console.log("the response", response);
          return response.json();
        })
        .then((response) => {
          console.log(response);
          this.advertisingCampaings = response.data;
        })
        .catch((e) => {
          console.log("an error occured");
        });
    },

  },

  components: {
      
  }
};
</script>