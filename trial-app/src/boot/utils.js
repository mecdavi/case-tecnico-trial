import { boot } from 'quasar/wrappers'

export default boot(({ app }) => {
  app.config.globalProperties.executeMethod = async function (method, url, data,sair) {
    try {
        let response
        let errorMsg = ''
        try {
            let cliente_id
            // let baseURL = process.env.API_URL
            // url = baseURL+url
            console.log('URL:',url)
            if (this.getCliente_id) url = url+'?cliente_id='+this.getCliente_id.toString()
            if (this.getLogin && this.getLogin.token && !this.$api.defaults.headers.common['Authorization'])
                this.$api.defaults.headers.common['Authorization'] = this.getLogin.type+' '+this.getLogin.token
            if (method==='post') response = await this.$api.post(url,data || {cliente_id})
            else if (method==='get') {
                response = await this.$api.get(url,data || {cliente_id})

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
                                this.efetuarLogout()
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
  }
})
