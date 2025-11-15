import { boot } from 'quasar/wrappers'
import { useAppStore } from 'src/stores/dados'

export default boot(({ app,router }) => {
  app.config.globalProperties.executeMethod = async function (method, url, data,sair) {
    try {
        let response
        let errorMsg = ''
        const appStore = useAppStore()
        try {
            if (appStore.getToken && !this.$api.defaults.headers.common['Authorization'])
                this.$api.defaults.headers.common['Authorization'] = 'Bearer '+ appStore.getToken
            if (method==='post') response = await this.$api.post(url,data)
            else if (method==='get') {
                response = await this.$api.get(url,data)
            }
            else if (method==='get-pdf') response = await this.$api.get(url,data ||  {responseType: 'arraybuffer'})
            else if (method==='put') response = await this.$api.put(url,data || {})
            else if (method==='patch') response = await this.$api.patch(url,data || {})
            else if (method==='delete') response = await this.$api.delete(url,data || {})
            else if (method==='post-multipart') response = await this.$api.post(url,data, {
                headers: {                        
                    "Content-Type": `multipart/form-data; boundary=${data._boundary}`,
                    "Access-Control-Allow-Origin": "*"
                }})
            
        }
        catch(e) {response = e.response}
        response = response || {}
        if (response && response.status!==200 && response.status!==204 && (response.status !== 403 && method ==='get')) {
            if (response.status===0) errorMsg = 'Erro conectando ao servidor, por favor tente novamente mais tarde'
            else {
                errorMsg = 'code: '+response.status+' - '+(response.statusText || '')+'<br>'
                if (response.data && response.data.length>0) {
                    for (let item of response.data)
                        for (let item2 in item)
                            errorMsg += item2+': '+item[item2]+'<br>'
                }
                if (response.data && response.data.error) {
                    if (response.data.error==='ValidationErrorBackEnd' && response.data.messages && response.data.messages.length>0) {
                        for (let item of response.data.messages)
                            errorMsg += item.message
                    }
                    else {
                        errorMsg += (response.data.error.name ? 'name: '+response.data.error.name+'<br>' : '')+(response.data.error.e ? response.data.error.e+'<br>' : '')+'message: '+(response.data.error.message || '')
                        if (response.data.error.name==='InvalidJwtToken')
                            if (sair===true || sair===undefined)
                                this.$logout()
                    }
                }
            }
        }
        else if(response && response.status == 403 && method ==='get' ){
            this.mostrarNotificacao({message: 'Usuário sem permissão para acessar a tela'})
            this.$router.push('/')
        }
        if (errorMsg!=='') this.mostrarNotificacao({message:errorMsg,html:true})
        return response

    } catch (err) {
      console.error(err)
      throw err
    }
  },
   app.config.globalProperties.mostrarNotificacao = async function (data) {
    try {
        let textColor = data.color==='warning' || data.color==='yellow' ? 'black' : 'white'
        this.$q.notify({
            message: data.message || '',
            html: data.html || false,
            color: data.color || 'negative',
            textColor: data.textColor || textColor,
            icon: data.icon || 'warning',
            position: data.position || 'bottom',
            timeout: data.timeout || 1000*10,
            actions: data.actions || [{icon:'close',color:textColor}]
        })

    } catch (err) {
      console.error(err)
      throw err
    }
  },
   app.config.globalProperties.$logout = async function () {
    try {
        const appStore = useAppStore()
        await appStore.limparStore()
        router.push('/login')
    } catch (err) {
      console.error(err)
      throw err
    }
  },
   app.config.globalProperties.validacaoMensagem = async function () {
    try {
        this.$q.dialog({title:'Atenção!',message:'Você tem certeza que deseja proseguir?',
            cancel:'Não',
            style:{'z-index':'100'}, 
            persistent:false,
            ok:'Sim',}).onOk(() => {
                return true
            }).onCancel(() => {
                return false
            })
    } catch (err) {
      console.error(err)
      throw err
    }
  },
   app.config.globalProperties.rolesOptions = function () {
    try {
        let roles = [
            {label:'Administrador', value:'Admin'},
            {label:'Usuário', value:'User'}
        ]
        return roles
    }catch (err){
      console.error(err)
      throw err
    }
  }
})
