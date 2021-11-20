<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Viajes</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de viajes</el-breadcrumb-item>
    </el-breadcrumb>
    <my-currency-input v-model="price"></my-currency-input>

    <b-row class="title">
      <h2>Viajes</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras visualizar
          y consultar información sobre los viajes
        </p>
      </div>
    </b-row>

    <b-row>
      <b-col lg="3" md="auto">
        <el-button
          class="button-add"
          type="success"
          @click=" typeof page !== 'undefined' ? goTo('../logistica-manage') : goTo('logistica-manage')"
          :disabled="auth.rol != 1 && auth.rol != 3"
          ><i class="fas fa-plus"></i>Crear un nuevo viaje</el-button
        >
      </b-col>
    </b-row>

    <!-- This b-row ahead is for search functionality  -->
    <b-row>
      <b-col lg="12" md="auto">
        <div class="search-container">
          <div>
            <el-input placeholder="Buscar" v-model="toSearch"></el-input>
          </div>
          <div>
            <el-button
              class="button-search"
              type="success"
              @click="search(5, { params: { size: 5, search: toSearch } })"
              ><i class="fas fa-search"></i
            ></el-button>
          </div>
        </div>
      </b-col>
    </b-row>

    <b-row>
      <b-col lg="1" md="auto">
        <el-button class="button-reset" type="success" @click="reset()"
          ><i class="fas fa-list"></i>Mostrar todos</el-button
        >
      </b-col>
    </b-row>
    <!-- Ends b-row for search functionality  -->

    <el-table
      v-if="!isLoading"
      :data="tableData"
      border
      class="table-main"
      style="width: 100%"
      max-height="420"
    >
      <el-table-column
        width="120"
        prop="numero_factura"
        label="# factura"
        sortable
      >
        <template slot-scope="scope">
          <div v-if="scope.row.numero_factura != null">
            {{ scope.row.numero_factura.toUpperCase() }}
          </div>
          <el-tag type="danger" v-else>N/A</el-tag>
        </template>
      </el-table-column>
      <el-table-column width="120" prop="numero_orden" label="# Orden">
        <template slot-scope="scope">
          <div v-if="scope.row.numero_orden != null">
            {{ scope.row.numero_orden.toUpperCase() }}
          </div>
          <el-tag type="danger" v-else>N/A</el-tag>
        </template>
      </el-table-column>
      <el-table-column width="250" prop="encargado" label="Encargado" sortable>
        <template slot-scope="scope">
          <el-tag effect="dark" size="mini" v-if="scope.row.encargado != null">
            {{ scope.row.encargado.name.toUpperCase() }}
          </el-tag>
          <el-tag type="danger" v-else>N/A</el-tag>
        </template>
      </el-table-column>
      <el-table-column width="120" prop="fecha" label="Fecha" sortable>
        <template slot-scope="scope">
          <div v-if="scope.row.fecha != null">
            {{ scope.row.fecha.toUpperCase() }}
          </div>
          <el-tag type="danger" v-else>N/A</el-tag>
        </template>
      </el-table-column>
      <el-table-column width="120" prop="vehiculo" label="Vehiculo">
        <template slot-scope="scope">
          <el-tag
            effect="dark"
            type="warning"
            size="mini"
            v-if="scope.row.vehiculo != null"
          >
            {{ scope.row.vehiculo.placa.toUpperCase() }}
          </el-tag>
          <el-tag type="danger" v-else>N/A</el-tag>
        </template>
      </el-table-column>
      <el-table-column width="270" prop="conductor" label="Conductor">
        <template slot-scope="scope">
          <div v-if="scope.row.conductor != null">
            {{ scope.row.conductor.nombre.toUpperCase() }}
          </div>
          <el-tag type="danger" v-else>N/A</el-tag>
        </template>
      </el-table-column>
      <el-table-column width="200" prop="origen" label="Origen">
        <template slot-scope="scope">
          <div v-if="scope.row.origen_obj != null">
            {{ scope.row.origen_obj.nombre.toUpperCase() }}
          </div>
          <el-tag type="danger" v-else>N/A</el-tag>
        </template>
      </el-table-column>
      <el-table-column width="200" prop="destino" label="Destino">
        <template slot-scope="scope">
          <div v-if="scope.row.destino_obj != null">
            {{ scope.row.destino_obj.nombre.toUpperCase() }}
          </div>
          <el-tag type="danger" v-else>N/A</el-tag>
        </template>
      </el-table-column>
      <el-table-column
        width="120"
        prop="total"
        label="factura_total"
        fixed="right"
      >
        <template slot-scope="scope">
          <b style="font-size: 15px">{{ scope.row.factura_total | Flete }}</b>
        </template>
      </el-table-column>
      <el-table-column width="150" prop="estado" label="Estado" fixed="right" sortable>
        <template slot-scope="scope">
          <el-dropdown @command="changeState($event, scope.row)">
            <el-button
              :disabled="scope.row.estado == 'liquidado'"
              size="small"
              :type="scope.row.estado == 'en proceso' ? 'warning' : 'success'"
            >
              {{ scope.row.estado
              }}<i class="el-icon-arrow-down el-icon--right"></i>
            </el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item command="en proceso"
                >En proceso</el-dropdown-item
              >
              <el-dropdown-item command="liquidado">Liquidado</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </template>
      </el-table-column>
      <el-table-column fixed="right" label="Operations" width="250">
        <template slot-scope="scope">
          <el-button
            v-b-modal.modal-1
            type="primary"
            size="mini"
            :disabled="auth.rol != 1 && auth.rol != 3"
            @click="changeLogistic(scope.row)"
            >Ver mas..
          </el-button>
          <el-button
            type="primary"
            icon="el-icon-edit"
            size="mini"
            @click="goTo('/logistica-manage/'+ currentPage +'/'+ scope.row.id)"
            :disabled="
              (auth.rol != 1 && auth.rol != 3) ||
              scope.row.estado == 'liquidado'
            "
          ></el-button>
          <el-button
            type="danger"
            icon="el-icon-delete"
            size="mini"
            :disabled="
              (auth.rol != 1 && auth.rol != 3) ||
              scope.row.estado == 'liquidado'
            "
            @click="deleteLogistic(scope.row.id)"
          ></el-button>
        </template>
      </el-table-column>
    </el-table>

    <Spinner size="120" v-if="isLoading" />

    <b-row class="paginator-main">
      <b-col></b-col>
      <b-col align-self="center">
        <el-pagination
          @size-change="getLogistic"
          @current-change="getLogisticPerPage"
          :current-page.sync="currentPage"
          :page-sizes="[50, 100, 200, 500]"
          :page-size="sizeData"
          layout="sizes, prev, pager, next"
          :total="totalData"
        >
        </el-pagination>
      </b-col>
      <b-col></b-col>
    </b-row>
    <!-- MODAL PARA LOGISTICA -->
    <el-dialog title="Visualización" :visible.sync="dialogVisible" width="50%">
      <b-row>
        <b-col md="6" sm="12">
          <h2><b>TRANSGIRAR</b></h2>
          <b><h5>Transporte global</h5></b>
        </b-col>
        <b-col md="6" sm="12">
          <h5>Logistica # {{ logisticSelected.id }}</h5>
        </b-col>
      </b-row>
      <b-row>
        <b-col md="12" sm="12">
          <table class="default" style="width: 100%" border>
            <tr>
              <td><b>FECHA</b></td>

              <td>{{ logisticSelected.fecha }}</td>
            </tr>
          </table>
        </b-col>
      </b-row>
      <br />
      <b-row>
        <b-col md="12" sm="12">
          <table class="default" style="width: 100%" border>
            <tr>
              <td><b>FACTURA</b></td>

              <td style="background-color: ">
                {{ logisticSelected.numero_factura }}
              </td>
            </tr>

            <tr>
              <td><b>ORDEN</b></td>

              <td>{{ logisticSelected.numero_orden }}</td>
            </tr>

            <tr>
              <td><b>REMISION</b></td>

              <td>{{ logisticSelected.numero_factura_cliente }}</td>
            </tr>
          </table>
        </b-col>
      </b-row>
      <br />
      <b-row>
        <b-col md="6" sm="12">
          <table class="default" style="width: 100%" border>
            <tr>
              <td><b>ENCARGADO</b></td>
            </tr>

            <tr>
              {{
                logisticSelected.encargado
                  ? logisticSelected.encargado.name.toUpperCase()
                  : ""
              }}
            </tr>

            <tr>
              {{
                logisticSelected.encargado
                  ? logisticSelected.encargado.email.toUpperCase()
                  : ""
              }}
            </tr>

            <tr style="font-size: 12px">
              {{
                logisticSelected.encargado
                  ? logisticSelected.encargado.user.rol.toUpperCase()
                  : ""
              }}
            </tr>
          </table>
        </b-col>
        <b-col md="6" sm="12">
          <table class="default" style="width: 100%" border>
            <tr>
              <td><b>CLIENTE</b></td>
            </tr>

            <tr>
              {{
                logisticSelected.cliente
                  ? logisticSelected.cliente.razonSocial.toUpperCase()
                  : ""
              }}
            </tr>

            <tr>
              {{
                logisticSelected.cliente
                  ? logisticSelected.cliente.nombre.toUpperCase()
                  : ""
              }}
            </tr>

            <tr>
              {{
                logisticSelected.cliente
                  ? logisticSelected.cliente.nit.toUpperCase()
                  : ""
              }}
            </tr>
          </table>
        </b-col>
      </b-row>
      <br />
      <b-row>
        <b-col md="6" sm="12">
          <table class="default" style="width: 100%" border>
            <tr>
              <td><b>VEHICULO</b></td>
            </tr>

            <tr>
              <td><b>PLACA</b></td>

              <td>
                {{
                  logisticSelected.vehiculo
                    ? logisticSelected.vehiculo.placa.toUpperCase()
                    : ""
                }}
              </td>
            </tr>

            <tr>
              <td><b>TIPO</b></td>

              <td>
                {{
                  logisticSelected.vehiculo
                    ? logisticSelected.vehiculo.tipo.toUpperCase()
                    : ""
                }}
              </td>
            </tr>
          </table>
        </b-col>
        <b-col md="6" sm="12">
          <table class="default" style="width: 100%" border>
            <tr>
              <td><b>CONDUCTOR</b></td>
            </tr>

            <tr>
              <td><b>NOMBRE</b></td>

              <td>
                {{
                  logisticSelected.conductor
                    ? logisticSelected.conductor.nombre.toUpperCase()
                    : ""
                }}
              </td>
            </tr>

            <tr>
              <td><b>ID</b></td>

              <td>
                {{
                  logisticSelected.conductor
                    ? logisticSelected.conductor.cedula
                    : ""
                }}
              </td>
            </tr>

            <tr>
              <td><b>CELULAR</b></td>

              <td>
                {{
                  logisticSelected.conductor
                    ? logisticSelected.conductor.celular.toUpperCase()
                    : ""
                }}
              </td>
            </tr>
          </table>
        </b-col>
      </b-row>
      <br />
      <b-row>
        <b-col md="12" sm="12">
          <table class="default" style="width: 100%" border>
            <tr>
              <td><b>TIPO DE VEHICULO</b></td>

              <td>
                {{
                  logisticSelected.tipo
                    ? logisticSelected.tipo.tipo.toUpperCase()
                    : ""
                }}
              </td>
            </tr>

            <tr>
              <td><b>TIPO DE CARGA</b></td>

              <td>
                {{
                  logisticSelected.carga
                    ? logisticSelected.carga.tipoCarga.toUpperCase()
                    : ""
                }}
              </td>
            </tr>
          </table>
        </b-col>
      </b-row>
      <br />
      <b-row>
        <b-col md="2" sm="6">
          <i class="fas fa-map-marker-alt fa-2x"></i>
          <br />
          <b>DESDE</b>
          <p>
            {{
              logisticSelected.origen_obj
                ? logisticSelected.origen_obj.nombre
                : ""
            }}
          </p>
        </b-col>
        <b-col md="8" sm="0"> </b-col>
        <b-col md="2" sm="6">
          <i class="fas fa-map-marker-alt fa-2x"></i>
          <br />
          <b>HASTA</b>
          <p>
            {{
              logisticSelected.destino_obj
                ? logisticSelected.destino_obj.nombre
                : ""
            }}
          </p>
        </b-col>
      </b-row>
      <b-row>
        <b-col md="12" sm="12">
          <table class="default" style="width: 100%" border>
            <tr>
              <td><b>VALORES ADICIONALES</b></td>
            </tr>
          </table>
          <table class="default" style="width: 100%" border>
            <tr
              v-for="item in logisticSelected.extra
                ? logisticSelected.extra
                : []"
              :key="item"
            >
              <td>
                <b>{{ item.description }}</b>
              </td>

              <td>
                {{ item.value | Flete }}
              </td>
            </tr>
          </table>
        </b-col>
      </b-row>
      <br>
      <b-row>
        <b-col md="12" sm="12">
          <table class="default" style="width: 100%" border>
            <tr>
              <td><b>DESCRIPCIÓN</b></td>
            </tr>
            <td>
              {{
                logisticSelected.descripcion
              }}
            </td>
          </table>
        </b-col>
      </b-row>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="dialogVisible = false">OK</el-button>
      </span>
    </el-dialog>
  </div>
