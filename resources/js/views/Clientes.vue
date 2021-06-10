<template>
    <div>

        <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>CLIENTES</h2>
            </div>

    <!-- Hover Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <button type="button" class="btn  waves-effect bg-light-green" data-toggle="modal" data-target="#nuevoCliente">
                                    <i class="material-icons">person_add</i>
                                    <span>NUEVO</span>
                            </button>
                            <ul class="header-dropdown m-r--5">

                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover" id="example">
                                <thead class="bg-naranja">
                                    <tr>
                                        <th scope="col">Tipo Documento</th>
                                        <th scope="col">Número Documento</th>
                                        <th scope="col">Nombre Completo</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Dirección</th>
                                        <th scope="col">Edad</th>
                                        <th scope="col">Sexo</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cliente in Clientes " v-bind:key="cliente.id">
                                        <td class="td-style" v-if="cliente.tipo_documento == null">NA</td>
                                        <td class="td-style" v-else>{{cliente.tipo_documento}}</td>
                                        <td class="td-style" v-if="cliente.numero_documento == null">NA</td>
                                        <td class="td-style" v-else>{{cliente.numero_documento}}</td>
                                        <td class="td-style">{{cliente.nombre_completo}}</td>
                                        <td class="td-style">{{cliente.telefono}}</td>
                                        <td class="td-style">{{cliente.direccion}}</td>
                                        <td class="td-style" >{{ year - cliente.year_nacimiento}} </td>
                                        <td class="td-style" v-if="cliente.sexo == 0">Masculino</td>
                                        <td class="td-style" v-else>Femenino</td>

                                        <td>
                                            <button type="button" class="btn bg-amber btn-circle waves-effect waves-circle waves-float waves-light" @click.prevent="editClientes(cliente)">
                                                <i class="material-icons">edit</i>
                                            </button> &nbsp;
                                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float waves-light" @click.prevent="deleteClientes(cliente)">
                                                <i class="material-icons">delete_forever</i>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <spinner v-show="loading"></spinner>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        </section>

        <!-- Modal nuevo cliente -->

     <form  method="POST" v-on:submit.prevent="createClientes">

        <div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Crear cliente</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <b>Tipo documento</b>
                                    <div class="input-group">

                                       <v-select label="nombre"   :required="!new_id_tipo_documento" :options="arraydocumentos" :reduce="nombre => nombre.id" v-model="new_id_tipo_documento" ></v-select>
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <b>Número documento</b>
                                    <div class="input-group">

                                        <div class="form-line">
                                            <input type="text" class="form-control date" v-model="new_numero_documento" >
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment_ind</i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Nombre completo</b>
                                    <div class="input-group">

                                        <div class="form-line">
                                            <input type="text" class="form-control date" v-model="new_nombre_completo" required>
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                </div>
                            </div>

                            <div class="row clearfix">

                                <div class="col-md-4">
                                    <validation-provider rules="positive|required|numeric" v-slot="{ errors }">
                                    <b>Teléfono</b>
                                    <div class="input-group">

                                        <div class="form-line">
                                            <input type="text" class="form-control date" v-model="new_telefono" required>
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                    </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                </div>
                                <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Dirección</b>
                                    <div class="input-group">

                                        <div class="form-line">
                                            <input type="text" class="form-control date" v-model="new_direccion" required>
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">place</i>
                                        </span>
                                    </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                </div>
                                <div class="body">

                                <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Sexo</b>
                                    <div class="input-group">

                                    <select class="form-control show-tick" v-model="new_sexo" required>
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="0">Masculino</option>
                                        <option value="1">Femenino</option>
                                    </select>
                                    <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>

                                </div>
                                </div>
                            </div>

                             <div class="row clearfix">
                                <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Fecha nacimiento</b>
                                     <div class="input-group">

                                            <div class="form-line">
                                                <input type="date" class="form-control date" v-model="new_fecha_nacimiento" placeholder="Fecha Nacimiento" required>
                                            </div>
                                        </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                </div>
                             </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect"  @click.prevent="createClientes()" >Guardar</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
     </form>

             <!-- Modal editar cliente -->

      <form  method="POST" v-on:submit.prevent="updateClientes">

        <div class="modal fade" id="editCliente" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Editar cliente</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <b>Tipo documento</b>
                                    <div class="input-group">

                                       <v-select label="nombre"   :required="!fillclientes.id_tipo_documento" :options="arraydocumentos" :reduce="nombre => nombre.id" v-model="fillclientes.id_tipo_documento" ></v-select>
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <b>Número documento</b>
                                    <div class="input-group">

                                        <div class="form-line">
                                            <input type="text" class="form-control date" v-model="fillclientes.numero_documento" >
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment_ind</i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Nombre completo</b>
                                    <div class="input-group">

                                        <div class="form-line">
                                            <input type="text" class="form-control date" v-model="fillclientes.nombre_completo" required>
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <validation-provider rules="positive|required|numeric" v-slot="{ errors }">
                                    <b>Teléfono</b>
                                    <div class="input-group">

                                        <div class="form-line">
                                            <input type="text" class="form-control date" v-model="fillclientes.telefono" placeholder="Teléfono" required>
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                    </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                </div>
                                <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Dirección</b>
                                    <div class="input-group">

                                        <div class="form-line">
                                            <input type="text" class="form-control date" v-model="fillclientes.direccion" required>
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">place</i>
                                        </span>
                                    </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                </div>
                                <div class="body">

                                <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Sexo</b>
                                    <div class="input-group">

                                    <select class="form-control show-tick" v-model="fillclientes.sexo" required>
                                        <option value="" selected disabled>Sexo</option>
                                        <option value="0">Masculino</option>
                                        <option value="1">Femenino</option>
                                    </select>
                                    <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>

                                </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect"  @click.prevent="updateClientes()" >Guardar</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

      </form>


    </div>
