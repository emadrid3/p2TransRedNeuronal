<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Historial</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Historial</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras visualizar
          y consultar información sobre los historiales
        </p>
      </div>
    </b-row>

    <el-table
      :data="tableData"
      border
      class="table-main"
      style="width: 100%"
      max-height="420"
    >
      <el-table-column prop="nombre" label="Nombre"> </el-table-column>
      <el-table-column prop="nit" label="Nit"> </el-table-column>
      <el-table-column prop="numeroOrden" label="Numero de Orden">
      </el-table-column>
      <el-table-column prop="razonSocial" label="Razon social">
      </el-table-column>
      <el-table-column prop="estado" label="Estado">
        <template>
          <el-tag>Activo</el-tag>
        </template>
      </el-table-column>
    </el-table>

    <Spinner size="120" v-if="isLoading" />

    <b-row class="paginator-main">
      <b-col></b-col>
      <b-col align-self="center">
        <el-pagination
          @size-change="getCustomers"
          @current-change="getCustomerPerPage"
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
import Spinner from "../spinner/spinner.vue";
export default {
  components: {
    Spinner,
  },
  data() {
    return {
      isLoading: false,
      currentPage: null,
      sizeData: null,
      totalData: null,
      tableData: []
    };
  },
  created() {
    this.getCustomers(5);
  },
  methods: {
    goTo(location) {
      window.location.href = location;
    },
    getCustomers(size) {
      this.currentPage = 1;
      this.sizeData = size;
      this.isLoading = true;
      axios
        .get("/api/cliente", { params: { size: size } })
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
    },

    getCustomerPerPage(page) {
      this.currentPage = page;
      this.isLoading = true;
      axios
        .get("/api/cliente", { params: { page: page, size: this.sizeData } })
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