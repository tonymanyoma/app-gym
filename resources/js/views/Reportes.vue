<template>

    <div>

        <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>REPORTES</h2>
            </div>



        <div class="row clearfix">

                <div class="col-xs-12 col-sm-3" >
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="images/card.jpg" alt="AdminBSB - Profile Image" />
                            </div>
                            <div class="content-area">
                                <h3></h3>
                                <p></p>
                                <h4 class="">Reporte de membresias</h4>

                            </div>
                        </div>
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>Fecha </span>
                                    <div class="form-line">
                                                <input type="date" class="form-control date" v-model="fecha_membresia" >
                                            </div>
                                </li>
                                <li>
                                    <span>Cliente</span>

                                       <v-select  label="nombre_completo" :required="id_usuario" :options="Clientes" :reduce="nombre_completo => nombre_completo.id" v-model="id_usuario" ></v-select>

                                </li>
                                <li></li>

                            </ul>
                            <div class="row">

                                <div class="col-md-4">
                                    <button type="button" class="btn bg-light-green waves-effect" @click.prevent="reporte_membresia()">
                                        <i class="material-icons">local_printshop</i>
                                        <span>Generar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-xs-12 col-sm-3" >
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="images/asistencia.jpg" alt="AdminBSB - Profile Image" />
                            </div>
                            <div class="content-area">
                                <h3></h3>
                                <p></p>
                                <h4 class="">Reporte de asistencias</h4>

                            </div>
                        </div>
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>Fecha </span>
                                    <div class="form-line">
                                                <input type="date" class="form-control date" v-model="fecha_asistencia" >
                                            </div>
                                </li>

                                <li></li>

                            </ul>
                            <div class="row">

                                <div class="col-md-4">
                                    <button type="button" class="btn bg-light-green waves-effect" @click.prevent="reporte_asistencia()">
                                        <i class="material-icons">local_printshop</i>
                                        <span>Generar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div>


        </div>

        </section>




    </div>

</template>

<script>

    import LayoutDefault from '../components/layouts/Principal.vue';

    export default {

        created: function(){

            this.getClientes();


            this.$emit('update:layout', LayoutDefault);

        },


        data(){
            return{

                loading: true,

                textSearch:'',

                Clientes:[],
                id_usuario:0,
                fecha_membresia:0,
                fecha_asistencia:0



            }
        },

        methods:{

            getClientes(){

               let me = this;

                this.$http({
                url: 'auth/nombre_clientes',
                method: 'GET'
                }).then(function (response) {

                    me.Clientes = response.data.clientes;
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

            reporte_asistencia(){

                if( this.fecha_asistencia == 0){

                    this.$swal(

                    'Campo vacio',
                    'Debes seleccionar una fecha',
                    'error',

                    )

                }else{

                this.loading_Message();

                this.$http({
                url: 'auth/reporte_asistencia',
                method: 'POST',
                data: {

                    fecha_asistencia : this.fecha_asistencia,


                },
                responseType: 'blob', // important
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'reporte_asistencia.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Reporte Generado con éxito.',
                        'success'
                    )
                });

                this.fecha_asistencia = '';

                }


            },


            reporte_membresia(){

                if( this.fecha_membresia == 0 && this.id_usuario == 0){

                    this.$swal(

                    'Campos vacios',
                    'Debes seleccionar una de las opciones',
                    'error',

                    )

                }else{

                this.loading_Message();

                this.$http({
                url: 'auth/reporte_membresia',
                method: 'POST',
                data: {

                    fecha_membresia : this.fecha_membresia,
                    id_cliente : this.id_usuario,


                },
                responseType: 'blob', // important
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'reporte_membresia.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Reporte Generado con éxito.',
                        'success'
                    )
                });

                this.fecha_membresia = '';
                this.id_usuario = '';


                }


            }

        }

    }


</script>

<style>


</style>
