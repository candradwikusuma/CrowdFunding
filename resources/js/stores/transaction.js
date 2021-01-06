    export default {
        namespaced:true,
        state:{
            transactions:0,
        },
        mutations:{
            insert:(state)=>{
                state.transactions++
            }
        },
        actions:{

        },
        getters:{
            transactions: state=>state.transactions
        }
    }