</template>

<script>

    import LayoutDefault from '../components/layouts/Principal.vue';

    import { ValidationProvider, extend } from 'vee-validate';
    import { required, email } from 'vee-validate/dist/rules';
    import { numeric } from 'vee-validate/dist/rules';

    export default {

        created: function(){

            extend('positive', value => {
            return value >= 0;

            });

            extend('numeric', {
            ...required,
            message: 'Ingrese solo numeros'
            });

            extend('required', {
            ...required,
            message: 'Este campo es obligatorio'
            });

            const moment = require('moment');
            this.year = moment(new Date()).local().format('YYYY');

            this.getClientes();
            this.select_tipo_documento();

            this.$emit('update:layout', LayoutDefault);

        },

        data(){
            return{

                loading: true,
                errors: {},

                Clientes:[],
                arraydocumentos:[],
                new_id_tipo_documento:'',
                new_numero_documento:'',
                new_nombre_completo:'',
                new_telefono:'',
                new_direccion:'',
                new_sexo:'',
                new_edad:'',
                new_fecha_nacimiento:'',
                year:'',
                fillclientes:{'id': '', 'numero_documento': '', 'nombre_completo': '', 'telefono': '', 'direccion': '','fecha_nacimiento': '','id_tipo_documento':'','sexo':''},


            }
        },

        computed:{


        },

        methods:{

            mytable(){
                setTimeout(function(){
                    if(!$.fn.DataTable.isDataTable('#example')){
                        $('#example').DataTable({
                        bFilter: true,
                        bInfo: false,
                        scrollX: false,
                        scrollCollapse: false,
                        paging: true,
                        pageLength: 10,
                        fixedColumns: true,
                        language: {
                            "lengthMenu": "Mostrar _MENU_ Registros por pagina",
                            "zeroRecords": "No se encuentran acronimos - lo sentimos",
                            "info": "Mostrando la p&aacute;gina _PAGE_ de _PAGES_",
                            "infoEmpty": "No hay registros disponibles",
                            "infoFiltered": "(Filtrado de _MAX_ Total de registros)",
                            "search": "Búscar",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ãšltimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        }
                    });
                    }

                },800);
            },

            getClientes(){

                let me = this;
                this.$http({
                url: 'auth/clientes',
                method: 'GET'
                }).then(function (response) {
                    me.Clientes = response.data;
                    me.loading= false;
                    me.mytable();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            select_tipo_documento(){

                let me = this;
                this.$http({
                url: 'auth/documentos',
                method: 'GET'
                })
                .then((response) => {
                    me.arraydocumentos = response.data.documentos;


                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            loading_Message(){

                this.$swal({
                title: 'Cargando!',
                text: 'Espere un momento por favor..',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "images/spinner.gif",
                onOpen: () => {
                    swal.showLoading()
                }
            });

            },


            createClientes(){

                if( (this.new_nombre_completo == '') || ( this.new_telefono == '' ) || ( this.new_direccion == '' ) || ( this.new_sexo == '' ) || ( this.new_fecha_nacimiento == '' )){

                    this.$swal(

                    'Campos vacios',
                    'Debes completar todo el formulario',
                    'error',

                    )

                }else{

                this.loading_Message();

                this.$http({
                url: 'auth/crear_cliente',
                method: 'POST',
                data: {

                 id_tipo_documento : this.new_id_tipo_documento,
                 numero_documento : this.new_numero_documento,
                 nombre_completo : this.new_nombre_completo,
                 telefono : this.new_telefono,
                 direccion : this.new_direccion,
                 sexo: this.new_sexo,
                 fecha_nacimiento: this.new_fecha_nacimiento,
                 id_role : 2,
                 id_estado: 1,

                }

             }).then(response => {

                 this.getClientes();

                 this.new_id_tipo_documento = '';
                 this.new_numero_documento = '';
                 this.new_nombre_completo = '';
                 this.new_telefono = '';
                 this.new_direccion = '';
                 this.new_sexo = '';
                 this.new_fecha_nacimiento = '';


                 this.errors = [];
                $('#nuevoCliente').modal('hide');
                if ($('.modal-backdrop').is(':visible')) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                };

                this.$swal(
                    'Creado',
                    'Cliente creado con éxito.',
                    'success'
                )
             }).catch(error =>{
                 console.log(error.response.data.code);
                 //this.errors = 'error.response.data'
                if(error.response.data.code == 1){
                    this.$swal({
                    type: 'error',
                    title: 'El correo ingresado ya se encuentra registrado',
                    text: 'Por favor verifica los datos',
                    })
                }if(error.response.data.code == 3)
                    this.$swal({
                    type: 'error',
                    title: 'El documento ya se encuentra registrado',
                    text: 'Por favor verifica los datos',
                    })
             });

                }

        },

          editClientes(cliente){

                this.fillclientes.id = cliente.id;
                this.fillclientes.numero_documento = cliente.numero_documento;
                this.fillclientes.id_tipo_documento = cliente.id_tipo_documento;
                this.fillclientes.nombre_completo = cliente.nombre_completo;
                this.fillclientes.telefono = cliente.telefono;
                this.fillclientes.direccion = cliente.direccion;
                this.fillclientes.fecha_nacimiento = cliente.email;
               // this.fillusuarios.id_role = usuario.id_role;
               // this.fillusuarios.id_estado = usuario.id_estado;
                this.fillclientes.sexo = cliente.sexo;

               // this.fillusuarios.estado = usuario.estado;

                $('#editCliente').modal('show');
            },

             updateClientes(id){


                 if( (this.new_nombre_completo == '') || ( this.new_telefono == '' ) || ( this.new_direccion == '' ) || ( this.new_sexo == '' ) || ( this.new_fecha_nacimiento == '' )){

                    this.$swal(

                    'Campos vacios',
                    'Debes completar todo el formulario',
                    'error',

                    )

                }else{

                this.loading_Message();

                this.$http({
                url: 'auth/actualizar_cliente',
                method: 'POST',
                data: {

                    id: this.fillclientes.id,
                    id_tipo_documento : this.fillclientes.id_tipo_documento,
                    numero_documento : this.fillclientes.numero_documento,
                    nombre_completo : this.fillclientes.nombre_completo,
                    telefono : this.fillclientes.telefono,
                    direccion : this.fillclientes.direccion,

                    sexo: this.fillclientes.sexo,

                }


                }).then(response => {
                    this.getClientes();
                    this.errors = [];

                    $('#editCliente').modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                };
                     this.$swal(
                    'Actualizado',
                    'Cliente actualizado con éxito.',
                    'success'
                )
                }).catch(error =>{
                    this.errors = errors.response.data
                });

                }

            },

        deleteClientes(cliente){

                this.$swal({
                title: 'Está seguro de Eliminar este Cliente?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00BFF3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-info',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {


                this.loading_Message();

                this.$http({
                url: 'auth/eliminar_cliente',
                method: 'POST',
                data: {

                    id: cliente.id

                }

                }).then(response => {
                    this.getClientes();
                    this.$swal(
                        'Eliminado!',
                        'El Cliente ha sido Eliminado con éxito.',
                        'success'
                        )
                })
                .catch(function (error) {
                    console.log(error);
                });
              } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {

                }
            })
        },


        },

        components: {
        ValidationProvider
    },

    }


</script>

<style>

th,td{

    text-align: center;
}


.bg-naranja{

    background-color: #ff6000;
    color: white;
}

</style>
