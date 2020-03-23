<template>
    
    <div>
        
        <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
            <h1>Cadastro</h1>
			<div class="row">
				<div class="col-md-4">	
                    <b-button variant="outline-primary py-1 px-md-2 " block @click="salvar()" >Salvar</b-button>				 
                    <b-button variant="outline-danger py-1 px-md-2" block @click="voltar()">Cancelar</b-button>
				</div>
				<div class="col-md-8">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Data</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model="data" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Observacao</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="observação..." v-model="observacao">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Forma pagamento</label>
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="forma_pagamento">
                                            <option selected=""> -- Selecione forma de pagamento</option>
                                            <option value="cartao_de_credito">Cartão de credito</option>
                                            <option value="cartao_de_debto">Cartão de debto</option>
                                            <option value="dinheiro">Dinheiro</option>
                                        </select>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Cliente</label>
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="cliente_id" :disabled="cliente_id !== ''">
                                            <option selected="">Escolha o cliente</option>
                                            <option  v-for="cliente in clientes" v-bind:key="cliente.id"  v-bind:value="cliente.id" >
                                                {{ cliente.nome }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <form >
                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Produtos</label>
                                            <select class="form-control" id="exampleFormControlSelect1" v-model="item_produto.produtos_id">
                                                <option selected="">Escolha o cliente</option>
                                                <option v-for="produto in produtos" v-bind:key="produto.id"  v-bind:value="produto.id" >
                                                    {{ produto.nome }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Quantidade</label>
                                            <input type="numeber" class="form-control" id="exampleFormControlInput1" placeholder="Ex.: 1" v-model="item_produto.quantidade">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="exampleFormControlSelect1">Adicionar</label>
                                        <b-button variant="outline-primary py-1 px-md-2 " block @click="adicionar(item_produto)">produto</b-button>
                                    </div>                                    
                                </div>
                            </form>
                        </div>
                    </div>
                   
                    <div class="row" v-if="produto.length > 0">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Produto
                                        </th>
                                        <th>
                                            Quantidade
                                        </th>
                                        <th>
                                            Remover
                                        </th>
                                    </tr>
                                </thead>
                                <tbody >                                    
                                    <tr v-for="item in produto" v-bind:key="item.produtos_id" >
                                        <td>
                                            {{ item.produtos_id }}
                                        </td>
                                        <td>
                                            {{ item.nome }}
                                        </td>
                                        <td>
                                            {{ item.quantidade}}
                                        </td>
                                        <td>
                                            <b-button variant="outline-danger py-1 px-md-2 " block @click="remover(item.produtos_id)" >X</b-button>
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
    </div>
</template>

<script>
export default {
        
  data() {
      return {
          cliente_id: '',
          observacao: '',
          forma_pagamento: '',
          data: '',
          item_produto: [],
          produto: [],
          clientes:[],
          produtos:[],
          pedidos: {},
          ok: false
      }
  },
    methods: {
        adicionar(index) { 
            
            const x = this.produto.find((el) => el.produtos_id === index.produtos_id)
            if (x) {
                this.produto.forEach(element => {
                    if (element.produtos_id === index.produtos_id) {
                        element.quantidade = parseInt(index.quantidade) + parseInt(element.quantidade)                       
                    }
                });
            } else {
                this.produto.push(index);
            }
            this.item_produto = []
        },
        remover(id) {

            this.produto.forEach(element => {
                if (element.produtos_id === id) {
                    element.quantidade = parseInt(element.quantidade) - 1
                    if (element.quantidade === 0) {
                        this.removerItem(element)
                    }
                }
            });
        },
        removerItem(index) {
            this.produto.splice(this.produto.indexOf(index), 1)
        },
        dataAtualFormatada(){
            var data = new Date(),
                dia  = data.getDate().toString(),
                diaF = (dia.length == 1) ? '0'+dia : dia,
                mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
                mesF = (mes.length == 1) ? '0'+mes : mes,
                anoF = data.getFullYear();
            return diaF+"/"+mesF+"/"+anoF;
        },
        salvar() {
            var result = {};
            for (var i = 0; i < this.produto.length; i++) {
                result[this.produto[i].produtos_id] = this.produto[i].quantidade;
            }
            const pedidos = {               
                data: this.dataAtualFormatada(),
                observacao: this.observacao,
                forma_pagamento: this.forma_pagamento,
                cliente: this.cliente_id,
                pedidos: JSON.stringify(result)
            }
        
            
        
            this.$http.post(`pedidos` , pedidos).then(function(res) {
            if (res.status === 200) {
                alert("Pedido cadastrado com sucesso.")
            }

            
            });
            this.produto = [];
            this.cliente_id = '';
            this.forma_pagamento = '';
            this.observacao = '';
        
        }, 
        voltar() {
            window.history.back();
        }
    },   
    created() {
      this.data = this.dataAtualFormatada();
      this.$http.get('clientes',{}).then(res => this.clientes = res.data);
      this.$http.get('produtos',{}).then(res => this.produtos = res.data);
    }

}
</script>

<style scoped>
h1 {
  margin: 30px 0 0;
  color: #42b983;
}
</style>
