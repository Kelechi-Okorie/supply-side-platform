<template>
  <a class="btn btn-info btn-sm" v-on:click="clickHandler">Creative uploads</a>
</template>

<script>
export default {
  data: function () {
    return {};
  },

  mounted: function () {},

  methods: {
    clickHandler: function (event) {
      fetch(`/api/v1/advertising-campaign/${this.campaign_id}/images`)
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
          title.textContent = `${this.campaign_name}`;

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

  props: ["campaign_id", "campaign_name"],
};
</script>
