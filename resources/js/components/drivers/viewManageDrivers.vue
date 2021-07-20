<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Usuarios</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de Conductores</el-breadcrumb-item>
      <el-breadcrumb-item>Gestionar Conductores</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>{{ driverprop == null ? "Crear Conductor" : "Editar Conductor" }}</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras crear o
          actualizar un conductor especifico
        </p>
      </div>
    </b-row>

    <b-row align-h="center">
      <el-card shadow="hover">
        <el-alert
          v-if="isError"
          title="Error de validación"
          type="error"
          :description="msgError"
          show-icon
        >
        </el-alert>
        <br />
        <b-container>
          <label for="">Nombre:</label>
          <el-input
            placeholder="Please input"
            v-model="driver.nombre"
          ></el-input>
        </b-container>
        <br />
        <b-container>
          <label for="">Cedula:</label>
          <el-input
            placeholder="Please input"
            v-model="driver.cedula"
          ></el-input>
        </b-container>
        <b-container>
          <label for="">Celular:</label>
          <el-input
            placeholder="Please input"
            v-model="driver.celular"
          ></el-input>
        </b-container>
        <br />
      </el-card>

      <b-container class="buttons-form">
        <b-row class="justify-content-center">
          <el-button
            type="success"
            size="large"
            @click="driverprop != null ? edit() : create()"
            >{{ driverprop == null ? "Crear" : "Editar" }}
            <i class="fas fa-save"></i
          ></el-button>
          <el-button type="danger" size="large" @click="goTo('/conductores')"
            >Cancelar <i class="far fa-window-close"></i
          ></el-button>
        </b-row>
      </b-container>
    </b-row>
  </div>
</template>

<script>
export default {
  name: "DriverManage",
  props: ["driverprop"],
  data() {
    return {
      isError: false,
      msgError: "",
      driver: {
        nombre: "",
        cedula: "",
        celular: "",
      },
    };
  },
  created() {
    console.log(this);
    if (this.driverprop != null) {
      this.driver.nombre = this.driverprop.nombre;
      this.driver.cedula = this.driverprop.cedula;
      this.driver.celular = this.driverprop.celular;
    }
  },
  methods: {
    goTo(location) {
      window.location.href = location;
    },

    create() {
      axios
        .post("/api/conductores", this.driver)
        .then(() => {
          this.swal({
            title: "Usuario creado correctamente",
            icon: "success",
          });
        })
        .catch(() => {
          this.swal({
            title: "Algo salio mal",
            text: "Por favor intentelo nuevamente",
            icon: "error",
            button: "OK",
          });
        });
    },

    async edit() {
      let params = {};
      params.id = this.driverprop.id;
      params.nombre = this.driver.nombre;
      params.cedula = this.driver.cedula;
      params.celular = this.driver.celular;
      await axios
        .patch("/api/conductores", params)
        .then(() => {
          this.swal(
            {
              title: "Conductor actualizado correctamente",
              icon: "success",
            }
          ).then(() => { this.goTo("/conductores") });
        })
        .catch(() => {
          this.swal({
            title: "Algo salio mal",
            text: "Por favor intentelo nuevamente",
            icon: "error",
            button: "OK",
          });
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.title {
  margin-top: 20px;
  margin-left: 0px;
  display: flex;
  flex-direction: column;
}

.buttons-form {
  margin-top: 20px;
}
</style>