<template>
    <div class="container">
        

        <hr>
        <form >
            <h3>Buscar Pedidos por fecha</h3>
            <input type="date" class="form-control mb-2" placeholder="Id Pedido" v-model="id" name="id" @change="buscarFecha(id,'fecha_entrega')">
            
        </form>

<div v-if="lista!=''">
        <hr class="mt-3"> 
        <h3 > {{lista.length}} Pedidos con fecha: {{id}}</h3>
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
            <div class="alert alert-danger" role="alert" v-if="noresultado">No existen Resultados con Fecha de Entrega: {{id}}</div>
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
                console.log(this.id);
                this.lista =[];
                axios.get('pedido/buscarFecha/'+i+'/'+b).then(res=>{
                    this.lista =res.data;
                    this.noresultado =false;
                    if(this.lista ==''){
                        this.noresultado =true;}
                    //this.pedido = res.data;
                    //console.log(this.lista);
                    
                }).catch(error =>{
                    
                });
            },            
        }
    }
</script>
