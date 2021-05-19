<template>
    <div class="container">
        <form @submit.prevent='modificarProducto(producto)' v-if="editarActivo">
            <h3>Editar Producto</h3>
            <input type="text" class="form-control mb-2" placeholder="Nombre del Producto" v-model="producto.nombre">
            <input type="text" class="form-control mb-2" placeholder="Precio del Producto" v-model="producto.precio">
            <input type="text" class="form-control mb-2" placeholder="Cantidad" v-model="producto.cantidad">
            Proveedor:
            <select class="form-control mb-3"   v-model="producto.id_proveedor">
                <option v-for="(item, index) in proveedores" :key="index"  :value="item.id">{{item.nombre}}</option>
            </select>
            
            <button class="btn btn-success">Modificar</button>
            <button class="btn btn-danger" @click="cancelarEdicion()">Cancelar</button>
        </form>

        <form @submit.prevent='agregar' v-else>
            <h3>Agregar Productos</h3>
            <input type="text" class="form-control mb-2" placeholder="Nombre del Producto" v-model="producto.nombre">
            <input type="text" class="form-control mb-2" placeholder="Precio del Producto" v-model="producto.precio">
            <input type="text" class="form-control mb-2" placeholder="Cantidad" v-model="producto.cantidad">
            Proveedor:
            <select class="form-control mb-3"   v-model="producto.id_proveedor">
                <option v-for="(item, index) in proveedores" :key="index"  :value="item.id">{{item.nombre}}</option>
            </select>
            <button class="btn btn-primary">Agregar</button>
        </form>

        <hr class="mt-3"> 
        <h3>Listado de Productos</h3>
        <ul class="list-group my-2">
            <li class="list-group-item" 
            v-for="(item, index) in productos" :key="index" >
                <span class="badge badge-primary float-right">{{item.updated_at}}</span>
                Nombre: {{item.nombre}}   <br>
                Precio: {{item.precio}}   <br>
                Cantidad: {{item.cantidad}} <br>
                Proveedor: {{proveedor_nombre[index]}} <br>
                <button class="btn btn-danger btn-sm" @click="eliminarProducto(item, index)">Eliminar</button>
                <button class="btn btn-warning btn-sm" @click="editarProducto(item)">Editar</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editarActivo: false,
                proveedores: [],
                productos: [],
                proveedor_nombre:[],
                producto: {
                    nombre: '',
                    precio: '',
                    cantidad: '',
                    id_proveedor: ''                    
                }
            }
        },
        created(){
            
            this.listar();
        },
        methods:{
            listar(){
                axios.get('producto').then(res=>{
                this.productos = res.data;

                    axios.get('proveedor').then(res=>{
                        this.proveedores = res.data;
                        this.proveedor_nombre = [];
                        this.productos.forEach(element1 => {
                            //console.log(element1.id_proveedor);
                            this.proveedores.forEach(element => {
                                //console.log(element.id);
                                //console.log(this.proveedor_nombre);
                                if(element1.id_proveedor==element.id){
                                    this.proveedor_nombre.push(element.nombre);
                                    //console.log(this.proveedor_nombre);
                                }
                            });
                        });
                    });
                });
            },
            cancelarEdicion(){
                this.editarActivo = true;
            },
            editarProducto(item){
                this.editarActivo = true;
                this.producto.nombre = item.nombre;
                this.producto.precio = item.precio;
                this.producto.cantidad = item.cantidad;
                this.producto.id = item.id;
                this.producto.id_proveedor = item.id_proveedor;
                this.listar();
            },
            agregar(){
                if(this.producto.nombre.trim() === '' || this.producto.precio.trim() === '' || this.producto.cantidad.trim() === '' || this.producto.id_proveedor === ''){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const parametros = {
                    nombre: this.producto.nombre,
                    precio: this.producto.precio,
                    cantidad: this.producto.cantidad,
                    id_proveedor: this.producto.id_proveedor
                };
                
                this.producto.nombre = '';
                this.producto.precio = '';
                this.producto.cantidad = '';
                this.producto.id_proveedor = '';
                axios.post('producto',parametros)
                    .then(res => {
                        this.productos.push(res.data);
                        this.listar();
                    });
            },
            eliminarProducto(item, index){
                axios.delete(`producto/${item.id}`)
                    .then(res => {
                        this.productos.splice(index, 1);
                    })
            },
            modificarProducto(item){
                if(this.producto.nombre.trim() === '' || this.producto.precio.trim() === '' || this.producto.cantidad.trim() === '' || this.producto.id_proveedor === ''){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const parametros = {
                    nombre: this.producto.nombre,
                    precio: this.producto.precio,
                    cantidad: this.producto.cantidad,
                    id_proveedor: this.producto.id_proveedor
                };
                axios.put(`/producto/${item.id}`, parametros)
                    .then(res=>{
                        this.editarActivo = false;
                        //const index = this.productos.findIndex(productoBuscar => productoBuscar.id === res.data.id);
                        //this.productos[index] = res.data;
                        this.producto.nombre = '';
                        this.producto.precio = '';
                        this.producto.cantidad = '';
                        this.producto.id_proveedor = '';
                        axios.get('producto').then(res=>{
                            this.productos = res.data;
                            this.listar();
                        })
                    })
            }
        }
    }
</script>
