<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Usuarios</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de usuarios</el-breadcrumb-item>
      <el-breadcrumb-item>Gestionar Usuario</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Gestionar Usuario</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras crear o
          actualizar un usuario especifico
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
            show-icon>
        </el-alert>
        <br>
        <b-container>
          <label for="">Nombre:</label>
          <el-input placeholder="Please input" v-model="user.name"></el-input>
        </b-container>
        <br />
        <b-container>
          <label for="">Email:</label>
          <el-input placeholder="Please input" v-model="user.email"></el-input>
        </b-container>
        <br />
        <b-container>
          <b-row>
            <b-col md="6" sm="12">
              <label for="">Contraseña:</label>
              <el-input
                placeholder="Please input"
                v-model="user.password"
                show-password
              ></el-input>
            </b-col>
            <b-col md="6" sm="12">
              <label for="">Confirmar Contraseña:</label>
              <el-input
                placeholder="Please input"
                v-model="confirmPassword"
                show-password
              ></el-input>
            </b-col>
          </b-row>
        </b-container>
      </el-card>

      <b-container class="buttons-form">
        <b-row class="justify-content-center">
          <el-button type="success" size="large"
            @click="submit()"
            >Crear Usuario <i class="fas fa-save"></i
          ></el-button>
          <el-button type="danger" size="large" @click="goTo('usuarios')"
            >Cancelar <i class="far fa-window-close"></i
          ></el-button>
        </b-row>
      </b-container>
    </b-row>
  </div>
</template>

<script>
export default {
  name: "UserManage",
  data() {
    return {
        isError: false,
        msgError: "",
        user: {
            name: "",
            email: "",
            password: "",
        },
        confirmPassword: ""
    };
  },
  methods: {
    goTo(location) {
      window.location.href = location;
    },

    validate(){
        let emailRule = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

        if (!this.user.name) {
            this.isError = true;
            this.msgError = "Por favor ingrese un nombre"
            return false;
        }else if (!this.user.email) {
            this.isError = true;
            this.msgError = "Por favor ingrese un correo"
            return false;
        }else if (!this.user.password) {
            this.isError = true;
            this.msgError = "Por favor ingrese una contraseña"
            return false;
        }else if (this.confirmPassword != this.user.password) {
            this.isError = true;
            this.msgError = "Las contraseñas no coinciden"
            return false;
        }else if (!emailRule.test(this.user.email)) {
            this.isError = true;
            this.msgError = "Por favor ingrese un correo valido"
            return false;
        } else {
            this.isError = false;
            this.msgError = "";
            return true;
        }
    },

    async submit(){
        if(this.validate()){
            let response = await axios.post('/api/usuario', this.user);
            console.log(response);
        }
    }
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