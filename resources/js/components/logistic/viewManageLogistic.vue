<template>
  <div>
    <div class="title-separator">
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
            <i class="fas fa-info-circle"></i>Desde esta ventana podras
                    crear o actualizar un viaje especifico
          </p>
        </div>
      </b-row>
    </div>

    <b-row align-h="center">
      <b-col md="10" sm="12">
        <el-card shadow="hover">
          <div class="block">
            <b-container>
              <b-row>
                <b-col
                  md="3"
                  sm="6"
                  style="
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                  "
                >
                  <h4 style="color: #007900">FACTURA #</h4>
                </b-col>
                <b-col md="9" sm="6">
                  <el-input
                    v-model="logistic.bill_number"
                    style="font-size: 25px"
                  ></el-input>
                </b-col>
              </b-row>
              <br />
              <b-row>
                <b-col
                  md="3"
                  sm="6"
                  style="
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                  "
                >
                  <h4 style="color: #007900">ORDEN #</h4>
                </b-col>
                <b-col md="9" sm="6">
                  <el-input
                    v-model="logistic.order_number"
                    style="font-size: 25px"
                  ></el-input>
                </b-col>
              </b-row>
              <br />
              <b-row>
                <b-col
                  md="3"
                  sm="6"
                  style="
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                  "
                >
                  <h4 style="color: #007900">REMISIONES CLIENTE #</h4>
                  <p>
                    <i class="fas fa-info-circle"></i>Ingresar la primer letra en Mayuscula y separar por comas (,)
                  </p>
                </b-col>
                <b-col md="9" sm="6">
                  <el-input
                    v-model="logistic.customer_number"
                    style="font-size: 25px"
                  ></el-input>
                </b-col>
              </b-row>
              <hr />
            </b-container>
            <b-container>
              <b-row>
                <b-col md="6" sm="12">
                  <div class="el-divider-logistic">
                    <h5 style="color: #007900; font-size: 25px">
                      <small>Gestionar</small>
                      <b>Encargado <i class="el-icon-user"></i></b>
                    </h5>
                    <hr />
                  </div>

                  <el-select
                    v-model="logistic.user"
                    value-key="id"
                    filterable
                    remote
                    reserve-keyword
                    placeholder="Ingrese el nombre de un encargado"
                    :remote-method="remoteMethodUser"
                  >
                    <el-option
                      v-for="item in listUsers"
                      :key="item.id"
                      :label="item.name"
                      :value="item"
                    >
                    </el-option>
                  </el-select>

                  <b-container
                    v-if="logistic.user != null"
                    style="padding: 10px; border-radius: 10px"
                  >
                    <b-row>
                      <b-col md="12" sm="12">
                        <h5>{{ logistic.user.name }}</h5>
                        <h6>{{ logistic.user.email }}</h6>
                        <el-tag effect="dark">{{
                          logistic.user.user.rol
                        }}</el-tag>
                      </b-col>
                    </b-row>
                  </b-container>
                </b-col>
                <b-col md="6" sm="12">
                  <div class="el-divider-logistic">
                    <h5 style="color: #007900; font-size: 25px">
                      <small>Gestionar</small>
                      <b>Fecha <i class="el-icon-date"></i></b>
                    </h5>
                    <hr />
                  </div>

                  <el-date-picker
                    v-model="logistic.date"
                    type="date"
                    placeholder="Seleccione una fecha"
                    value-format="yyyy-MM-dd"
                  >
                  </el-date-picker>
                </b-col>
              </b-row>
            </b-container>

            <b-container>
              <b-row>
                <b-col md="6" sm="12">
                  <div class="el-divider-logistic">
                    <h5 style="color: #007900; font-size: 25px">
                      <small>Gestionar</small>
                      <b>Vehículo <i class="el-icon-truck"></i></b>
                    </h5>
                    <hr />
                  </div>

                  <el-select
                    v-model="logistic.vehicle"
                    filterable
                    value-key="id"
                    remote
                    reserve-keyword
                    placeholder="Ingrese la placa del vehículo"
                    :remote-method="remoteMethodVehicle"
                  >
                    <el-option
                      v-for="item in listVehicles"
                      :key="item.id"
                      :label="item.placa"
                      :value="item"
                    >
                    </el-option>
                  </el-select>

                  <b-container
                    v-if="logistic.vehicle"
                    style="padding: 10px; border-radius: 10px"
                  >
                    <b-row class="justify-content-center">
                      <b-col md="12" sm="12" class="view-plate">
                        <div class="plate-content">
                          <h1>
                            <b>{{ logistic.vehicle.placa }}</b>
                          </h1>
                          <small>{{ logistic.vehicle.ciudad }}</small>
                        </div>
                      </b-col>
                    </b-row>
                    <br />
                    <b-row class="justify-content-center">
                      <b-col md="4" sm="12">
                        <div class="plate-content">
                          <h6>
                            TIPO: {{ logistic.vehicle.tipo.toUpperCase() }}
                          </h6>
                        </div>
                      </b-col>
                    </b-row>
                    <br />
                    <b-row v-if="logistic.vehicle.tipo == 'tercero'">
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
                              <currency-input 
                                v-model="logistic.freight" 
                                :options="{ currency: 'COP' }"
                              />
                            </template>
                          </el-table-column>
                          <el-table-column prop="anticipo" label="Anticipo">
                            <currency-input 
                                v-model="logistic.advance" 
                                :options="{ currency: 'COP' }"
                            />
                          </el-table-column>
                          <el-table-column prop="descuento" label="Descuento">
                            <currency-input 
                                v-model="logistic.discount" 
                                :options="{ currency: 'COP' }"
                            />
                          </el-table-column>
                        </el-table>
                      </b-col>
                    </b-row>
                    <b-row >
                      <b-col
                        md="6"
                        sm="12"
                        style="
                          display: flex;
                          flex-direction: column;
                          justify-content: center;
                        "
                      >
                        <h4 style="color: #007900">VALOR VIAJE</h4>
                      </b-col>
                      <b-col md="6" sm="12">
                        <currency-input 
                            v-model="logistic.travel_total" 
                            :options="{ currency: 'COP' }"
                        />
                      </b-col>
                    </b-row>
                  </b-container>
                </b-col>
                <b-col md="6" sm="12">
                  <div class="el-divider-logistic">
                    <h5 style="color: #007900; font-size: 25px">
                      <small>Gestionar</small>
                      <b>Conductor <i class="el-icon-bank-card"></i></b>
                    </h5>
                    <hr />
                  </div>

                  <el-select
                    v-model="logistic.driver"
                    filterable
                    value-key="id"
                    remote
                    reserve-keyword
                    placeholder="Ingrese la cedula o el nombre de un conductor"
                    :remote-method="remoteMethodDrivers"
                  >
                    <el-option
                      v-for="item in listDrivers"
                      :key="item.id"
                      :label="item.nombre + ' - ' + item.cedula"
                      :value="item"
                    >
                    </el-option>
                  </el-select>
                  <b-container
                    v-if="logistic.driver != null"
                    style="padding: 10px; border-radius: 10px"
                  >
                    <b-row>
                      <b-col md="12" sm="12">
                        <h5>{{ logistic.driver.nombre }}</h5>
                        <h6><b>CC:</b>{{ logistic.driver.cedula }}</h6>
                        <h6><b>Celular:</b>{{ logistic.driver.celular }}</h6>
                      </b-col>
                    </b-row>
                  </b-container>
                </b-col>
              </b-row>
            </b-container>

            <b-container>
              <div class="el-divider-logistic">
                <hr />
                <h5 style="color: #007900; font-size: 25px">
                  <small>Gestionar</small>
                  <b>Trayecto <i class="el-icon-location-outline"></i></b>
                </h5>
                <hr />
              </div>
            </b-container>

            <b-container style="padding: 10px; border-radius: 10px">
              <el-timeline>
                <el-timeline-item
                  timestamp="Seleccione una ciudad"
                  placement="top"
                  color="#0bbd87"
                  v-for="(city, index) in logistic.travel"
                  :key="index"
                >
                  <el-card>
                    <div class="body-travel">
                      <el-select
                        v-model="logistic.travel[index]"
                        filterable
                        value-key="id"
                        remote
                        reserve-keyword
                        placeholder="Ingrese el nombre de una ciudad"
                        :remote-method="remoteMethodCity"
                      >
                        <el-option
                          v-for="item in listCities"
                          :key="item.id"
                          :label="item.nombre"
                          :value="item"
                        >
                        </el-option>
                      </el-select>
                      <div @click="splitTravel(index)">
                        <i
                          class="fas fa-trash-alt"
                          style="color: red; padding: 10px"
                        ></i>
                      </div>
                    </div>
                  </el-card>
                </el-timeline-item>
              </el-timeline>
              <b-container>
                <b-row>
                  <el-button
                    class="button-add"
                    type="success"
                    @click="addTravel"
                    ><i class="fas fa-plus"></i>Agregar un destino</el-button
                  >
                </b-row>
              </b-container>
            </b-container>
            <b-container>
              <div class="el-divider-logistic">
                <hr />
                <h5 style="color: #007900; font-size: 25px">
                  <small>Gestionar</small>
                  <b>Tipo de vehiculo <i class="el-icon-s-grid"></i></b>
                </h5>
                <hr />
              </div>
            </b-container>
            <b-container>
              <b-row>
                <b-col md="12" sm="12">
                  <el-select
                    v-model="logistic.type"
                    filterable
                    value-key="id"
                    remote
                    reserve-keyword
                    placeholder="Seleccione un tipo de carga"
                    :remote-method="remoteMethodType"
                  >
                    <el-option
                      v-for="item in listType"
                      :key="item.id"
                      :label="item.tipo"
                      :value="item.id"
                    >
                    </el-option>
                  </el-select>
                </b-col>
              </b-row>
            </b-container>
            <b-container>
              <div class="el-divider-logistic">
                <hr />
                <h5 style="color: #007900; font-size: 25px">
                  <small>Gestionar</small>
                  <b>Tipo de carga <i class="el-icon-s-grid"></i></b>
                </h5>
                <hr />
              </div>
            </b-container>
            <b-container>
              <b-row>
                <b-col md="12" sm="12">
                  <el-select
                    v-model="logistic.charge"
                    filterable
                    value-key="id"
                    remote
                    reserve-keyword
                    placeholder="Seleccione un tipo de carga"
                    :remote-method="remoteMethodCharge"
                  >
                    <el-option
                      v-for="item in listCarga"
                      :key="item.id"
                      :label="item.tipoCarga"
                      :value="item.id"
                    >
                    </el-option>
                  </el-select>
                </b-col>
              </b-row>
            </b-container>
            <b-container>
              <div class="el-divider-logistic">
                <hr />
                <h5 style="color: #007900; font-size: 25px">
                  <small>Gestionar</small>
                  <b>Cliente <i class="el-icon-user"></i></b>
                </h5>
                <hr />
              </div>
            </b-container>
            <b-container>
              <b-row>
                <b-col md="12" sm="12">
                  <el-select
                    v-model="logistic.customer"
                    filterable
                    value-key="id"
                    remote
                    reserve-keyword
                    placeholder="Ingrese el nombre, NIT o razón social"
                    :remote-method="remoteMethodCustomer"
                  >
                    <el-option
                      v-for="item in listCustomer"
                      :key="item.id"
                      :label="item.nombre"
                      :value="item"
                    >
                    </el-option>
                  </el-select>
                </b-col>
              </b-row>
            </b-container>
            <br />
            <b-container
              v-if="logistic.customer != null"
              style="padding: 10px; border-radius: 10px"
            >
              <b-row>
                <b-col md="12" sm="12">
                  <h5>{{ logistic.customer.nombre }}</h5>
                  <h6><b>NIT:</b>{{ logistic.customer.nit }}</h6>
                  <el-tag effect="dark"
                    ><b>RAZON SOCIAL: </b
                    >{{ logistic.customer.razonSocial }}</el-tag
                  >
                </b-col>
              </b-row>
            </b-container>
          </div>
          <b-container>
            <div class="el-divider-logistic">
              <hr />
              <h5 style="color: #007900; font-size: 25px">
                <small>Gestionar</small>
                <b>Valores adicionales <i class="el-icon-money"></i></b>
              </h5>
              <hr />
            </div>
          </b-container>
          <b-container style="padding: 10px; border-radius: 10px">
            <b-row>
              <b-col md="12" sm="12">
                <el-table
                  :data="logistic.extra"
                  border
                  class="table-main"
                  style="width: 100%"
                  max-height="420"
                >
                  <el-table-column prop="descripcion" label="Descripción">
                    <template slot-scope="props">
                      <el-input
                        v-model="logistic.extra[props.$index].description"
                      ></el-input>
                    </template>
                  </el-table-column>
                  <el-table-column prop="valor" label="Valor">
                    <template slot-scope="props">
                      <currency-input 
                          v-model="logistic.extra[props.$index].value" 
                          :options="{ currency: 'COP' }"
                      />
                    </template>
                  </el-table-column>
                  <el-table-column label="Acción">
                    <template slot-scope="props">
                      <div @click="splitValue(props.$index)">
                        <i
                          class="fas fa-trash-alt"
                          style="color: red; padding: 10px"
                        ></i>
                      </div>
                    </template>
                  </el-table-column>
                </el-table>
              </b-col>
            </b-row>
            <b-row>
              <el-button class="button-add" type="success" @click="addValue"
                ><i class="fas fa-plus"></i>Agregar un valor</el-button
              >
            </b-row>
          </b-container>
          <b-container>
            <div class="el-divider-logistic">
              <hr />
              <h5 style="color: #007900; font-size: 25px">
                <small>Gestionar</small>
                <b>Descripción del viaje <i class="el-icon-money"></i></b>
              </h5>
              <hr />
            </div>
          </b-container>
          <b-container style="padding: 10px; border-radius: 10px">
            <el-input
              type="textarea"
              :rows="2"
              placeholder="Please input"
              v-model="logistic.description"
            >
            </el-input>
          </b-container>
        </el-card>

        <b-container class="buttons-form">
          <b-row class="justify-content-center">
            <el-button type="success" size="large" @click="save()"
              >Guardar cambios <i class="fas fa-save"></i
            ></el-button>
            <el-button type="danger" size="large" @click="goTo('/logistica')"
              >Cancelar <i class="far fa-window-close"></i
            ></el-button>
          </b-row>
        </b-container>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import CurrencyInput from '../formatMoney/formatMoney.vue'
