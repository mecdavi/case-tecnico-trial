<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar class="bg-secondary">
        <q-btn flat dense round icon="menu" aria-label="Menu" @click="toggleLeftDrawer" />
        <q-toolbar-title> Trial App </q-toolbar-title>
        <!-- User Menu -->
          <span class="q-px-md text-bold">{{appStore.usuario.email}}</span>
          <q-avatar size="32" color="primary">
            <q-img fit="cover" src="/src/assets/cat_2.png" ></q-img>
          </q-avatar>
          <q-btn-dropdown class="gt-xs pc" stretch flat icon="settings">
					<q-list dense class="bg-secondary text-white">
						<q-list class="q-pl-xs">
							<q-item>
								<q-item-section>
									<q-item-label>Configurações</q-item-label>
								</q-item-section>
							</q-item>
							<q-item clickable @click="$logout()">
								<q-item-section>
									<q-item-label>Logout</q-item-label>
								</q-item-section>
							</q-item>
						</q-list>
          </q-list>
          </q-btn-dropdown>
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
                    title: 'Dashboard',
                    caption: 'Dashboard users',
                    icon: 'dashboard',
                    link: '/',
                },
                {
                    title: 'Usuários',
                    caption: 'Crie ou gerencie usuários',
                    icon: 'person',
                    link: '/users',
                },
            ],
            leftDrawerOpen:false,
            appStore:'' ,
        }
    },
    methods:{
        toggleLeftDrawer() {
          this.leftDrawerOpen = !this.leftDrawerOpen
        }
    },
    async created(){
      this.appStore = useAppStore()
      if (!this.appStore.getUsuario || Object.keys(this.appStore.getUsuario).length === 0) {
        return this.$logout()
      }

    }
}
</script>
