import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
  state: () => ({
    login: {},
    usuario: {},
    token : '',
    dadosEmpresa: {},
    permissaoUsuario: null
  }),

  getters: {
    getLogin: (state) => state.login,
    getUsuario: (state) => state.usuario,
    getDadosEmpresa: (state) => state.dadosEmpresa,
    getPermissaoUsuario: (state) => state.permissaoUsuario,
  },

  actions: {
    limparStore() {
      this.login = {}
      this.usuario = {}
      this.token = ''
      this.orderDados = {}
      this.permissaoUsuario = null
    },

    limparUsuario() {
      this.usuario = {}
    },

    setDados(obj) {
      if (obj && obj.key) this[obj.key] = obj.value
    },

    setUsuario(valor) {
      if (valor) this.usuario = valor
    },

  }
})
