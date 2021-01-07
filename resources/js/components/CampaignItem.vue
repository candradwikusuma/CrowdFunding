
<template>
  <div>
    <v-card  class="mr-1" :to="`/campaign/`+campaign.id">
      <v-img :src="campaign.image" class="white--text" height="200px" >
      <v-card-title class="fill-height align-end" v-text="campaign.title" />
        </v-img>
      <v-card-actions class="mb-0">
        <v-progress-linear
          v-model="progress"
          color="blue-grey"
          height="7"
        ></v-progress-linear>
        
      </v-card-actions>

      <v-card-actions>
        <v-icon class="mr-0 mt-0">mdi-cash</v-icon>
        <span>Rp{{ campaign.required.toLocaleString("id-ID") }}</span>
        <v-spacer />
        <span>{{ progress }} %</span>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
export default {
  name: "campaign-item",
  props: ["campaign"],
  computed: {
    progress() {
      return (this.campaign.collected / this.campaign.required) * 100;
    },
  },
};
</script>

<style>
</style>