export default {
  name: "LogisticManage",
  props: ["logisticaprop", "page"],
  components:{
    CurrencyInput
  },
  data() {
    return {
      listUsers: [],
      listVehicles: [],
      listDrivers: [],
      listType: [],
      listCarga: [],
      listCustomer: [],
      listCities: [],

      logistic: {
        bill_number: null,
        order_number: null,
        customer_number: null,
        user: null,
        date: null,
        vehicle: null,
        travel_total: 0,
        freight: 0,
        advance: 0,
        discount: 0,
        driver: null,
        travel: [],
        type: null,
        charge: null,
        customer: null,
        extra: [],
        description: null,
      },
    };
  },
  created() {
    this.logistic.travel.push(null);
    if (this.logisticaprop != null) {

      if(this.logisticaprop.encargado != null){
        this.listUsers.push(this.logisticaprop.encargado);
      }

      if(this.logisticaprop.vehiculo != null){
        this.listVehicles.push(this.logisticaprop.vehiculo);
      }

      if(this.logisticaprop.conductor != null){
        this.listDrivers.push(this.logisticaprop.conductor);
      }

      if(this.logisticaprop.trayecto != null){
        this.listCities.push(...JSON.parse(this.logisticaprop.trayecto));
      }

      if(this.logisticaprop.tipo != null){
        this.listType.push(this.logisticaprop.tipo);
      }

      if(this.logisticaprop.carga != null){
        this.listCarga.push(this.logisticaprop.carga);
      }

      if(this.logisticaprop.cliente != null){
        this.listCustomer.push(this.logisticaprop.cliente);
      }
      
      this.logistic.id = this.logisticaprop.id;
      this.logistic.bill_number = this.logisticaprop.numero_factura;
      this.logistic.order_number = this.logisticaprop.numero_orden;
      this.logistic.customer_number = this.logisticaprop.numero_factura_cliente;
      this.logistic.user = this.logisticaprop.encargado;
      this.logistic.date = this.logisticaprop.fecha;
      this.logistic.vehicle = this.logisticaprop.vehiculo;
      this.logistic.driver = this.logisticaprop.conductor;
      this.logistic.travel_total = this.logisticaprop.valor_viaje != null ? this.logisticaprop.valor_viaje : 0;
      this.logistic.freight = this.logisticaprop.flete != null ? this.logisticaprop.flete : 0;
      this.logistic.advance = this.logisticaprop.anticipo != null ? this.logisticaprop.anticipo : 0;
      this.logistic.discount = this.logisticaprop.descuento != null ? this.logisticaprop.descuento : 0;
      this.logistic.travel = this.logisticaprop.trayecto != null ? JSON.parse(this.logisticaprop.trayecto) : [];
      this.logistic.type = this.logisticaprop.tipo != null ? this.logisticaprop.tipo.id : null;
      this.logistic.charge = this.logisticaprop.carga != null ? this.logisticaprop.carga.id : null;
      this.logistic.customer = this.logisticaprop.cliente;
      this.logistic.extra = this.logisticaprop.extra != null ? JSON.parse(this.logisticaprop.extra) : [];
      this.logistic.description = this.logisticaprop.descripcion;
    }
  },
  methods: {
    goTo(location) {
      window.location.href = location;
    },

    addValue() {
      this.logistic.extra.push({ description: "", value: 0 });
    },

    splitValue(index) {
      this.logistic.extra.splice(index, 1);
    },

    addTravel() {
      this.logistic.travel.push(null);
    },

    splitTravel(index) {
      this.logistic.travel.splice(index, 1);
    },

    save() {
      axios
        .post("/api/logistica", this.logistic)
        .then(() => {
          this.swal({
            title: "El registro de viaje se ha creado correctamente",
            icon: "success",
          }).then(() => {
            this.goTo("/logistica/"+this.page);
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

    remoteMethodUser(query) {
      if (query !== "") {
        axios
          .get("/api/usuarios-search", {
            params: { size: 10, input: query },
          })
          .then((response) => {
            this.listUsers = response.data.data;
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      } else {
        this.listUsers = [];
      }
    },
    remoteMethodVehicle(query) {
      if (query !== "") {
        axios
          .get("/api/vehiculo-search", {
            params: { size: 10, input: query },
          })
          .then((response) => {
            this.listVehicles = response.data.data;
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      } else {
        this.listVehicles = [];
      }
    },
    remoteMethodDrivers(query) {
      if (query !== "") {
        axios
          .get("/api/conductores-search", {
            params: { size: 10, input: query },
          })
          .then((response) => {
            this.listDrivers = response.data.data;
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      } else {
        this.listDrivers = [];
      }
    },
    remoteMethodCity(query) {
      if (query !== "") {
        axios
          .get("/api/ciudades-search", {
            params: { size: 10, input: query },
          })
          .then((response) => {
            this.listCities = response.data.data;
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      } else {
        this.listCities = [];
      }
    },
    remoteMethodType(query) {
      if (query !== "") {
        axios
          .get("/api/tipo-vehiculo-search", {
            params: { size: 10, input: query },
          })
          .then((response) => {
            this.listType = response.data.data;
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      } else {
        this.listType = [];
      }
    },
    remoteMethodCharge(query) {
      if (query !== "") {
        axios
          .get("/api/tipo-carga", {
            params: { size: 10, input: query },
          })
          .then((response) => {
            this.listCarga = response.data.data;
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      } else {
        this.listCarga = [];
      }
    },
    remoteMethodCustomer(query) {
      if (query !== "") {
        axios
          .get("/api/cliente-search", {
            params: { size: 10, input: query },
          })
          .then((response) => {
            this.listCustomer = response.data.data;
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      } else {
        this.listCustomer = [];
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

.button-add {
  background-color: #007900;

  &:hover {
    background-color: #019901;
  }
}
::v-deep .body-travel {
  display: flex;
  justify-content: space-between;
}

::v-deep .el-input-number {
  width: 100px;
}
</style>