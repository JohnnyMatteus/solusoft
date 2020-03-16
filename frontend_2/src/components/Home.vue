<template>
  
<b-container class="bv-example-row">
    <b-row>
        <b-col cols="4">            
                <b-card
                    title="Total de clientes"
                    tag="article"
                    class="mb-4"
                >
                  <spam name='spam'>{{totalCliente.length}}</spam>  
                </b-card>
                
                </b-col>
        <b-col cols="4">
            <b-card
                    title="Total de produtos"
                    tag="article"
                    class="mb-4"
                >
                    <spam name="spam">{{totalProdutos.length}}</spam>  
                </b-card>
        </b-col>
        <b-col cols="4">
            <b-card
                    title="Total de Pedidos"
                    tag="article"
                    class="mb-4"
                >
                    <spam name="spam">{{totalPedidos.length}}</spam>  
                </b-card>
        </b-col>
    </b-row>
</b-container>
      
</template>

<script>

export default {
    data() {
        return {
            totalCliente: [],
            totalProdutos: [],
            totalPedidos: []
        }  

    },
    created() {
            this.$http.get('clientes',{}).then(res => 
            this.totalCliente = res.data);
            
            this.$http.get('produtos',{}).then(res => 
            this.totalProdutos = res.data);

            this.$http.get('pedidos',{}).then(res => 
            this.totalPedidos = res.data);
      /*  this.$http.post('clientes' ,{
            nome: 'Marcos',
            cpf: '000.000.000-00',
            sexo: 'Masculino',
            email: 'teste@teste.com'
        }).then(res => console.log(res.data)) */
    }
}
</script>

<style></style>