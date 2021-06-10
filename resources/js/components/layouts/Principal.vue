<template>

<div>

         <!-- Top Bar -->
    <nav class="navbar bg-naranja">
        <div class="container-fluid">
            <div class="navbar-header ">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">FERRAROS GYM</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" @click.prevent="Logout()">
                            <i class="material-icons">assignment_return</i>

                        </a>

                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->

                    <!-- #END# Tasks -->
                </ul>
            </div>
        </div>
    </nav>

        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-text="this.$auth.user().nombre_completo"></div>
                    <div class="email" v-text="this.$auth.user().email"></div>
                    <div class="btn-group user-helper-dropdown">

                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU PRINCIPAL</li>

                    <li class="active" v-show="false">
                        <router-link :to="{name: 'dashboard'}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </router-link>
                    </li>
                    <li>
                         <router-link :to="{name: 'clientes'}">
                            <i class="material-icons">person</i>
                            <span>Clientes</span>
                         </router-link>
                    </li>
                    <li>
                         <router-link :to="{name: 'membresias'}">
                            <i class="material-icons">chrome_reader_mode</i>
                            <span>Membresias</span>
                         </router-link>
                    </li>
                    <li>
                         <router-link :to="{name: 'asistencias'}">
                            <i class="material-icons">people</i>
                            <span>Asistencias</span>
                         </router-link>
                    </li>
                    <li>
                         <router-link :to="{name: 'reportes'}">
                            <i class="material-icons">chrome_reader_mode</i>
                            <span>Reportes</span>
                         </router-link>
                    </li>


                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2020 <a href="javascript:void(0);">Ferraros gym</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->

        <router-view></router-view>


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

  export default{

        created: function(){

            var me = this;

            this.membresias_vencidas();

            setInterval(function(){

            me.membresias_vencidas();

            }, 14400000);

        },

        data(){

            return{

                loading: true,
                m_vencida:0

            }
        },


        info_membresias(){

        this.$swal.mixin({

            showCancelButton: true,
            cancelButtonColor: '#ff6000',
            progressstepsColor: '#7f82eb',
            progressSteps: ['1']
            }).queue([
            {
                title: 'Membresias vencidas',
                imageUrl: "images/warning.png",
                imageWidth: 300,
                imageHeight: 212,
                imageAlt: 'Custom image',
                text: 'Revisa el módulo de membresias :)'
            },

            ]).then((result) => {
            if (result.value) {
                const answers = JSON.stringify(result.value)
                Swal.fire({
                title: 'All done!',
                html: `
                    Your answers:
                    <pre><code>${answers}</code></pre>
                `,
                confirmButtonText: 'Lovely!'
                })
            }
            })


        },


        methods:{

            info_membresias(){

       this.$swal.mixin({



        showCancelButton: true,
        cancelButtonColor: '#ff6000',
        progressstepsColor: '#7f82eb',
        progressSteps: ['1']
        }).queue([
        {
             title: 'Membresias vencidas',
             imageUrl: "images/warning.png",
             imageWidth: 300,
             imageHeight: 212,
             imageAlt: 'Custom image',
             text: 'Revisa el módulo de membresias :)'
        },

        ]).then((result) => {
        if (result.value) {
            const answers = JSON.stringify(result.value)
            Swal.fire({
            title: 'All done!',
            html: `
                Your answers:
                <pre><code>${answers}</code></pre>
            `,
            confirmButtonText: 'Lovely!'
            })
        }
        })


        },

            membresias_vencidas(){


            let me = this;

                this.$http({
                url: 'membresias_vencidas',
                method: 'GET'
                }).then(function (response) {

                    var m_vencida = response.data;

                    if(m_vencida == 1){
                        me.info_membresias();
                    }

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });


        },


      onLogout() {
      this.isConnected = false;
    },

             Logout(){

            $("#load").modal("show");

            var redirect = this.$auth.redirect()
            var app = this

            this.onLogout();

            this.$auth.logout({
                makeRequest: true,
                params: {}, // data: {} in axios
                success: function () {

                    $("#load").modal("hide");
                    app.success = true
                    //const redirectTo = 'login'
                    //this.$router.push({name: redirectTo})
                    window.location = '/login';
                },
                error: function () {

                    app.has_error = true
                    app.error = res.response.data.error

                },

            });

        },

        }
    }



</script>
