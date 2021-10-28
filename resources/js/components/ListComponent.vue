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
            <a class="btn btn-primary ml-auto d-inline-block px-4">Edit</a>
            <a
              class="btn btn-info"
              v-on:click="fetchCreativeUploads"
              :data-campaign_id="campaign.id"
              :data-campaign_name="campaign.name"
              >Creative Uploads</a
            >
            <creative-button></creative-button>
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
    console.log("List component mounted.");
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

    fetchCreativeUploads: function (event) {
      const element = event.srcElement;

      const campaignId = element.dataset.campaign_id;

      fetch(`/api/v1/advertising-campaign/${campaignId}/images`)
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          const bootstrapModal = new bootstrap.Modal(
            document.querySelector("#uploaded_previews_modal"),
            { backdrop: true }
          );
          const modal = document.querySelector("#uploaded_previews_modal");
          const title = modal.querySelector(".modal-title");
          const body = modal.querySelector(".modal-body");
          title.textContent = `${element.dataset.campaign_name}`;

          data.forEach((datum) => {
            const img = document.createElement("img");
            img.className = "img-fluid";
            img.src = datum;
            body.appendChild(img);
          });

          bootstrapModal.show();
        })
        .catch((e) => {
          console.log("an error occured while fetching images", e);
        });

      const modal = document.querySelector("#uploaded_previews_modal");
      modal.addEventListener("hidden.bs.modal", function (e) {
        const body = modal.querySelector(".modal-body");
        body.innerHTML = "";
      });
    },
  },

  components: {
      
  }
};
</script>