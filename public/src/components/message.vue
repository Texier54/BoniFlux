<template>
  <p>{{ message.pseudo }} : {{ message.texte }}</p>
</template>

<script>

export default {
  props: ['message'],
  name: 'message',
  data () {
    return {
      user: {}
    }
  },
  mounted(){
    window.axios.get('user/'+this.message.id_user).then((res) => {
        this.message.pseudo = res.data.pseudo
      }).catch((error) => {
        alert(error);
      });
  }
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
