<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Logistica</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de viajes</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Logistica</h2>

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
          @click="goTo('logistica-manage')"
          :disabled="auth.rol != 1 && auth.rol != 3 "
          ><i class="fas fa-plus"></i>Crear un nuevo viaje</el-button
        >
      </b-col>
    </b-row>

    <el-table
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
      </el-table-column>
      <el-table-column width="120" prop="numero_orden" label="# Orden">
      </el-table-column>
      <el-table-column width="250" prop="encargado" label="Encargado">
        <template slot-scope="scope">
          <el-tag effect="dark" size="mini">
            {{ scope.row.encargado.name.toUpperCase() }}
          </el-tag>
        </template>
      </el-table-column>
      <el-table-column width="120" prop="fecha" label="Fecha">
      </el-table-column>
      <el-table-column width="120" prop="vehiculo" label="Vehiculo">
        <template slot-scope="scope">
          <el-tag effect="dark" type="warning" size="mini">
            {{ scope.row.vehiculo.placa.toUpperCase() }}
          </el-tag>
        </template>
      </el-table-column>
      <el-table-column width="270" prop="conductor" label="Conductor">
        <template slot-scope="scope">
          {{ scope.row.conductor.nombre.toUpperCase() }}
        </template>
      </el-table-column>
      <el-table-column width="200" prop="origen" label="Origen">
        <template slot-scope="scope">
          {{ scope.row.origen_obj.nombre.toUpperCase() }}
        </template>
      </el-table-column>
      <el-table-column width="200" prop="destino" label="Destino">
        <template slot-scope="scope">
          {{ scope.row.destino_obj.nombre.toUpperCase() }}
        </template>
      </el-table-column>
      <el-table-column width="350" prop="cliente" label="Cliente">
        <template slot-scope="scope">
          <el-tag effect="dark" size="mini">
            {{ scope.row.cliente.razonSocial.toUpperCase() }}
          </el-tag>
        </template>
      </el-table-column>
      <el-table-column
        width="120"
        prop="total"
        label="factura_total"
        fixed="right"
      >
        <template slot-scope="scope">
          <b style="font-size: 18px">{{ scope.row.factura_total | Flete }}</b>
        </template>
      </el-table-column>
      <el-table-column width="150" prop="estado" label="Estado" fixed="right">
        <template slot-scope="scope">
          <el-dropdown>
            <el-button
              size="small"
              :type="scope.row.estado == 'En proceso' ? 'warning' : 'success'"
            >
              {{ scope.row.estado
              }}<i class="el-icon-arrow-down el-icon--right"></i>
            </el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>En proceso</el-dropdown-item>
              <el-dropdown-item>Liquidado</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </template>
      </el-table-column>
      <el-table-column fixed="right" label="Operations" width="250">
        <template>
          <el-button
            type="primary"
            size="mini"
            :disabled="auth.rol != 1 && auth.rol != 3"
            >Ver mas..
          </el-button>
          <el-button
            type="primary"
            icon="el-icon-edit"
            size="mini"
            :disabled="auth.rol != 1 && auth.rol != 3"
          ></el-button>
          <el-button
            type="danger"
            icon="el-icon-delete"
            size="mini"
            :disabled="auth.rol != 1 && auth.rol != 3"
          ></el-button>
        </template>
      </el-table-column>
    </el-table>

    <b-row class="paginator-main">
      <b-col></b-col>
      <b-col align-self="center">
        <el-pagination
          @size-change="getLogistic"
          @current-change="handleCurrentChange"
          :current-page.sync="currentPage"
          :page-sizes="[100, 200, 300, 400]"
          :page-size="sizeData"
          layout="sizes, prev, pager, next"
          :total="totalData"
        >
        </el-pagination>
      </b-col>
      <b-col></b-col>
    </b-row>
  </div>
</template>

<script>
import Spinner from "../spinner/spinner.vue";
export default {
  components: {
    Spinner,
  },
  props: ["auth"],
  data() {
    return {
      toSearch: "",
      isLoading: false,
      currentPage: null,
      sizeData: null,
      totalData: null,
      tableData: [],
    };
  },
  filters: {
    Flete(valor) {
      return `$${valor.toLocaleString()}`;
    },
  },
  created() {
    this.getLogistic(5);
  },
  methods: {
    getLogistic(size) {
      if (this.toSearch != "") {
        this.search(this.sizeData, {
          params: { page: this.currentPage, size: size, search: this.toSearch },
        });
      } else {
        this.currentPage = 1;
        this.sizeData = size;
        this.isLoading = true;

        axios
          .get("/api/logistica", { params: { size: size } })
          .then((response) => {
            console.log(response);
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
          .get("/api/vehiculos/search", {
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
</style>