<template>
  <div class="column is-3" style="height: 100px;">
    <iframe autoplay="1" src="https://www.youtube.com/embed/yZLRrNFZN50?autoplay=0" style="width: 100%; height: 100%;" frameborder="0" allowfullscreen ></iframe>

    <p>Pseudo</p>

    <div class="column is-size-5 has-text-centered data">
          <router-link class="button is-success" :to="{ name:'diffusion', params : { id : 1 } }">Regarder</router-link>
    </div>

  </div>


</template>

<script>

export default {
  name: 'listeStream',
  data () {
    return {
    }
  },
}
</script>

<style scoped>

.button{
  margin: 10px;
  -webkit-transition-property: color;
  -webkit-transition-duration: 0.5s;
  -moz-transition-property: color;
  -moz-transition-duration: 0.5s;
  transition-property: color;
  transition-duration: 0.5s;
}

.button:hover{
  color: #363636;
}

.columns{
  border-radius: 5px;
  margin-top: 20px;
}

.titre{
  background-color: #DBDBDB;
}

.first{
  border-radius: 5px 0px 0px 5px;
}

.last{
  border-radius: 0px 5px 5px 0px;
}

.marker{
  margin-right: 10px;
}

.end{
  border-bottom: 1px solid black;
}

</style>
