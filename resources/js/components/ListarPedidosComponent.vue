<template>
    <div class="container">
    


        <hr class="mt-3"> 
        <h3>Listado de Pedidos</h3>
        <ul class="list-group my-2">
            <li class="list-group-item" 
            v-for="(item, index) in pedidos" :key="index" >
                <span class="badge badge-primary float-right">{{item.updated_at}}</span>
                Nombre Producto: {{producto_nombre[index]}}  <br>
                Cantidad: {{item.cantidad}}   <br>
                Fecha Entrega: {{item.fecha_entrega}} <br>
                
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editarActivo: false,
                pedidos: [],
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
        }
    }
</script>
