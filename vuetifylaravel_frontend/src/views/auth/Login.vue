<template>


<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="email" v-model="user.email" name="email" required class="form-control form-control-user" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" v-model="user.password" name="password" required class="form-control form-control-user" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                  </form>

                    <button @click="loginUser" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>

                    <hr>
                    <button href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </button>
                    <button href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </button>

                  <hr>
                  <div class="text-center">
                    <a class="small"><router-link :to="{name: 'forgotPassword'}">Forgot Password?</router-link></a>
                  </div>
                  <div class="text-center">
                    <a class="small"><router-link :to="{name: 'register'}">Create an Account!</router-link></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</body>


</template>


<script>

import '../../../src/assets/login.scss';

import axios from '../../axios'

export default {
    name: "Login",
    data(){
      return {
        user: {
          email: '',
          password: ''
        }
      }
    },

    methods: {


      loginUser(){
        //if(this.$refs.loginForm.validate()){

          return new Promise((resolve, reject) => {
            axios.post('login', this.user)
            .then((response) => {
                if(response.data.access_token){
                    localStorage.setItem('token', response.data.access_token);
                    this.$router.push({name: 'dashboard'});
                    resolve(response);
                }
                //else{
                    //reject(response);
                //}
            })
            .catch((error) => {
                reject(error);
            })
        })

        //}
      }

    }
}

</script>


<style scoped>

</style>