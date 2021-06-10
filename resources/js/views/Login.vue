<template>

    <div>

    <div class="login-page">

    <div class="login-box">
        <div class="logo">
            <center><img src='images/ferraros-logo.png' width="120px" ></center>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Inicio de sesión</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="username" placeholder="Email" required autofocus v-model="email">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Contraseña" required v-model="password">
                        </div>
                    </div>


                            <button class="btn btn-block bg-pink waves-effect" type="submit" @click.prevent="login()">INICIAR SESIÓN</button>

                        <br><br>

                        <center><router-link :to="{name: 'register'}"> <a href="sign-up.html">Registrate ahora!</a> </router-link></center>
                </form>
            </div>
        </div>
    </div>

    </div>


    <!-- The Modal Loading -->


                <div class="modal fade" id="load" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

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

        created: function(){



        },

    data() {
      return {

        email: null,
        password: null,


      }
    },


    methods:{



        login() {


          if( (this.email == '') || ( this.password== '' ) ){

                    this.$swal(

                    'Campos vacios',
                    'Debes completar todo el formulario',
                    'error',

                    )

          }else{

         $("#load").modal("show");
         const authUser = {}

        var redirect = this.$auth.redirect()
        var app = this

        this.$auth.login({
          data: {
            email: app.email,
            password: app.password
          },
          success: function(res) {


            authUser.data = this.$auth.user();

            console.log(authUser);

            $("#load").modal("hide");

            app.success = true

            window.localStorage.setItem('lbUser',JSON.stringify(authUser));


                const redirectTo = 'clientes'
                this.$router.push({name: redirectTo})



          },

          error: function(res) {
            app.has_error = true
            app.error = res.response.data.error

            $("#load").modal("hide");

            if(res.response.data.code == 1){
                    this.$swal({
                    type: 'error',
                    title: 'El correo ingresado no se encuentra registrado',
                    text: 'Por favor verifica los datos',
                    })
                }

            if(res.response.data.code == 2){
                    this.$swal({
                    type: 'error',
                    title: 'Email o contraseña incorrectos',
                    text: 'Por favor verifica los datos',
                    })
                }




          },
          rememberMe: true,
          fetchUser: true
        })

          }


      },
    }






    }


</script>


<style>


</style>
