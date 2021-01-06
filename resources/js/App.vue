<template>
    <v-app>
        <alert-component></alert-component>
        <!-- sidebar -->
        <v-navigation-drawer app v-model="drawer">

            <v-list>
                <v-list-item v-if="!guest">
                    <v-list-item-avatar>
                        <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>John candra</v-list-item-title>
                    </v-list-item-content> 
                </v-list-item>

                <div class="pa-2" v-if="guest">
                    <v-btn block color="primary" class="mb-1">
                        <v-icon left>mdi-lock</v-icon>
                        LOGIN
                    </v-btn>
                    <v-btn block color="success" class="mb-1">
                        <v-icon left>mdi-account</v-icon>
                        REGISTER
                    </v-btn>
                </div>
                <v-divider>   </v-divider>
                <v-list-item 
                    v-for="(item,index) in menus"
                    :key="`meni-`+index"
                    :to="item.route"
                >
                    <v-list-item-icon>
                        <v-icon left>{{item.icon}}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>{{item.title}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <template v-slot:append v-if="!guest">
                <div class="pa-2">
                    <v-btn block color="red" dark>
                        <v-icon left>mdi-lock</v-icon>
                        Logout
                    </v-btn>
                </div>
            </template>

        </v-navigation-drawer>
        <!-- header -->
        <v-app-bar app color="info" dark v-if="isHome">
            <v-app-bar-nav-icon @click.stop="drawer=!drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>SanbercodeApps</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn icon>
                <v-badge  color="orange" overlap v-if="transactions>0">
                    <template v-slot:badge>
                        <span>{{transactions}}</span>
                    </template>
                    <v-icon>mdi-cash-multiple</v-icon>
                </v-badge>
                <v-icon v-else>mdi-cash-multiple</v-icon>
            </v-btn>

            <v-text-field
                slot="extension"
                hide-details
                append-icon="mdi-microphone"
                flat
                name="name"
                label="Search"
                prepend-inner-icon="mdi-magnify"
                solo-inverted
            ></v-text-field>
        </v-app-bar>

    <v-app-bar app color="info" dark v-else>
      <v-btn icon @click.stop="$router.go(-1)">
        <v-icon>mdi-arrow-left-circle</v-icon>
      </v-btn>

      <v-spacer />

      <v-btn icon>
        <v-badge color="orange" overlap v-if="transactions>0">
          <template v-slot:badge>
            <span>{{ transactions }}</span>
          </template>
          <v-icon>mdi-cash-multiple</v-icon>
        </v-badge>
        <v-icon v-else>mdi-cash-multiple</v-icon>
      </v-btn>
    </v-app-bar>
        <!-- Sizes your content based upon application components -->
        <v-main >
          
            <!-- content -->
            <v-container>
                
                <v-slider-y-transition>
                <router-view></router-view>
                </v-slider-y-transition>
            <!-- If using vue-router -->
            </v-container>
        </v-main>

    <!-- footer -->
    <v-card>
        <v-footer absolute app>
            <v-card-text class="text-center">
                &copy;{{new Date().getFullYear()}} - <strong>SanberCode</strong>
            </v-card-text>
        </v-footer>
    </v-card>

    </v-app>
</template>
<script>
import {mapGetters} from 'vuex'
import AlertComponent from './components/AlertComponent.vue';

export default {
    name:'app',
    components: {
        AlertComponent:() => import('./components/AlertComponent')
    },
    data: ()=>({
        drawer:false,
        menus:[
            {title:'Home',icon:'mdi-home',route:'/'},
            {title:'Campaigns',icon:'mdi-hand-heart',route:'/campaigns'},
        ],
        guest:false,
    }),
    computed: {
        isHome() {
            return this.$route.path === "/" || this.$route.path === "/home";
        },
        ...mapGetters({
            'transactions':'transaction/transactions'
        }),
        // transaction(){
        //     return this.$store.getters.transaction
        // }
        
    },
   

}
</script>