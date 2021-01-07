import Vue from 'vue'
import Vuex from 'vuex'
import transaction from './stores/transaction.js'
import alert from './stores/alert.js'
import dialog from './stores/dialog.js'
import auth from './stores/auth.js'
import VuexPersistence from 'vuex-persist'

const VuexPersist = new VuexPersistence({
    key: 'sanbercode',
    storage: localStorage
  })

Vue.use(Vuex)

    export default new Vuex.Store({
        plugins:[VuexPersist.plugin],
        modules:{
            transaction,
            alert,
            dialog,
            auth
        }
    })