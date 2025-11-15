<template>    
    <q-dialog ref="dialog" @hide="onDialogHide" persistent>
      <q-card style="width: 700px; max-width: 80vw;">
        <q-card-section>
          <div class="text-h6">Editar Usuario</div>
        </q-card-section>
        <q-card-section class="q-pt-none">
            <linha-produto-form ref="UserForms" :isModal="true"></linha-produto-form>
        </q-card-section>
        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancelar" v-close-popup />
          <q-btn flat label="Salvar" @click="onOKClick()" />
        </q-card-actions>
      </q-card>
    </q-dialog>
    <UserForms ></UserForms>
</template>
<script>
import UserForms from 'components/forms/UserForms.vue'
export default {
    components: {
        UserForms
    },
    methods: {
        show () {
            this.$refs.dialog.show()
        },
        hide () {
            this.$refs.dialog.hide()
        },
        onDialogHide () {
            this.$emit('hide')
        },
        async onOKClick () {
            const res = await this.$refs.UserForms.gravar()
            if(res) {
                this.$emit('ok',res)
                this.$refs.dialog.hide()
            }
        },
        onCancelClick () {
            this.hide()
            this.UserForms.valoresDefault()
        },
    },
}
</script>