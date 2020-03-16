<template>
<div>
  <b-container>
  <h1>Clientes</h1>
    <b-row >
      <b-col cols="3">
          <b-form-group label="Nome:">
          <b-form-input type="text"  size="lg"
          v-model="clientes.nome"
          placeholder="Informe o nome"></b-form-input>
        </b-form-group>
        <b-form-group label="CPF:">
          <b-form-input type="text"  size="lg"
          v-model="clientes.cpf"
          placeholder="Informe o cpf"></b-form-input>
        </b-form-group>
        <b-form-group label="Sexo:">
          <b-form-input type="text"  size="lg"
          v-model="clientes.sexo"
          placeholder="Informe o sexo"></b-form-input>
        </b-form-group>
        <b-form-group label="E-mail:">
          <b-form-input type="text"  size="lg"
          v-model="clientes.email"
          placeholder="Informe o email"></b-form-input>
        </b-form-group>
        <b-button @click="salvar()" block variant="outline-primary">Salvar</b-button>
      </b-col>
      <b-col cols="9"> 
           <table class="table">
            <thead>          
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">CPF</th>
              <th scope="col">Sexo</th>
              <th scope="col">Email</th>
              <th scope="col">Ações</th>
            </thead>
            <tbody>
            <tr v-for="item in items" :key="item.id">
              <td>{{item.id}}</td>
              <td>{{item.nome}}</td>
              <td>{{item.cpf}}</td>
              <td>{{item.sexo}}</td>
              <td>{{item.email}}</td>
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
        clientes: {
          nome: '',
          cpf: '',
          sexo: '',
          email: '',
          id: null
        }
      }
    },
    methods: {
      salvar() {
        const metodo =  this.clientes.id ? 'patch' : 'post'
        const finalUrl = this.clientes.id ? `/${this.clientes.id}` : ''
        this.$http[metodo](`clientes${finalUrl}` ,this.clientes).then(() => this.limpar() )
        this.get()
      },
      get() {
        this.$http.get('clientes',{}).then(res => 
          this.items = res.data);
      },
      limpar() {
        (this.clientes.nome = ""),
        (this.clientes.cpf = ""),
        (this.clientes.email = ""),
        (this.clientes.sexo = ""),
        (this.clientes.id = null);
      },
      excluir(id) {
        console.log(id);
        this.$http
          .post("clientes/" + id, { _method: "delete" })
          .then(res => console.log(res));
      },
      editar(id) {    
       
        this.clientes = this.items.id
        for (let index = 0; index < this.items.length; index++) {
          const element = this.items[index];
          if(id === element.id){
            this.clientes = element;
          }
        }
      }    
    },   
    created() {
      this.$http.get('clientes',{}).then(res => 
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
