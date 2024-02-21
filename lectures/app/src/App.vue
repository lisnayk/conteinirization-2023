<script setup>
import HelloWorld from './components/HelloWorld.vue'
import TheWelcome from './components/TheWelcome.vue'
// const webauth = require('webauth');
var reqOptions = {
        host: 'localhost',
        headers: {
            'accept-encoding' : 'gzip,deflate,sdch'
        }
    },
    credentials = {
        username: 'Munspel',
        password: 'myPassword',
        domain: 'localhost',
        workstation: 'CHURKIN-LINUX'
    };
const handleAuth = ()=> {
    console.log("Test")
    // webauth.auth(reqOptions, credentials, function (res) {
    //     console.log(res.statusCode);
    // });
}
</script>

<template>
  <header>
    <img alt="Vue logo" class="logo" src="./assets/logo.svg" width="125" height="125" />

    <div class="wrapper">
      <HelloWorld msg="You did it!" />
      <button @click="handleAuth">Auth</button>
    </div>
  </header>

  <main>
    <TheWelcome />
  </main>
</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
