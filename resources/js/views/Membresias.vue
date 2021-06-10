<template>

        <div>

        <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>MEMBRESIAS</h2>
            </div>


        <div class="row clearfix">

            <div class="row">
                <div class="col-md-4">
                    <b>Buscar</b>
                     <div class="input-group">

                      <div class="form-line">
                        <input type="text" class="form-control date" v-model="textSearch" >
                      </div>

                    </div>
                </div>

            </div>

                <div class="col-xs-12 col-sm-3" v-for="membresia in membresiasFilter " v-bind:key="membresia.id">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="images/avatar.png" alt="AdminBSB - Profile Image" />
                            </div>
                            <div class="content-area">
                                <h3>{{membresia.nombre_cliente}}</h3>
                                <p>{{membresia.nombre_plan}}</p>
                                <h4 v-if="membresia.id_estado_membresia == 1" class="color-activo parpadea">Activa</h4>
                                <h4 v-else class="color-inactivo parpadea">Inactiva</h4>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>Fecha inicio</span>
                                    <span>{{membresia.fecha_inicio}}</span>
                                </li>
                                <li>
                                    <span>Fecha fin</span>
                                    <span>{{membresia.fecha_fin}}</span>
                                </li>
                                <li></li>

                            </ul>
                            <div class="row">

                                <div class="col-md-4">
                                    <button type="button" class="btn bg-red waves-effect" @click.prevent="deleteMembresias(membresia)">
                                        <i class="material-icons">cancel</i>
                                        <span>Cancelar</span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn bg-light-green waves-effect" @click.prevent="generarRecibo(membresia)">
                                        <i class="material-icons">local_printshop</i>
                                        <span>Recibo</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <spinner v-show="loading"></spinner>
        </div>


            <button type="button" class="float btn bg-light-green btn-circle-lg waves-effect waves-circle waves-float" data-toggle="modal" data-target="#nuevaMembresia">
                <i class="material-icons">add</i>
            </button>

        </div>

        </section>


        <!-- Modal nueva membresia -->

        <form  method="POST" v-on:submit.prevent="createMembresias()">

        <div class="modal fade" id="nuevaMembresia" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Crear membresia</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                   <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Fecha inicio</b>
                                     <div class="input-group">

                                            <div class="form-line">
                                                <input type="date" class="form-control date" v-model="new_fecha_inicio" required>
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

                          <div class="row clearfix">
                            <div class="col-md-6">
                                    <b>Plan</b>
                                    <div class="input-group">

                                       <v-select label="nombre"   :required="!new_id_plan" :options="Planes" :reduce="nombre => nombre.id" v-model="new_id_plan"  @input="select_valor_plan()" ></v-select>
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>
                            </div>

                            <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                    <b>Valor</b>
                                    <div class="input-group">

                                        <div class="form-line">
                                            <input type="text" class="form-control date" v-model="new_valor" >
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">attach_money</i>
                                        </span>
                                    </div>
                                    <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                </div>
                           </div>





                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" @click.prevent="createMembresias()" >Guardar</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

            <!-- Modal renovar membresia -->

        <div class="modal fade" id="renovarMembresia" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Renovar membresia</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                    <b>Fecha inicio</b>
                                     <div class="input-group">

                                            <div class="form-line">
                                                <input type="date" class="form-control date" v-model="fillmembresias.fecha_fin" >
                                            </div>
                                        </div>
                                </div>

                                <div class="col-md-6">
                                    <b>Cliente</b>
                                    <div class="input-group">

                                       <v-select  label="nombre_completo" disabled :required="!fillmembresias.id_usuario" :options="Clientes" :reduce="nombre_completo => nombre_completo.id" v-model="fillmembresias.id_usuario" ></v-select>
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>

                                </div>

                            </div>

                          <div class="row clearfix">
                            <div class="col-md-6">
                                    <b>Plan</b>
                                    <div class="input-group">

                                       <v-select label="nombre"   :required="!fillmembresias.id_plan" :options="Planes" :reduce="nombre => nombre.id" v-model="fillmembresias.id_plan" ></v-select>
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>
                            </div>
                           </div>





                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" @click.prevent="renovarMembresia()">Renovar</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>


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
            this.getMembresias();
            this.select_tipo_plan();

            this.$emit('update:layout', LayoutDefault);

        },

        data(){
            return{

                loading: true,

                textSearch:'',

                Clientes:[],
                Planes:[],
                Membresias:[],
                new_fecha_inicio:'',
                new_id_cliente:'',
                new_id_plan:'',
                new_valor:'',
                fillmembresias:{'id': '', 'fecha_fin': '', 'id_plan': '', 'id_usuario': ''},


            }
        },

        computed:{

            membresiasFilter: function () {
            var textSearch = this.textSearch;
            return this.Membresias.filter(function (el) {
                return (
                    el.nombre_cliente
                        .toLowerCase()
                        .indexOf(textSearch.toLowerCase()) !== -1
                );
            });
        },



        },

       methods:{

           select_valor_plan(){


                this.new_valor = this.Planes[this.new_id_plan - 1].valor;

           },

           select_tipo_plan(){

               let me = this;

                this.$http({
                url: 'auth/planes',
                method: 'GET'
                })
                .then((response) => {
                    me.Planes = response.data.planes;


                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

           getClientes(){

               let me = this;

                this.$http({
                url: 'auth/nombre_clientes',
                method: 'GET'
                }).then(function (response) {

                    me.Clientes = response.data.clientes;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            getMembresias(){

                let me = this;

                this.$http({
                url: 'auth/membresias',
                method: 'GET'
                }).then(function (response) {

                    me.Membresias = response.data;
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

            generarRecibo(membresia){

                this.loading_Message();

                this.$http({
                url: 'auth/generar_recibo/'+ membresia.id,
                method: 'GET',
                responseType: 'blob', // important
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'recibo.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Recibo Generado con éxito.',
                        'success'
                    )
                });

            },


            editMembresia(membresia){

                this.fillmembresias.id = membresia.id;
                this.fillmembresias.fecha_fin = membresia.fecha_fin;
                this.fillmembresias.id_usuario = membresia.id_usuario;
                this.fillmembresias.id_plan = membresia.id_plan;


                $('#renovarMembresia').modal('show');
            },

            renovarMembresia(id){

                this.loading_Message();

                let me = this;
                let url = 'renovar_membresia'
                axios.post(url, {

                    id: this.fillmembresias.id,
                    fecha_inicio : this.fillmembresias.fecha_fin,
                    id_plan : this.fillmembresias.id_plan,




                }).then(response => {
                    this.getMembresias();
                    this.errors = [];

                    $('#renovarMembresia').modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                };
                     this.$swal(
                    'Renovada',
                    'Membresia renovada con éxito.',
                    'success'
                )
                }).catch(error =>{
                    this.errors = errors.response.data
                });
            },


            createMembresias(){

                if( (this.new_fecha_inicio == '') || ( this.new_id_cliente == '' ) || ( this.new_id_plan == '' ) || ( this.new_valor == '' )){

                    this.$swal(

                    'Campos vacios',
                    'Debes completar todo el formulario',
                    'error',

                    )

                }else{

                this.loading_Message();

                this.$http({
                url: 'auth/crear_membresia',
                method: 'POST',
                data: {

                 fecha_inicio : this.new_fecha_inicio,
                 id_cliente : this.new_id_cliente,
                 id_plan : this.new_id_plan,
                 valor : this.new_valor,
                 id_estado_membresia: 1,
                 id_estado: 1,

                }

             }).then(response => {

                 this.getMembresias();

                 this.new_fecha_inicio = '';
                 this.new_id_cliente = '';
                 this.new_id_plan = '';


                 this.errors = [];
                $('#nuevaMembresia').modal('hide');
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
                    title: 'El cliente ya cuenta con una membresia',
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


        deleteMembresias(membresia){

                this.$swal({
                title: 'Está seguro de Eliminar esta Membresia?',
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
                url: 'auth/eliminar_membresia',
                method: 'POST',
                data: {

                    id: membresia.id

                }

                }).then(response => {
                    this.getMembresias();
                    this.$swal(
                        'Eliminado!',
                        'La membresia ha sido Eliminado con éxito.',
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

.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#0C9;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}

.my-float{
	margin-top:22px;
}


.color-activo{

color: #8BC34A !important;

}

.color-inactivo{

    color: #ad1455;
}


.parpadea {

  animation-name: parpadeo;
  animation-duration: 3s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 3s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

</style>
