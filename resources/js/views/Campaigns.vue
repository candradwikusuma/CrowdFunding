<template>
  <div>
    <v-container>
      <v-subheader> All Campaigns</v-subheader>
      <v-layout wrap>
        <v-flex
          v-for="(campaign, index) in campaigns"
          :key="`campaign-${campaign.id}`"
          xs6
        >
          <!-- <card-component
            :class="[
              (index + 1) % 2 > 0 ? 'mr-4' : '',
              index > 1 ? 'mt-4' : '',
            ]"
            :campaign="campaign"
          /> -->
                    <campaign-item :campaign="campaign"/>
        </v-flex>
      </v-layout>

      <v-pagination
        v-model="page"
        @input="go"
        :length="lenghtPage"
        :total-visible="6"
      />
    </v-container>
  </div>
</template>

<script>

export default {
        components: {
            CampaignItem:()=>import('../components/CampaignItem')
        },

  data() {
    return {
      campaigns: [],
      lenghtPage: 0,
      page: 0,
    //   title: "All Campaigns",
    };
  },
    created(){
        this.go()
    },
  methods: {
     go() {
        let url='/api/campaign?page='+this.page
          axios.get(url)
        .then((response) => {
          let {data} = response.data;
          this.campaigns = data.campaigns.data;
          this.page = data.campaigns.current_page;
          this.lenghtPage = data.campaigns.last_page;
        })
        .catch((err) => {
          console.log(err);
        });
    },

  },

}
</script>

<style>
</style>
