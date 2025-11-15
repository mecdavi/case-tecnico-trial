import { defineStore } from 'pinia'

export const useAppStore = defineStore('trial', {
  state: () => ({
    login: {},
    usuario: {},
    token : '',
    role : '',
  }),

  getters: {
    getLogin: (state) => state.login,
    getUsuario: (state) => state.usuario,
    getToken: (state) => state.token,
    getRole: (state) => state.role,
  },

  actions: {
    limparStore() {
      this.login = {}
      this.usuario = {}
      this.token = ''
      this.role = ''
      localStorage.removeItem('pinia-trial')
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
  },
  persist: {
    paths: ['token', 'usuario'] // apenas o necessário
  }

})
