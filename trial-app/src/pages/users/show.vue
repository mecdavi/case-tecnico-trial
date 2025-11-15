<template>
  <q-page class="row justify-center">
    <q-card class="col-10 q-my-md">
        <q-card-actions>
            <q-btn flat label="Voltar"  class="q-mr-md" icon="arrow_back" color="negative" @click="$router.push('/users')" outlined />
            <q-btn v-show="!$route.meta.fdisable" label="Gravar" class="q-ma-md" icon="save" color="primary" outlined  @click="save()"/>
        </q-card-actions>
        <q-card-section>
            <div class="text-h6">Detalhes do Usuário</div>
        </q-card-section>
        <q-card-section>
            <div class="row col-12">
                <div class="col-5 q-ma-md">
                    <q-input v-model="data.name" :disable="$route.meta.fdisable" label="Nome" />
                </div>
                <div class="col-5 q-ma-md">
                    <q-input v-model="data.email" type="email" :disable="$route.meta.fdisable" label="Email" />
                </div>
            </div>
            <div  class="row col-12">
                <div class="col-3 q-ma-md">
                    <q-select v-model="data.role"   map-options emit-value :disable="$route.meta.fdisable" :options="rolesOptions()" label="Permissão"/>
                </div>
                <div class="col-4 q-ma-md">
                    <q-input label="Digite uma senha" v-show="!this.$route.params.id" v-model="data.password" filled :type="isPwd ? 'password' : 'text'">
                        <template v-slot:append>
                        <q-icon
                            :name="isPwd ? 'visibility_off' : 'visibility'"
                            class="cursor-pointer"
                            @click="isPwd = !isPwd"
                        />
                        </template>
                    </q-input>
                </div>
                <div class="col-4 q-ma-md">
                    <q-input label="Cofirme a Senha" v-show="!this.$route.params.id" v-model="data.password_confirmation" filled :type="isPwd_confirmation ? 'password' : 'text'">
                        <template v-slot:append>
                        <q-icon
                            :name="isPwd_confirmation ? 'visibility_off' : 'visibility'"
                            class="cursor-pointer"
                            @click="isPwd_confirmation = !isPwd_confirmation"
                        />
                        </template>
                    </q-input>
                </div>
            </div>
        </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
export default {
  name: "indexUsers",
  data() {
    return {
      isPwd:true,
      isPwd_confirmation:true,
      data: 
        {
            name: '',
            email: '',
            password: '',
            password_confirmation:'',
            role: '',
        }
      ,
    }
  },
  methods:{
    async save(){
        let response = await this.executeMethod('post','api/v1/users',this.data)
        if(response.status == 201){
            this.mostrarNotificacao({color: 'positive',message: 'usuário gravado com sucesso!'})
            this.$router.push('/users/show/'+response.data.data.id)
            return  
        }else{
            let errors = Object.values(response.data.errors)
            for(let message of errors)
                this.mostrarNotificacao({color: 'negative',message: message[0]})
        }

    }
  },
    async created () {
        if(this.$route.params?.id){
            this.executeMethod('get', 'api/v1/users/'+this.$route.params.id).then(response => {
                if(response && response.status === 200){
                    this.data = response.data.data
                }
            })
        }
    }
}
</script>
