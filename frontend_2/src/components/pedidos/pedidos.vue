<template>
<div>
  <b-container>
  <h1>Pedidos</h1>
    <b-row >
      <b-col cols="3" >
        <a href="/pedido/cadastro" class="outline-warning py-1 px-md-2">Novo Pedido </a>

      </b-col>
     
      <b-col cols="9"> 
           <table class="table">
            <thead>          
              <th scope="col">Data</th>
              <th scope="col">Observacao</th>
              <th scope="col">Forma de pagamento</th>
              <th scope="col">cliente</th>
              <th scope="col">Ações</th>
            </thead>
            <tbody>
            <tr v-for="item in items" :key="item.id">
              <td>{{item.data}}</td>
              <td>{{item.observacao}}</td>
              <td>{{item.forma_pagamento}}</td>
              <td>{{item.cliente_id}}</td>
              <td><b-button variant="outline-danger py-1 px-md-2" @click="excluir(item.id)"><b-icon icon="x"></b-icon></b-button>
              <b-button variant="outline-warning py-1 px-md-2" @click="editar(item.id)"><b-icon icon="pen"></b-icon></b-button>
              <b-button variant="outline-primary py-1 px-md-2" @click="report(item.id)"><b-icon icon="download"></b-icon></b-button>
              <b-button variant="outline-success py-1 px-md-2" @click="send(item.id)"><b-icon icon="envelope"></b-icon></b-button>
              </td>
            </tr>
            </tbody>
          </table>          
            
      </b-col>
    </b-row>
    
    </b-container>
 
 
</div>

</template>

<script>

  export default {
    props: ["pedidos"],

    data() {
      return { 
        items: [],
        mensagem: ''
      }
    },
    methods: {
      salvar() {
        const metodo =  this.pedidos.id ? 'patch' : 'post'
        const finalUrl = this.pedidos.id ? `/${this.pedidos.id}` : ''
        this.$http[metodo](`pedidos${finalUrl}` ,this.pedidos).then(() => this.limpar() )
        this.get()
      },
      get() {
        this.$http.get('pedidos',{}).then(res => 
          this.items = res.data);
      },
      limpar() {
        (this.pedidos.data = ""),
        (this.pedidos.observacao = ""),
        (this.pedidos.forma_pagamento = ""),
        (this.pedidos.cliente_id = ""),
        (this.pedidos.id = null);
      },
      excluir(id) {
        console.log(id);
        this.$http
          .post("pedidos/" + id, { _method: "DELETE" })
          .then(this.get())
          .catch(() => alert('Apague os dados do pedido para poder apagar'))
      },
      editar(id) {    
       
        this.pedidos = this.items.id
        for (let index = 0; index < this.items.length; index++) {
          const element = this.items[index];
          if(id === element.id){
            this.pedidos = element;
          }
        }
      }, 
      report(id) {
        var myHeaders = new Headers();

        myHeaders.append('Content-Type', 'multipart/form-data');
        this.$http.get(`pedidos/${id}/report`, myHeaders).then(response => {
          var blob = new Blob([response.data], {
          type: 'application/pdf'
        });
        var url = window.URL.createObjectURL(blob)
        window.open(url);
            })
        .catch(error => {
            console.log(error);
        });   
      },
      send(id) {
        this.$http.get(`pedidos/${id}/sendmail`,{}).then(res => console.log(res));
      }   
    },   
    created() {
      this.$http.get('pedidos',{}).then(res => 
      this.items = res.data);
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1 {
  margin: 30px 0 0;
  color: #42b983;
}

</style>
