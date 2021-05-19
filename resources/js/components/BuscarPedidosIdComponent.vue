<template>
    <div class="container">
        <form >
            <h3>Buscar Pedidos por id</h3>
            <input type="text" class="form-control mb-2" placeholder="Id Pedido" v-model="id" name="id" @change="buscarFecha(id,'id')" >
            
            <button type="button" class="btn btn-primary" @click="buscarFecha(id,'id')">Buscar</button>
        </form>

        <hr>
        
<div v-if="lista!=''">
        <hr class="mt-3"> 
        <h3> Pedidos con ID {{id}}</h3>
        <ul class="list-group my-2">
            
            <li class="list-group-item" 
            v-for="(item, index) in lista" :key="index" >
                <span v-if="item.cantidad <=0" class="badge badge-danger float-right">Debe ser abastecido por el Proveedor</span>
                <span class="badge badge-primary float-right">{{item.updated_at}}</span>
                Nombre Producto: {{item.nombre_producto}}  <br>
                Cantidad: {{item.cantidad}}   <br>
                Fecha Entrega: {{item.fecha_entrega}} <br>
                
            </li>
            
        </ul>
        </div>
            <div class="alert alert-danger" role="alert" v-if="noresultado"><li>No existen Resultados con el ID {{id}}</li></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                noresultado: false,
                pedidos: [],
                lista: [],
                id: '',
                productos: [],
                producto_nombre:[],
                pedido: {
                    id: '',
                    id_producto: '',
                    cantidad: '',
                    fecha_entrega: ''                    
                }
            }
        },
        created(){
            console.log(this.pedidos);
            console.log(this.id);
            this.listar();
            
        },
        methods:{
            listar(){
                axios.get('pedido').then(res=>{
                this.pedidos = res.data;

                    axios.get('producto').then(res=>{
                        this.productos = res.data;
                        this.producto_nombre = [];
                        this.pedidos.forEach(element1 => {
                            //console.log(element1.id_producto);
                            this.productos.forEach(element => {
                                //console.log(element.id);
                                //console.log(element1.id_producto);
                                if(element1.id_producto===element.id){
                                    this.producto_nombre.push(element.nombre);
                                    //console.log(this.producto_nombre);
                                }
                            });
                        });
                    });
                });
            },   
            buscarFecha(i,b){
                this.lista =[];
                axios.get('pedido/buscarFecha/'+i+'/'+b).then(res=>{
                    this.lista =res.data;
                    this.noresultado =false;
                    if(this.lista ==''){
                        this.noresultado =true;}
                    
                }).catch(error =>{
                    
                });
            },            
        }
    }
</script>
