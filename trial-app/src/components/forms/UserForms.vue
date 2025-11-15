<template>
  <div class="row">
    <div class="col-12 q-pa-sm">
      <q-card-section>
        <div class="row q-pb-md">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 q-px-xs">
            <q-input :disable = "$route.meta.fdisable" v-model="dado.nome" maxlength="50" :label="$t('nome') + ' * '" bottom-slots>
              <c-tooltip mensagem="Diferencie os produto ou serviço, a marca transmite os valores empresariais e fornece uma identidade ao produto."/>
            </q-input>
          </div>
        </div>
      </q-card-section>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'PageIndex',
    props: {
      isModal: {type :Boolean,requised: false, default: false},
      dadosModal: {type:Object, required:false, default: () => ({})},
    },
    data() {
      return {
        dado: {
          nome: ''
        }
      }
    },
    methods: {
      valoresDefault() {
        // this.isModal = false;
      },
      async gravar() {
      },
      excluir() {
      }
    },
    async created() {
    }
  }
</script>