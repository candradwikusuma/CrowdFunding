<template>
  <div>
    <v-container class="mx-auto pa-0 my-0">
      <v-card v-if="campaign.id">
        <v-img :src="campaign.image" class="white--text" height="200px">
          <v-card-title class="fill-height align-end" v-text="campaign.title" />
        </v-img>

        <v-card-text>
          <v-simple-table>
            <tbody>
              <tr>
                <td><v-icon class="mr-2">mdi-home-city</v-icon>Alamat</td>
                <td>{{ campaign.address }}</td>
              </tr>
              <tr>
                <td><v-icon class="mr-2">mdi-hand-heart</v-icon>Terkumpul</td>
                <td class="blue--text">
                  Rp {{ campaign.collected.toLocaleString("id-ID") }}
                </td>
              </tr>
              <tr>
                <td><v-icon class="mr-2">mdi-cash</v-icon>Dibutuhkan</td>
                <td class="orange--text">
                  Rp {{ campaign.required.toLocaleString("id-ID") }}
                </td>
              </tr>
            </tbody>
          </v-simple-table>
          Description: <br />
          {{ campaign.description }}
        </v-card-text>

        <v-card-actions>
          <v-btn
            block
            color="primary"
            @click="donate"
            :disabled="campaign.collected >= campaign.required"
          >
            <v-icon>mdi-money</v-icon> &nbsp; DONATE
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-container>
  </div>
</template>

<script>

export default {
  data() {
    return {
      campaign: {},
 
    };
  },
    created(){
        this.go()
    },
    methods:{
        go(){
            let {id}= this.$route.params
            let url='/api/campaign/'+id
            axios.get(url)
            .then((response) => {
            let { data } = response.data;
            this.campaign = data.campaign;

            })
            .catch((err) => {
                let{response}=error
            console.log(err);
            });
  
        }  ,
        donate() {
          this.$store.commit('insert');
        }
    },
    
//   },

//   mounted() {
//     document.title = this.title;
//     this.getCampaign();
//   },
};
</script>

<style>
</style>
