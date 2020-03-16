<template>
<div>
  <b-container>
  <h1>Produtos</h1>
    <b-row >
      <b-col cols="3">
          <b-form-group label="Nome:">
          <b-form-input type="text"  size="lg"
          v-model="produtos.nome"
          placeholder="Informe o nome"></b-form-input>
        </b-form-group>
        <b-form-group label="Cor:">
          <b-form-input type="text"  size="lg"
          v-model="produtos.cor"
          placeholder="Informe o cor"></b-form-input>
        </b-form-group>
        <b-form-group label="Tamanho:">
          <b-form-input type="text"  size="lg"
          v-model="produtos.tamanho"
          placeholder="Informe o tamanho"></b-form-input>
        </b-form-group>
        <b-form-group label="Valor:">
          <b-form-input type="text"  size="lg"
          v-model="produtos.valor"
          placeholder="Informe o valor"></b-form-input>
        </b-form-group>
        <b-button @click="salvar()" block variant="outline-primary">Salvar</b-button>
      </b-col>
      <b-col cols="9"> Mensagem: {{mensagem}}
           <table class="table">
            <thead>          
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Cor</th>
              <th scope="col">Tamanho</th>
              <th scope="col">Valor</th>
              <th scope="col">Ações</th>
            </thead>
            <tbody>
            <tr v-for="item in items" :key="item.id">
              <td>{{item.id}}</td>
              <td>{{item.nome}}</td>
              <td>{{item.cor}}</td>
              <td>{{item.tamanho}}</td>
              <td>{{item.valor}}</td>
              <td><b-button variant="outline-danger py-1 px-md-2" @click="excluir(item.id)">excluir</b-button></td>
              <td><b-button variant="outline-warning py-1 px-md-2" @click="editar(item.id)">editar</b-button></td>
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
    props: ["cliente"],

    data() {
      return { 
        items: [],
        mensagem: '',
        produtos: {
          nome: '',
          cor: '',
          tamanho: '',
          valor: '',
          id: null
        }
      }
    },
    methods: {
      salvar() {
        const metodo =  this.produtos.id ? 'patch' : 'post'
        const finalUrl = this.produtos.id ? `/${this.produtos.id}` : ''
        this.$http[metodo](`produtos${finalUrl}` ,this.produtos).then(() => this.limpar() )
        this.get()
      },
      get() {
        this.$http.get('produtos',{}).then(res => 
          this.items = res.data);
      },
      limpar() {
        (this.produtos.nome = ""),
        (this.produtos.cor = ""),
        (this.produtos.tamanho = ""),
        (this.produtos.valor = ""),
        (this.produtos.id = null);
      },
      excluir(id) {
        console.log(id);
        this.$http
          .post("produtos/" + id, { _method: "DELETE" })
          .then(this.get())
          .catch(() => alert( 'Produto cadastrado em pedido.'))
      },
      editar(id) {    
       
        this.produtos = this.items.id
        for (let index = 0; index < this.items.length; index++) {
          const element = this.items[index];
          if(id === element.id){
            this.produtos = element;
          }
        }
      }    
    },   
    created() {
      this.$http.get('produtos',{}).then(res => 
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
