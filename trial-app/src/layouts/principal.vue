<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar class="bg-secondary">
        <q-btn flat dense round icon="menu" aria-label="Menu" @click="toggleLeftDrawer" />

        <q-toolbar-title> Trial App </q-toolbar-title>
      </q-toolbar>
    </q-header>
    <q-drawer v-model="leftDrawerOpen" show-if-above bordered dark>
      <q-list>
          <q-toolbar-title>
            <q-img
						  src="/src/assets/trial_logo.png"
						  style="height:25px;width:150px;"
						  class="cursor-pointer q-pa-lg  q-ml-lg"
              @click="$router.push('/')"
					/>
          </q-toolbar-title>
        <EssentialLink v-for="link in linksList" :key="link.title" v-bind="link" />
      </q-list>
    </q-drawer>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>
<script lang="js">
import EssentialLink from 'components/EssentialLink.vue'
import { useAppStore } from 'src/stores/dados'
export default{
    name:'principal-layout',
    components:{
        EssentialLink
    },
    data(){
        return{
            linksList : [
                {
                    title: 'Home',
                    caption: '',
                    icon: 'home',
                    link: '/',
                },
                {
                    title: 'Dashboard',
                    caption: 'Dashboard users',
                    icon: 'dashboard',
                    link: 'dashboard',
                },
                {
                    title: 'Usuários',
                    caption: 'Crie ou gerencie usuários',
                    icon: 'person',
                    link: 'users',
                },
            ],
            leftDrawerOpen:false
        }
    },
    methods:{
        toggleLeftDrawer() {
          this.leftDrawerOpen = !this.leftDrawerOpen
        }
    },
    async created(){
       const appStore = useAppStore()
      if (!appStore.getUsuario || Object.keys(appStore.getUsuario).length === 0) {
        return this.$router.push('/login')
      }

    }
}
</script>
