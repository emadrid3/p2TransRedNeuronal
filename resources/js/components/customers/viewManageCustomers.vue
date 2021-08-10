<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Clientes</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de Clientes</el-breadcrumb-item>
      <el-breadcrumb-item>Gestionar Clientes</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>{{ customerprop == null ? "Crear cliente" : "Editar cliente" }}</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras crear o
          actualizar un clientes especifico
        </p>
      </div>
    </b-row>

    <b-row>
      <el-card class="box-card" style="width: 100%">
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
          <b-row>
            <b-col>
              <label for="">Nombre:</label>
              <el-input
                placeholder="Ingrese un nombre"
                v-model="customer.nombre"
              ></el-input>
            </b-col>
            <b-col>
              <label for="">Nit o Numero de documento:</label>
              <el-input
                placeholder="Ingrese un Nit"
                v-model="customer.nit"
              ></el-input>
            </b-col>
          </b-row>
        </b-container>
        <br />
        <b-container>
          <label for="">Razon social:</label>
          <el-input
            placeholder="Ingrese una razon social"
            v-model="customer.razonSocial"
          ></el-input>
        </b-container>
      </el-card>

      <b-container class="buttons-form">
        <b-row class="justify-content-center">
          <el-button
            type="success"
            size="large"
            @click="customerprop != null ? edit() : create()"
            >{{ customerprop == null ? "Crear" : "Editar" }}
            <i class="fas fa-save"></i
          ></el-button>
          <el-button type="danger" size="large" @click="goTo('/clientes')"
            >Cancelar <i class="far fa-window-close"></i
          ></el-button>
        </b-row>
      </b-container>
    </b-row>
  </div>
</template>

<script>
export default {
  name: "CustomerManage",
  props: ["customerprop"],
  data() {
    return {
      isError: false,
      msgError: "",
      customer: {
        id: "",
        nombre: "",
        nit: "",
        razonSocial: ""
      },
    };
  },
  created() {
    if (this.customerprop != null) {
      this.customer.id = this.customerprop.id;
      this.customer.nombre = this.customerprop.nombre;
      this.customer.nit = this.customerprop.nit;
      this.customer.razonSocial = this.customerprop.razonSocial;
    }
  },

  methods: {
    goTo(location) {
      window.location.href = location;
    },

    validate() {
      if (!this.customer.nombre) {
        this.isError = true;
        this.msgError = "Por favor ingrese un nombre";
        return false;
      } else if (!this.customer.nit) {
        this.isError = true;
        this.msgError = "Por favor ingrese un nit o un numero de documento";
        return false;
      } else if (!this.customer.razonSocial) {
        this.isError = true;
        this.msgError = "Por favor ingrese una razon social";
        return false;
      } else {
        this.isError = false;
        this.msgError = "";
        return true;
      }
    },

    create() {
      if (this.validate()) {
        axios
          .post("/api/cliente", this.customer)
          .then(() => {
            this.swal({
              title: "Cliente creado correctamente",
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
      }
    },
    edit() {
      if (this.validate()) {
        let params = {};
        params.id = this.customerprop.id;
        params.nombre = this.customer.nombre;
        params.nit = this.customer.nit;
        params.razonSocial = this.customer.razonSocial;
        axios
          .patch("/api/cliente", params)
          .then(() => {
            this.swal({
              title: "Cliente actualizado correctamente",
              icon: "success",
            }).then(()=> {
              this.goTo('/clientes');
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
      }
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