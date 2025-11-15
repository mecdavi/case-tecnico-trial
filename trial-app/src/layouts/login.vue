<template>
	<q-layout view="hHh Lpr fff">
		<q-page-container>
			<div class="row col-12">
				<div class="col-md-4 offset-md-4 col-xs-12 ">
					<div class="logo">
						<q-img style="max-width: 400px; height: 200px;border-radius: 20px;" fit="cover" class="bg-dark" src="/src/assets/trial_logo.png"/>
					</div>
					<div class="row">
						<div class="col-12 q-pb-lg q-px-md"><q-input v-model="form.email" label="Email" bottom-slots ref="email"/></div>
					</div>
					<div class="row">
						<div class="col-12 q-pb-lg q-px-md"><q-input :type="esconderSenha ? 'password' : 'text'" v-model="form.password" label="Senha" bottom-slots><q-btn style="align-items: end;" dense :icon="esconderSenha ?'visibility' :  'visibility_off'" color="dark" flat round size="sm" @click="esconderSenha ? esconderSenha = false : esconderSenha = true"></q-btn></q-input></div>
					</div>
					<div class="row justify-around">
						<div class="q-pb-lg"><q-btn outline no-caps color="dark" class="q-px-xl" label="Login" title="Login" @click="login()"/></div>
					</div>
				</div>
			</div>
		</q-page-container>
	</q-layout>	
</template>
<script type="text/javascript">
import { useAppStore } from 'src/stores/dados'
	export default {
		name: 'PageIndex',
		data() {
			return {
				form: {
					email: '',
					password: ''
				},
				esconderSenha: true,
			}
		},
		methods: {
			async login() {
				this.$q.loading.show()
				const appStore = useAppStore()
				await appStore.limparStore()
				var response = await this.executeMethod('post','api/v1/login',this.form)
				if (response.status===200) {
					await appStore.setDados({key:'login',value:response.data.usuario.email_verified_at})
					await appStore.setDados({key:'usuario',value:response.data.usuario})
					await appStore.setDados({key:'token',value:response.data.token})
					this.$router.push('/')
				}else{
					this.mostrarNotificacao({message:'Usuário não cadastrado',type:'negative'})
				}
				this.$q.loading.hide()
			},
		},
		mounted() {
			this.$nextTick(function() {
				this.$refs.email.focus()
			})
		}
	}
</script>