<template>
  <div class="columns is-multiline end">
    <div class="column is-size-5 is-capitalized has-text-centered data">
      Test
    </div>
    <div class="column is-size-5 is-uppercase has-text-centered data">
      Nancy
    </div>
    <div class="column is-size-5 has-text-centered data">
      15/08/18
    </div>
    <div class="column is-size-5 has-text-centered data">
      18
    </div>
    <div class="column is-size-5 has-text-centered data">
      <a class="button is-success">Regarder</a>
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