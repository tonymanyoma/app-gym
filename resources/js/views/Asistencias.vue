<template>

    <div>

        <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2>ASISTENCIAS</h2>
                </div>

<!-- Hover Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <button type="button" class="btn  waves-effect bg-light-green" data-toggle="modal" data-target="#nuevaAsistencia">
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

                                        <th scope="col">Nombre Cliente</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Jornada</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="asistencia in Asistencias " v-bind:key="asistencia.id">
                                        <td class="td-style">{{asistencia.nombre_completo}}</td>
                                        <td class="td-style">{{asistencia.fecha}}</td>
                                        <td class="td-style">{{asistencia.hora}}</td>
                                        <td class="td-style">{{asistencia.jornada}}</td>

                                        <td>

                                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float waves-light" @click.prevent="deleteAsistencias(asistencia)">
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


        <!-- Modal nueva asistencia -->

        <form  method="POST" v-on:submit.prevent="createAsistencia">

        <div class="modal fade" id="nuevaAsistencia" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Crear asistencia</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                   <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Fecha inicio</b>
                                     <div class="input-group">

                                            <div class="form-line">
                                                <input type="date" class="form-control date" v-model="new_fecha" required >
                                            </div>
                                        </div>
                                     <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                </div>

                                <div class="col-md-6">
                                    <b>Cliente</b>
                                    <div class="input-group">

                                       <v-select  label="nombre_completo" :required="!new_id_cliente" :options="Clientes" :reduce="nombre_completo => nombre_completo.id" v-model="new_id_cliente" ></v-select>
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>

                                </div>

                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" @click.prevent="createAsistencia()" >Guardar</button>
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

            this.getClientes();
            this.getAsistencias();

            this.$emit('update:layout', LayoutDefault);

        },

        data(){

            return{

                loading: true,

                Clientes:[],
                Asistencias:[],
                new_id_cliente:'',
                new_fecha:''
            }

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
                url: 'auth/nombre_clientes',
                method: 'GET'
                }).then(function (response) {

                    me.Clientes = response.data.clientes;
                    me.mytable();

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            getAsistencias(){

                let me = this;

                this.$http({
                url: 'auth/asistencias',
                method: 'GET'
                }).then(function (response) {

                    me.Asistencias = response.data;

                    me.loading= false;
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


            createAsistencia(){

                if( ( this.new_id_cliente == '' ) || ( this.new_fecha == '' )){

                    this.$swal(

                    'Campos vacios',
                    'Debes completar todo el formulario',
                    'error',

                    )

                }else{

                this.loading_Message();

                this.$http({
                url: 'auth/crear_asistencia',
                method: 'POST',
                data: {

                 id_cliente : this.new_id_cliente,
                 fecha: this.new_fecha,

                }

             }).then(response => {

                 this.getAsistencias();


                 $('#nuevaAsistencia').modal('hide');
                if ($('.modal-backdrop').is(':visible')) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                };


                 this.$swal(
                    'Creado',
                    'Asistencia creada con éxito.',
                    'success'
                )


                 this.this.new_id_cliente = '';
                 this.new_fecha = '';

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


        deleteAsistencias(asistencia){

                this.$swal({
                title: 'Está seguro de Eliminar esta Asistencia?',
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
                url: 'auth/eliminar_asistencia',
                method: 'POST',
                data: {

                    id: asistencia.id

                }

                }).then(response => {
                    this.getAsistencias();
                    this.$swal(
                        'Eliminado!',
                        'La Asistencia ha sido Eliminada con éxito.',
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


</style>
