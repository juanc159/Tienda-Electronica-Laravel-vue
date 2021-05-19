<template>
    <div class="container">
        <form @submit.prevent='modificarPedido(pedido)' v-if="editarActivo">
            <h3>Editar Pedidos</h3>
            Proveedor:
            <select class="form-control mb-3"   v-model="pedido.id_producto">
                <option v-for="(item, index) in productos" :key="index"  :value="item.id">{{item.nombre}}</option>
            </select>
            <input type="text" class="form-control mb-2" placeholder="Cantidad" v-model="pedido.cantidad">
            <input type="text" class="form-control mb-2" placeholder="Nombre del Producto" v-model="pedido.fecha_entrega"> 
            <button class="btn btn-success">Modificar</button>
            <button class="btn btn-danger" @click="cancelarEdicion()">Cancelar</button>
        </form>

        <form @submit.prevent='agregar' v-else >
            <h3>Agregar Pedidos</h3>
            Producto:
            <select class="form-control mb-3"   v-model="pedido.id_producto">
                <option v-for="(item, index) in productos" :key="index"  :value="item.id">{{item.nombre}}</option>
            </select>            
            <input type="text" class="form-control mb-2" placeholder="Cantidad" v-model="pedido.cantidad">
            <input type="date" class="form-control mb-2" placeholder="Fecha del Entrega" v-model="pedido.fecha_entrega">
            
            <button class="btn btn-primary">Agregar</button>
        </form>

        <hr class="mt-3"> 
        <h3>Listado de Pedidos</h3>
        <ul class="list-group my-2">
            <li class="list-group-item" 
            v-for="(item, index) in pedidos" :key="index" >
                <span class="badge badge-primary float-right">{{item.updated_at}}</span>
                Nombre Producto: {{producto_nombre[index]}}  <br>
                Cantidad: {{item.cantidad}}   <br>
                Fecha Entrega: {{item.fecha_entrega}} <br>
                <button class="btn btn-danger btn-sm" @click="eliminarPedido(item, index)">Eliminar</button>
                <button class="btn btn-warning btn-sm" @click="editarPedido(item)">Editar</button>
                
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
                                    console.log(this.producto_nombre);
                                }
                            });
                        });
                    });
                });
            },
            cancelarEdicion(){
                this.editarActivo = true;
            },
            editarPedido(item){
                this.editarActivo = true;
                this.pedido.id_producto = item.id_producto;
                this.pedido.fecha_entrega = item.fecha_entrega;
                this.pedido.cantidad = item.cantidad;
                this.pedido.id = item.id;
                this.listar();
            },
            agregar(){
                if(this.pedido.id_producto === '' || this.pedido.cantidad.trim() === '' ){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const parametros = {
                    id_producto: this.pedido.id_producto,
                    cantidad: this.pedido.cantidad,
                    fecha_entrega: this.pedido.fecha_entrega,
                };
                
                this.pedido.id_producto = '';
                this.pedido.cantidad = '';
                this.pedido.fecha_entrega = '';
                
                axios.post('pedido',parametros)
                    .then(res => {
                        this.pedidos.push(res.data);
                        this.listar();
                    });
            },
            modificarPedido(item){
                console.log(this.pedido.id_producto);
                if(this.pedido.id_producto === '' || this.pedido.cantidad === '' ){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const parametros = {
                    id_producto: this.pedido.id_producto,
                    cantidad: this.pedido.cantidad,
                    fecha_entrega: this.pedido.fecha_entrega,
                };
                axios.put(`/pedido/${item.id}`, parametros)
                    .then(res=>{
                        this.editarActivo = false;
                        //const index = this.productos.findIndex(productoBuscar => productoBuscar.id === res.data.id);
                        //this.productos[index] = res.data;
                        this.pedido.id_producto = '';
                        this.pedido.fecha_entrega = '';
                        this.pedido.cantidad = '';
                        this.pedido.id = '';
                        axios.get('pedido').then(res=>{
                            this.pedidos = res.data;
                            this.listar();
                        })
                    })
            },
            eliminarPedido(item, index){
                axios.delete(`pedido/${item.id}`)
                    .then(res => {
                        this.pedidos.splice(index, 1);
                        this.listar();
                    })
            },
        }
    }
</script>
