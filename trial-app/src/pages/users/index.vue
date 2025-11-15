<template>
  <q-page>
    <div class="row col-12 flex justify-center q-pt-md">
        <div class="text-h5 flex justify-center col-12 row q-py-lg"> Listagem de usuários</div>
        <div class="col-8">
            <q-btn v-show="getters.getRole != 'User'" class="q-my-md" color="primary" outline label="Adicionar" @click="$router.push('users/edit')" />
            <q-table 
                :rows="data"
                class="my-sticky-dynamic"
                :columns="columns"
                bordered
                binary-state-sort
                table-header-style="background-color: #E0E0E0; color: black; font-weight: bold;"
                dar
                :rows-per-page-options="[5,10,15]"
                row-key="tipo"
            >
                <template v-slot:body-cell-actions="props">
                    <q-td align="left">
                        <q-btn flat round icon="remove_red_eye" color="primary" @click="$router.push('users/show/' + props.row.id)" />
                        <q-btn v-show="getters.getRole != 'User'" flat round icon="edit" color="positive" @click="$router.push('users/edit/' + props.row.id)" />
                        <q-btn v-show="getters.getRole != 'User'" flat round icon="delete" color="negative" @click="deleteItem(props.row.id)" />
                    </q-td>

                </template>
            </q-table>
        </div>
    </div>
  </q-page>
</template>

<script>
import { useAppStore } from 'src/stores/dados'
export default {
  name: "indexUsers",
  data() {
    return {
      data: [],
      getters: useAppStore(),
      columns: [
        { name: 'actions', label: 'Ações', field: 'actions', align: 'left' },
        { name: 'email', label: 'Email', field: 'email', align: 'left' },
        { name: 'name', label: 'Nome', field: 'name', align: 'left' },
        { name: 'created_at', label: 'Criado em ', field: 'created_at', sortable: true, align: 'left',sort: (a, b) => a > b ? -1 : 1},
        { name: 'updated_at', label: 'Atualizado em ', field: 'updated_at', align: 'left' },
    ]
    }
  },
  methods:{
    async buscar(){
        await this.executeMethod('get', 'api/v1/users').then(response => {
            if(response && response.status === 200){
                this.data = response.data.data
            }
        })
    },
    async deleteItem(id) {
        this.$q.dialog({title:'Atenção!',message:'Você tem certeza que deseja proseguir?',
            cancel:'Não',
            style:{'z-index':'100'}, 
            persistent:false,
            ok:'Sim',}).onOk(async() => {
                let response = await this.executeMethod('delete', 'api/v1/users/'+id)
                console.log(response)
                if(response && response.status === 200){
                    this.mostrarNotificacao({
                        color: 'positive',
                        message: response.data.message
                    })
                    await this.buscar()
                    return
                }
            }).onCancel(() => {
                return false
            })
    }
  },
    async created () {
        await this.buscar()
    }
}
</script>
