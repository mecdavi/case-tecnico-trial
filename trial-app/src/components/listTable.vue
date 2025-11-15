<template>
    <div class="row col-12 flex justify-center q-pt-md">
        <div class="text-h5 flex justify-center col-12 row q-py-lg"> {{title}}</div>
        <div class="col-8">
            <div>
                <q-btn class="q-my-md" color="primary" outline label="Adicionar" @click="$router.push('users/edit')" />
            </div>
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
                        <q-btn flat round icon="edit" color="positive" @click="$router.push('users/edit/' + props.row.id)" />
                        <q-btn flat round icon="delete" color="negative" @click="deleteItem(props.row.id)" />
                    </q-td>

                </template>
            </q-table>
        </div>
    </div>
</template>
<script>
import UserModal from 'components/modals/UserModal.vue';
export default {
  name: 'ListTable',
  props: {
    data: { type: Array, required: true, default: () => [] },
    columns: { type: Array, required: true, default: () => [] },
    title: { type: String, required: false, default: '' },
  },
  methods: {
    save(id) {
        this.$q.dialog({
          component: UserModal,
          parent: this, dadosModal: { id: id },
        }).onOk((res) => {
          this.gravarProduto(res)
        })

        console.log('save item')
    },
   async deleteItem(id) {
        this.$q.dialog({title:'Atenção!',message:'Você tem certeza que deseja proseguir?',
            cancel:'Não',
            style:{'z-index':'100'}, 
            persistent:false,
            ok:'Sim',}).onOk(() => {
                let response = this.executeMethod('delete', 'api/v1/users/'+id)
                if(response && response.status === 201){
                    this.mostrarNotificacao({
                        color: 'positive',
                        message: 'Item deletado com sucesso!'
                    })
                }
            }).onCancel(() => {
                return false
            })
    }
  },
  mounted() {
  }
}
</script>
