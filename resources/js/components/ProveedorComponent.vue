<template>
    <div class="container">
        <form @submit.prevent='modificarProveedor(proveedor)' v-if="editarActivo">
            <h3>Editar Producto</h3>
            <input type="text" class="form-control mb-2" placeholder="Nombre del Producto" v-model="proveedor.nombre">
            <input type="text" class="form-control mb-2" placeholder="descripcion del Producto" v-model="proveedor.descripcion"> 
            <button class="btn btn-success">Modificar</button>
            <button class="btn btn-danger" @click="cancelarEdicion()">Cancelar</button>
        </form>

        <form @submit.prevent='agregar' v-else>
            <h3>Agregar Proveedores</h3>
            <input type="text" class="form-control mb-2" placeholder="Nombre del Proveedor" v-model="proveedor.nombre">
            <input type="text" class="form-control mb-2" placeholder="descripcion del Proveedor" v-model="proveedor.descripcion"> 
            <button class="btn btn-primary">Agregar</button>
        </form>

        <hr class="mt-3"> 
        <h3>Listado de Proveedores</h3>
        <ul class="list-group my-2">
            <li class="list-group-item" 
            v-for="(item, index) in proveedores" :key="index" >
                <span class="badge badge-primary float-right">{{item.updated_at}}</span>
                {{item.nombre}}   <br>
                {{item.descripcion}}   <br>
                <button class="btn btn-danger btn-sm" @click="eliminarProveedor(item, index)">Eliminar</button>
                <button class="btn btn-warning btn-sm" @click="editarProveedor(item)">Editar</button>
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
                proveedor: {
                    nombre: '',
                    descripcion: ''
                }
            }
        },
        created(){
            axios.get('proveedor').then(res=>{
                this.proveedores = res.data;
            })
        },
        methods:{
            cancelarEdicion(){
                this.editarActivo = true;
            },
            editarProveedor(item){
                this.editarActivo = true;
                this.proveedor.nombre = item.nombre;
                this.proveedor.descripcion = item.descripcion;
                this.proveedor.id = item.id;
            },
            agregar(){
                if(this.proveedor.nombre.trim() === '' || this.proveedor.descripcion.trim() === ''){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const parametros = {
                    nombre: this.proveedor.nombre,
                    descripcion: this.proveedor.descripcion 
                };
                
                this.proveedor.nombre = '';
                this.proveedor.descripcion = ''; 
                axios.post('proveedor',parametros)
                    .then(res => {
                        this.proveedores.push(res.data);
                    })
            },
            eliminarProveedor(item, index){
                axios.delete(`proveedor/${item.id}`)
                    .then(res => {
                        this.proveedores.splice(index, 1);
                    })
            },
            modificarProveedor(item){
                const parametros = {
                    nombre: this.proveedor.nombre,
                    descripcion: this.proveedor.descripcion
                };
                axios.put(`/proveedor/${item.id}`, parametros)
                    .then(res=>{
                        this.editarActivo = false;
                        //const index = this.proveedores.findIndex(productoBuscar => productoBuscar.id === res.data.id);
                        //this.proveedores[index] = res.data;
                        this.proveedor.nombre = '';
                        this.proveedor.descripcion = '';
                        axios.get('proveedor').then(res=>{
                            this.proveedores = res.data;
                        })
                    })
            }
        }
    }
</script>