</template>


<script>
import Spinner from "../spinner/spinner.vue";
export default {
  components: {
    Spinner,
  },
  props: ["auth","page"],
  data() {
    return {
      toSearch: "",
      dialogVisible: false,
      isLoading: false,
      currentPage: null,
      sizeData: null,
      totalData: null,
      tableData: [],
      logisticSelected: {},
    };
  },
  filters: {
    Flete(valor) {
      return `$${valor.toLocaleString()}`;
    },
  },
  created() {
    this.currentPage = this.page;
    this.getLogistic(50, this.page);
  },
  methods: {
    changeLogistic(logistic) {
      console.log(logistic);
      this.dialogVisible = true;
      this.logisticSelected = logistic;
      this.logisticSelected.extra = JSON.parse(this.logisticSelected.extra);
    },
    reset() {
      this.currentPage = 1;
      this.toSearch = "";
      this.isSearchingFor = "";
      this.getLogistic(50, 1);
    },

    search(size, param) {
      this.sizeData = size;
      this.isLoading = true;
      axios
        .get("/api/logistica/search", param)
        .then((response) => {
          //console.log(response)
          this.tableData = response.data.data;
          this.sizeData = response.data.per_page;
          this.totalData = response.data.total;
          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
          this.swal({
            title: "Algo salio mal",
            text: "Por favor intentelo nuevamente",
            icon: "error",
            button: "OK",
          });
        });
    },

    getLogistic(size, toPage=1 ) {
      if (this.toSearch != "") {
        this.search(this.sizeData, {
          params: { page: this.currentPage, size: size, search: this.toSearch },
        });
      } else {
        this.currentPage = toPage;
        this.sizeData = size;
        this.isLoading = true;

        axios
          .get("/api/logistica", { params: { page: toPage, size: size } })
          .then((response) => {
            this.tableData = response.data.data;
            this.sizeData = response.data.per_page;
            this.totalData = response.data.total;
            this.isLoading = false;
          })
          .catch((error) => {
            this.isLoading = false;
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      }
    },

    getLogisticPerPage(page) {
      this.currentPage = page;
      this.isLoading = true;

      if (this.toSearch != "") {
        this.search(this.sizeData, {
          params: { page: page, size: this.sizeData, search: this.toSearch },
        });
      } else {
        axios
          .get("/api/logistica", {
            params: { page: page, size: this.sizeData },
          })
          .then((response) => {
            this.tableData = response.data.data;
            this.sizeData = response.data.per_page;
            this.totalData = response.data.total;
            this.isLoading = false;
          })
          .catch((error) => {
            this.isLoading = false;
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      }
    },

    changeState(state, logistic) {
      this.isLoading = true;

      axios
        .get("/api/logistica-status", {
          params: { id: logistic.id, estado: state },
        })
        .then((response) => {
          logistic.estado = state;
          this.swal({
            title: "El estado se ha actualizado correctamente",
            icon: "success",
          });
        })
        .catch((error) => {
          this.isLoading = false;
          this.swal({
            title: "Algo salio mal",
            text: "Por favor ingrese los datos completos de LOGISTICA e intentelo nuevamente",
            icon: "error",
            button: "OK",
          });
        });

      this.isLoading = false;
    },

    deleteLogistic(id) {
      this.swal({
        title: "Atencion!",
        text: "Esta seguro que desea eliminar esta logistica?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          axios
            .delete("/api/logistica", {
              params: { id: id },
            })
            .then((response) => {
              this.getLogistic(this.sizeData, this.currentPage);
            })
            .catch((error) => {
              this.isLoading = false;
              this.swal({
                title: "Algo salio mal",
                text: "Por favor intentelo nuevamente",
                icon: "error",
                button: "OK",
              });
            });
        }
      });
    },

    goTo(location) {
      window.location.href = location;
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

.button-add {
  width: 100%;
  background-color: #007900;

  &:hover {
    background-color: #019901;
  }
}

.search-container {
  display: flex;
  margin-top: 20px;
}

.table-main {
  margin-top: 20px;
}

.paginator-main {
  margin-top: 20px;
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

::v-deep .el-table td {
  padding: 3px;
}

::v-deep .button-search {
  background-color: #007900;
  margin: 0 20px 0 20px;
  height: 40px;
  width: 40px;
  padding-left: 10px;
  padding-top: 0;
  padding-right: 0;
  padding-bottom: 0;

  &:hover {
    background-color: #019901;
  }
}

.button-reset {
  background-color: #007900;
  margin-top: 10px;
  height: 30px;
  padding-left: 10px;
  padding-top: 0;
  padding-bottom: 0;

  &:hover {
    background-color: #019901;
  }
}
</style>