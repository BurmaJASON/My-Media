<template>
  <div>
    <!-- <div class="d-flex justify-content-center pt-3 ">
      <p class="btn bg-primary mr-3" @click="home">Home Page</p>
      <p class="btn bg-dark" @click="login">Login</p>
    </div> -->
    <div class="container col-md-4 card shadow p-4 my-5">
      <form>
        <legend class="text-center border-bottom ">Login Form</legend>
        <div class="alert alert-danger" role="alert" v-if="userStatus">
          The Credential Do Not Match !
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="userData.email">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" v-model="userData.password" @keyup.enter="accountLogin">
        </div>
        <div class="d-flex justify-content-center">
          <button type="button"  class="btn bg-secondary mt-1" @click="accountLogin">Login</button>
        </div>
        <div class="d-flex justify-content-center">
          <u style="cursor: pointer;" @click="home" v-if="!tokenStatus" class="text-secondary mt-3">Click Here to return Home.</u>
        </div>

      </form>
    </div>
  </div>
  

</template>

<script src="../js/login.js"></script>