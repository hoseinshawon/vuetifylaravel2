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
                    <h1 class="h4 text-gray-900 mb-4">Password Reset Form</h1>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="email" v-model="user.email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" v-model="user.password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <input type="password" v-model="user.password_confirmation" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                  </form>

                    <button @click="resetPassword" class="btn btn-primary btn-user btn-block">
                      Reset Password
                    </button>
                    
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

import axios from '../../axios'
import '../../../src/assets/login.scss';

export default {
    name: "ResetPassword",
    data(){
      return {
        user: {
          email: '',
          password: '',
          password_confirmation: ''
        }
      }
    },

    methods: {
      resetPassword(){
        const token = this.$route.query.token;
        axios.post('reset-password', {...this.user, token})
        .then(() => {
            this.$router.push({name: 'login'});
        })
      }

    }
}
</script>


<style scoped>

</style>