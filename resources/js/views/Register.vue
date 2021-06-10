<template>

    <div>

    <div class="signup-page">

    <div class="signup-box">
        <div class="logo">
            <center><img src='images/ferraros-logo.png' width="120px"></center>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST">
                    <div class="msg">Registro de administrador</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="namesurname" placeholder="Nombre completo" required autofocus v-model="nombre_completo">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email " required v-model="email">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" placeholder="Contraseña" required v-model="password">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirmar contraseña" required v-model="password_confirmation">
                        </div>
                    </div>


                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" @click.prevent="register()">CREAR CUENTA</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <router-link :to="{name: 'login'}"><a href="sign-in.html">Ya tienes una cuenta? inicia sesión</a></router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>


    <!-- The Modal Loading -->
                <div class="modal fade" tabindex="-1" id="load" aria-hidden="true">
                    <div class="modal-dialog  modal-md modal-dialog-centered" >
                        <div class="modal-content">

                        <!-- Modal body -->
                        <div class="modal-body">
                            <img src="images/spinner.gif" >
                            <label>Cargando...</label>
                        </div>

                        </div>
                    </div>
                </div>

    </div>


</template>


<script>

    export default {
    data() {
      return {

        email: '',
        password: '',
        password_confirmation: "",
        numero_documento: "",
        nombre_completo: "",


      }
    },


    methods:{

        register() {

            if( (this.email == '') || ( this.password== '' ) || ( this.password_confirmation == '' ) || ( this.nombre_completo == '' )){

                    this.$swal(

                    'Campos vacios',
                    'Debes completar todo el formulario',
                    'error',

                    )

                }else{

         this.$swal({
                title: "Cargando!",
                text: "Espere un momento por favor..",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "images/spinner.gif",
                onOpen: () => {
                    swal.showLoading();
                }
            });


        var app = this;
      this.$auth.register({
        data: {

          nombre_completo: app.nombre_completo,

          email: app.email,
          password: app.password,
          password_confirmation: app.password_confirmation,
          id_role: 1,
        },
        success: function() {


          app.success = true;
          this.$router.push({
            name: "login",
            params: { successRegistrationRedirect: true }
          });

            this.$swal(
            "Creada",
            "Cuenta creada con éxito.",
            "success"
          );


        },
        error: function(res) {
          // console.log(res.response.data.errors)
          app.has_error = true;
          app.error = res.response.data.error;
          if(res.response.data.code == 1){
                    this.$swal({
                    type: 'error',
                    title: 'Este correo ya se encuentra registrado',
                    text: 'Por favor verifica los datos',
                    })
                }
        }
      });

      }

      },
    }






    }


</script>


<style>


</style>
