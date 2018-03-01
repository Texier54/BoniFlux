<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>

export default {
  name: 'app',
  components : {

  },
  mounted() {
    if(!this.$store.state.member) {
      this.$router.push({path: '/'});
    }

  }
}
</script>

<style>
</style>
