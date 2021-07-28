<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Logistica</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de viajes</el-breadcrumb-item>
      <el-breadcrumb-item>Gestionar viaje</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Crear viaje</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras crear o
          actualizar un viaje especifico
        </p>
      </div>
    </b-row>

    <b-row align-h="center">
      <b-col md="8" sm="12">
        <el-card shadow="hover">
          <div class="block">
            <div class="el-divider-logistic">
              <h5 style="padding: 10px; color: white">
                <b>Encargado <i class="el-icon-user"></i></b>
              </h5>
            </div>
            <b-container>
              <b-row>
                <b-col md="12" sm="12">
                  <el-select
                    filterable
                    remote
                    reserve-keyword
                    placeholder="Ingrese el nombre de un encargado"
                    :loading="loadingManagment"
                  >
                    <el-option
                      v-for="item in users"
                      :key="item.id"
                      :label="item.nombre + ' - ' + item.cedula"
                      :value="item.id"
                    >
                    </el-option>
                  </el-select>
                </b-col>
              </b-row>
            </b-container>
            <br />
            <b-container
              style="
                border: 1px solid #c0c4cc;
                padding: 10px;
                border-radius: 10px;
              "
            >
              <b-row>
                <b-col md="12" sm="12">
                  <h5>CRISTIAN ARISTIZABAL GIRALDO</h5>
                  <h6>aristizabalcristian9005@gmail.com</h6>
                  <el-tag effect="dark">ADMINISTRADOR</el-tag>
                </b-col>
              </b-row>
            </b-container>
            <div class="el-divider-logistic">
              <h5 style="padding: 10px; color: white">
                <b>Fecha <i class="el-icon-date"></i></b>
              </h5>
            </div>
            <b-container>
              <b-row>
                <b-col md="12" sm="12">
                  <el-date-picker
                    v-model="value1"
                    type="date"
                    placeholder="Seleccione una fecha"
                  >
                  </el-date-picker>
                </b-col>
              </b-row>
            </b-container>
            <br />
            <b-container
              style="
                border: 1px solid #c0c4cc;
                padding: 10px;
                border-radius: 10px;
              "
            >
              <b-row>
                <b-col md="12" sm="12">
                  <h5>6 de Febrero del 2021</h5>
                </b-col>
              </b-row>
            </b-container>
            <div class="el-divider-logistic">
              <h5 style="padding: 10px; color: white">
                <b>Vehículo <i class="el-icon-truck"></i></b>
              </h5>
            </div>
            <b-container>
              <b-row>
                <b-col md="12" sm="12">
                  <el-select
                    filterable
                    remote
                    reserve-keyword
                    placeholder="Ingrese la placa del vehículo"
                    :loading="loadingManagment"
                  >
                    <el-option
                      v-for="item in users"
                      :key="item.id"
                      :label="item.nombre + ' - ' + item.cedula"
                      :value="item.id"
                    >
                    </el-option>
                  </el-select>
                </b-col>
              </b-row>
            </b-container>
            <br />
            <b-container
              style="
                border: 1px solid #c0c4cc;
                padding: 10px;
                border-radius: 10px;
              "
            >
              <b-row class="justify-content-center">
                <b-col md="4" sm="12" class="view-plate">
                  <div class="plate-content">
                    <h1>
                      <b>FGI379</b>
                    </h1>
                    <small>ENVIGADO</small>
                  </div>
                </b-col>
              </b-row>
              <br />
              <b-row class="justify-content-center">
                <b-col md="4" sm="12">
                  <div class="plate-content">
                    <h6>TIPO: PROPIO</h6>
                  </div>
                </b-col>
              </b-row>
              <br />
              <b-row>
                <b-col md="12" sm="12">
                  <el-table
                    :data="[{}]"
                    border
                    class="table-main"
                    style="width: 100%"
                    max-height="420"
                  >
                    <el-table-column prop="flete" label="Flete">
                      <template>
                        <el-input-number
                          :controls="false"
                          :min="1"
                          :max="10"
                        ></el-input-number>
                      </template>
                    </el-table-column>
                    <el-table-column prop="anticipo" label="Anticipo">
                      <el-input-number
                        :controls="false"
                        :min="1"
                        :max="10"
                      ></el-input-number>
                    </el-table-column>
                    <el-table-column prop="descuento" label="Descuento">
                      <el-input-number
                        :controls="false"
                        :min="1"
                        :max="10"
                      ></el-input-number>
                    </el-table-column>
                  </el-table>
                </b-col>
              </b-row>
            </b-container>
            <br />
            <div class="el-divider-logistic">
              <h5 style="padding: 10px; color: white">
                <b>Conductor <i class="el-icon-bank-card"></i></b>
              </h5>
            </div>
            <b-container>
              <b-row>
                <b-col md="12" sm="12">
                  <el-select
                    filterable
                    remote
                    reserve-keyword
                    placeholder="Ingrese el nombre de un conductor"
                    :loading="loadingManagment"
                  >
                    <el-option
                      v-for="item in users"
                      :key="item.id"
                      :label="item.nombre + ' - ' + item.cedula"
                      :value="item.id"
                    >
                    </el-option>
                  </el-select>
                </b-col>
              </b-row>
            </b-container>
            <br />
            <b-container
              style="
                border: 1px solid #c0c4cc;
                padding: 10px;
                border-radius: 10px;
              "
            >
              <b-row>
                <b-col md="12" sm="12">
                  <h5>Emanuel Madrid Restrepo</h5>
                  <h6><b>CC:</b> 1035878854</h6>
                  <h6><b>Celular:</b> 30078544214</h6>
                </b-col>
              </b-row>
            </b-container>
            <div class="el-divider-logistic">
              <h5 style="padding: 10px; color: white">
                <b>Trayecto <i class="el-icon-location-outline"></i></b>
              </h5>
            </div>

            <b-container
              style="
                border: 1px solid #c0c4cc;
                padding: 10px;
                border-radius: 10px;
              "
            >
              <el-timeline>
                <el-timeline-item
                  timestamp="Destino"
                  placement="top"
                  color="#0bbd87"
                >
                  <el-card>
                    <el-select v-model="value" placeholder="Select">
                      <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value"
                      >
                      </el-option>
                    </el-select>
                  </el-card>
                </el-timeline-item>
                <el-timeline-item
                  timestamp="Destino"
                  placement="top"
                  color="#0bbd87"
                >
                  <el-card>
                    <el-select v-model="value" placeholder="Select">
                      <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value"
                      >
                      </el-option>
                    </el-select>
                  </el-card>
                </el-timeline-item>
                <el-timeline-item
                  timestamp="Destino"
                  placement="top"
                  color="#0bbd87"
                >
                  <el-card>
                    <el-select v-model="value" placeholder="Select">
                      <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value"
                      >
                      </el-option>
                    </el-select>
                  </el-card>
                </el-timeline-item>
              </el-timeline>
            </b-container>
            <div class="el-divider-logistic">
              <h5 style="padding: 10px; color: white">
                <b>Tipo de carga <i class="el-icon-s-grid"></i></b>
              </h5>
            </div>
            <b-container>
              <b-row>
                <b-col md="12" sm="12">
                  <el-select
                    filterable
                    remote
                    reserve-keyword
                    placeholder="Seleccione un tipo de carga"
                    :loading="loadingManagment"
                  >
                    <el-option
                      v-for="item in users"
                      :key="item.id"
                      :label="item.nombre + ' - ' + item.cedula"
                      :value="item.id"
                    >
                    </el-option>
                  </el-select>
                </b-col>
              </b-row>
            </b-container>
            <div class="el-divider-logistic">
              <h5 style="padding: 10px; color: white">
                <b>Cliente <i class="el-icon-user"></i></b>
              </h5>
            </div>
            <b-container>
              <b-row>
                <b-col md="12" sm="12">
                  <el-select
                    filterable
                    remote
                    reserve-keyword
                    placeholder="Ingrese el nombre de un encargado"
                    :loading="loadingManagment"
                  >
                    <el-option
                      v-for="item in users"
                      :key="item.id"
                      :label="item.nombre + ' - ' + item.cedula"
                      :value="item.id"
                    >
                    </el-option>
                  </el-select>
                </b-col>
              </b-row>
            </b-container>
            <br />
            <b-container
              style="
                border: 1px solid #c0c4cc;
                padding: 10px;
                border-radius: 10px;
              "
            >
              <b-row>
                <b-col md="12" sm="12">
                  <h5>TRASGIRAR S.A.S</h5>
                  <h6><b>NIT:</b> 885544757</h6>
                  <el-tag effect="dark"
                    ><b>RAZON SOCIAL: </b>TRASPORTADORA TRASGIRAR</el-tag
                  >
                </b-col>
              </b-row>
            </b-container>
          </div>

          <div class="el-divider-logistic">
            <h5 style="padding: 10px; color: white">
              <b>Valores adicionales <i class="el-icon-money"></i></b>
            </h5>
          </div>
          <b-container
            style="
              border: 1px solid #c0c4cc;
              padding: 10px;
              border-radius: 10px;
            "
          >
            <b-row>
              <b-col md="12" sm="12">
                <el-table
                  :data="[{ value: 'DESCARGUE', key: '$100.000' }]"
                  border
                  class="table-main"
                  style="width: 100%"
                  max-height="420"
                >
                  <el-table-column prop="descripcion" label="Descripción">
                    <template slot-scope="props">
                      {{ props.row.value }}
                    </template>
                  </el-table-column>
                  <el-table-column prop="valor" label="Valor">
                    <template slot-scope="props">
                      {{ props.row.key }}
                    </template>
                  </el-table-column>
                </el-table>
              </b-col>
            </b-row>
          </b-container>
          <div class="el-divider-logistic">
            <h5 style="padding: 10px; color: white">
              <b>Descripción del viaje <i class="el-icon-money"></i></b>
            </h5>
          </div>
          <b-container
            style="
              border: 1px solid #c0c4cc;
              padding: 10px;
              border-radius: 10px;
            "
          >
            <el-input
              type="textarea"
              :rows="2"
              placeholder="Please input"
              v-model="textarea"
            >
            </el-input>
          </b-container>
        </el-card>

        <b-container class="buttons-form">
          <b-row class="justify-content-center">
            <el-button
              type="success"
              size="large"
              @click="userprop != null ? edit() : create()"
              >{{ userprop == null ? "Crear" : "Editar" }}
              <i class="fas fa-save"></i
            ></el-button>
            <el-button type="danger" size="large" @click="goTo('/usuarios')"
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
  props: ["userprop"],
  data() {
    return {
      loadingManagment: false,
      users: [],
    };
  },
  created() {},
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
      } else if (!emailRule.test(this.user.email)) {
        this.isError = true;
        this.msgError = "Por favor ingrese un correo valido";
        return false;
      } else {
        if (this.passwordEnable) {
          if (!this.user.password) {
            this.isError = true;
            this.msgError = "Por favor ingrese una contraseña";
            return false;
          }
          if (this.confirmPassword != this.user.password) {
            this.isError = true;
            this.msgError = "Las contraseñas no coinciden";
            return false;
          }
        }

        this.isError = false;
        this.msgError = "";
        return true;
      }
    },

    create() {
      if (this.validate()) {
        axios
          .post("/api/usuario", this.user)
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
      }
    },

    edit() {
      if (this.validate()) {
        let params = {};
        params.id = this.userprop.id;
        params.name = this.user.name;
        params.email = this.user.email;
        if (this.passwordEnable) {
          params.password = this.user.password;
        }
        axios
          .patch("/api/usuario", params)
          .then(() => {
            this.swal({
              title: "Usuario actualizado correctamente",
              icon: "success",
            });
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            }).then(() => {
              this.goTo("/usuarios");
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
    font-size: 30px;
  }

  small {
    font-size: 15px;
  }
}

.buttons-form {
  margin-top: 20px;
}

.el-select {
  position: relative;
  font-size: 14px;
  display: inline-block;
  width: 100%;
}

.el-date-editor {
  position: relative;
  font-size: 14px;
  display: inline-block;
  width: 100%;
}

.el-divider-logistic {
  margin: 20px 0px;
  width: 100%;
  height: 40px;
  background-color: green;
}

::v-deep .el-table th,
.el-table tr {
  background-color: #007900;
  color: white;
  font-weight: normal;
  border: none;
}

::v-deep .el-table tbody,
.el-table tr {
  font-size: 12px;
  font-weight: normal;
}
</style>