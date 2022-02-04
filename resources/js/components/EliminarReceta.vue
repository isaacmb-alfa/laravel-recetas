<template>
  <input
    class="btn btn-danger mr-1 btn-sm btn-block my-0"
    value="Eliminar ×"
    type="submit"
    @click="eliminarReceta"
  />
</template>

<script>
export default {
  props: ["recetaId"],
  methods: {
    eliminarReceta() {
      //  this.$swal('Hello Vue world!!!');
      this.$swal({
        title: "¿Deseas eliminar esta receta?",
        text: "¡Esta acción no se puede deshacer!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Si, elimínalo!",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
          // parametros para axios
          const params = {
            id: this.recetaId,
          };
          // Enviar la petición al servidor
          axios
            .post(`/recetas/${this.recetaId}`, { params, _method: "delete" })
            .then((respuesta) => {
              this.$swal({
                title: "Receta Elimindada correctamente",
                text: "Se eliminó la receta",
                icon: "success",
              });
                //Eliminar receta del del DOM
                this.$el.parentNode.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode.parentNode);
                // console.log(this.$el);
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    },
  },
};
</script>
