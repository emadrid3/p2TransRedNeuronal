<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Facturas</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de facturas</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Facturas</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras visualizar
          y consultar información sobre las facturas
        </p>
      </div>
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
      <el-table-column prop="numeroFactura" label="# Factura"> </el-table-column>
      <el-table-column prop="numeroOrden" label="# Orden"> </el-table-column>
      <el-table-column prop="flete" label="Flete">
        <template slot-scope="scope">
          <b style="font-size: 15px">{{ scope.row.flete | Flete }}</b>
        </template>
      </el-table-column>
      <el-table-column prop="anticipo" label="Anticipo">
        <template slot-scope="scope">
          <b style="font-size: 15px">{{ scope.row.anticipo | Flete }}</b>
        </template>
      </el-table-column>
      <el-table-column prop="porcentaje" label="Porcentaje">
        <template slot-scope="scope">
          <b style="font-size: 15px">{{ scope.row.porcentaje | Flete }}</b>
        </template>
      </el-table-column>
      <el-table-column prop="valorAdicional" label="Valor Extra">
        <template slot-scope="scope">
          <b style="font-size: 15px">{{ scope.row.valorAdicional | Flete }}</b>
        </template>
      </el-table-column>
      <el-table-column prop="valorFactura" label="Valor factura" sortable>
        <template slot-scope="scope">
          <b style="font-size: 15px">{{ scope.row.valorFactura | Flete }}</b>
        </template> 
      </el-table-column>
      <el-table-column
        prop="estado"
        label="Estado"
        width="180"
        :filters="[
          { text: 'Pago', value: 'Pago' },
          { text: 'Pendiente Pago', value: 'Pendiente Pago' },
          { text: 'Pendiente facturar', value: 'Pendiente facturar' },
        ]"
      >
        <template slot-scope="scope">
          <el-dropdown @command="changeState($event, scope.row)">
            <el-button size="small" :type="scope.row.estado == 'pendiente de pago' ? 'danger':'success'">
              {{scope.row.estado}}<i class="el-icon-arrow-down el-icon--right"></i>
            </el-button>
            <el-dropdown-menu slot="dropdown" >
              <el-dropdown-item command="pendiente de pago">Pendiente de pago</el-dropdown-item>
              <el-dropdown-item command="pagado">pagado</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </template>
      </el-table-column>
      <el-table-column label="Operations" width="100">
        <template slot-scope="scope">
          <el-button
            type="danger"
            icon="el-icon-delete"
            size="mini"
            @click="deleteInvoice(scope.row.id)"
          ></el-button>
        </template>
      </el-table-column>
    </el-table>

    <Spinner size="120" v-if="isLoading" />

    <b-row class="paginator-main">
      <b-col></b-col>
      <b-col align-self="center">
        <el-pagination
          @size-change="getInvoice"
          @current-change="getInvoicePerPage"
          :current-page.sync="currentPage"
          :page-sizes="[5, 10, 20, 50]"
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
import Spinner from "./../spinner/spinner.vue";
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
    this.getInvoice(5);
  },
  methods: {
    reset() {
      this.currentPage = 1;
      this.toSearch = "";
      this.isSearchingFor = "";
      this.getCustomers(5);
    },

    search(size, param) {
      this.sizeData = size;
      this.isLoading = true;
      axios
        .get("/api/factura/search", param)
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

    goTo(location) {
      window.location.href = location;
    },
    getInvoice(size) {
      if (this.toSearch != "") {
        this.search(this.sizeData, {
          params: { page: this.currentPage, size: size, search: this.toSearch },
        });
      } else {
        this.currentPage = 1;
        this.sizeData = size;
        this.isLoading = true;
        axios
          .get("/api/factura", { params: { size: size } })
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

    getInvoicePerPage(page) {
      this.currentPage = page;
      this.isLoading = true;

      if (this.toSearch != "") {
        this.search(this.sizeData, {
          params: { page: page, size: this.sizeData, search: this.toSearch },
        });
      } else {
        axios
          .get("/api/factura", {
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

    deleteInvoice(id) {
      this.swal({
        title: "Atencion!",
        text: "Esta seguro que desea eliminar esta factura?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          axios
            .delete("/api/factura", {
              params: { id: id },
            })
            .then((response) => {
              this.getInvoicePerPage(this.currentPage);
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

    changeState(state, logistic) {
      this.isLoading = true;

      axios
        .get("/api/factura-status", {
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
            text: "Por favor intentelo nuevamente",
            icon: "error",
            button: "OK",
          });
        });

      this.isLoading = false;
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

.search-container {
  display: flex;
  margin-top: 20px;
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