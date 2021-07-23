<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Vehiculos</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de Vehiculos</el-breadcrumb-item>
      <el-breadcrumb-item>Gestionar Vehiculos</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Gestionar Vehiculo</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras crear o
          actualizar un vehiculo especifico
        </p>
      </div>
    </b-row>

    <b-row align-h="center">
      <b-col md="8" sm="12">
        <el-card shadow="hover">
          <b-container>
            <b-row class="justify-content-center">
              <b-col md="4" sm="12" class="view-plate">
                <div class="plate-content">
                  <h1><b>XST345</b></h1>
                  <h5>MEDELLIN</h5>
                </div>
              </b-col>
            </b-row>
          </b-container>
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
              <b-col md="12" sm="12">
                <label for="">Placa:</label>
                <el-input
                  placeholder="Ingrese un nombre"
                  v-model="user.name"
                ></el-input>
              </b-col>
            </b-row>
          </b-container>
          <br />
          <b-container>
            <b-row>
              <b-col md="12" sm="12">
                <label for="">Ciudad:</label>
                <el-input
                  placeholder="Ingrese una ciudad"
                  v-model="user.city"
                ></el-input>
              </b-col>
            </b-row>
          </b-container>
          <br />
          <b-container>
            <b-row>
              <b-col md="12" sm="12">
                <label for="">Tipo:</label>
                <el-select
                  v-model="value"
                  placeholder="Seleccione un tipo de vehiculo"
                >
                  <el-option
                    v-for="item in optionsTipo"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"
                  >
                  </el-option>
                </el-select>
              </b-col>
            </b-row>
          </b-container>
          <br />
          <b-container>
            <b-row>
              <b-col md="12" sm="12">
                <label for="">Conductor:</label>
                <el-select
                  v-model="value"
                  multiple
                  filterable
                  remote
                  reserve-keyword
                  placeholder="Ingrese la cedula o el nombre de un conductor"
                  :remote-method="remoteMethod"
                  :loading="loading"
                >
                  <el-option
                    v-for="item in options"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"
                  >
                  </el-option>
                </el-select>
              </b-col>
            </b-row>
          </b-container>
        </el-card>

        <b-container class="buttons-form">
          <b-row class="justify-content-center">
            <el-button type="success" size="large" @click="submit()"
              >Crear Vehiculo <i class="fas fa-save"></i
            ></el-button>
            <el-button type="danger" size="large" @click="goTo('usuarios')"
              >Cancelar <i class="far fa-window-close"></i
            ></el-button>
          </b-row>
        </b-container>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: "UserManage",
  data() {
    return {
      optionsTipo : [{
          value: 'propio',
          label: 'PROPIO'
        }, {
          value: 'tercero',
          label: 'TERCERO',
        }],

      isError: false,
      msgError: "",
      user: {
        name: "",
        email: "",
        password: "",
      },
      confirmPassword: "",
    };
  },
  methods: {
    goTo(location) {
      window.location.href = location;
    },

    validate() {
      let emailRule =
        /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

      if (!this.user.name) {
        this.isError = true;
        this.msgError = "Por favor ingrese un nombre";
        return false;
      } else if (!this.user.email) {
        this.isError = true;
        this.msgError = "Por favor ingrese un correo";
        return false;
      } else if (!this.user.password) {
        this.isError = true;
        this.msgError = "Por favor ingrese una contraseña";
        return false;
      } else if (this.confirmPassword != this.user.password) {
        this.isError = true;
        this.msgError = "Las contraseñas no coinciden";
        return false;
      } else if (!emailRule.test(this.user.email)) {
        this.isError = true;
        this.msgError = "Por favor ingrese un correo valido";
        return false;
      } else {
        this.isError = false;
        this.msgError = "";
        return true;
      }
    },

    submit() {
      if (this.validate()) {
        axios
          .get("/api/usuariosall")
          .then((response) => {
            this.swal({
              title: "Usuario creado correctamente",
              icon: "success",
            });
          })
          .catch((error) => {
            if (error.message == "Request failed with status code 401") {
              this.swal({
                title: "No autorizado",
                text: "Por favor ingrese a la app nuevamente",
                icon: "warning",
                button: "OK",
              }).then(() => {
                this.goTo("/");
              });
            } else {
              this.swal({
                title: "Algo salio mal",
                text: "Por favor intentelo nuevamente",
                icon: "error",
                button: "OK",
              });
            }
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

.view-plate {
  background-color: #ffeb00;
  border-radius: 10px;
  border: 4px solid black;
}

.plate-content {
  display: flex;
  flex-direction: column;
  align-items: center;

  h1 {
    font-size: 50px;
  }
}

.el-select {
  position: relative;
  font-size: 14px;
  display: inline-block;
  width: 100%;
}
</style>