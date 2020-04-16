<template>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user">

                <div class="form-group">
                  <input type="text" v-model="newUser.name" name="name" class="form-control form-control-user" id="exampleName" placeholder="Full Name">
                </div>

                <div class="form-group">
                  <input type="email" v-model="newUser.email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                </div>

                <div class="form-group">
                  <input type="password" v-model="newUser.password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                </div>

              </form>

                <button @click="registerUser" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
                <hr>
                <button href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </button>
                <button href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </button>

              <hr>
              <div class="text-center">
                <a class="small"><router-link :to="{name: 'forgotPassword'}">Forgot Password?</router-link></a>
              </div>
              <div class="text-center">
                <a class="small"><router-link :to="{name: 'login'}">Already have an account? Login!</router-link></a>
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
    name: "Register",
    data(){
        return {
            newUser: {
                email: '',
                name: '',
                password: ''
            }
        }
    },
    methods: {
        registerUser(){
            //if(this.$refs.registerForm.validate()){
                axios.post('register', this.newUser)
                .then((response) => {
                  if(response.data && response.data.success){
                    this.$router.push({
                      name: 'login'
                    })
                  }
                });
            //}
        }
    }
}

</script>

<style scoped>

</style>