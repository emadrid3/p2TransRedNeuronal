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
            @click="search(5,{ params: { size: 5, search: toSearch } });"
            ><i class="fas fa-search"></i></el-button
          >
        </div>

      </div>
      </b-col>
    </b-row>

    <b-row>
      <b-col lg="1" md="auto">
        <el-button
          class="button-reset"
          type="success"
          @click="reset()"
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
      <el-table-column prop="fecha" label="Fecha" :min-width="65" sortable> </el-table-column>
      <el-table-column prop="placa" label="Placa" :width="80" sortable> </el-table-column>
      <el-table-column prop="tipoVehiculo" label="Tipo Vehiculo" :min-width="85" sortable>
      </el-table-column>
      <el-table-column prop="tipo" label="Tipo" :width="85" sortable>
      </el-table-column>
      <el-table-column prop="conductor" label="Conductor" :min-width="120" sortable>
      </el-table-column>
      <el-table-column prop="origen" label="Origen" sortable> </el-table-column>
      <el-table-column prop="destino" label="Destino" sortable> </el-table-column>
      <el-table-column prop="cliente" label="Cliente" :min-width="100" sortable> </el-table-column>
      <el-table-column prop="flete" label="Flete" :width="100" sortable>
        <template slot-scope="props">
          {{props.row.flete | Flete}}
        </template>
      </el-table-column>
    </el-table>

    <Spinner size="120" v-if="isLoading" />

    <b-row class="paginator-main">
      <b-col></b-col>
      <b-col align-self="center">
        <el-pagination
          @size-change="getHistories"
          @current-change="getHistoryPerPage"
          :current-page.sync="currentPage"
          :page-sizes="[5, 10, 20, 50, 200]"
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
      return `$${valor.toLocaleString()}`
    }
  },
  created() {
    this.getHistories(50);
  },
  methods: {

    reset(){
      this.currentPage = 1;
      this.toSearch = "";
      this.isSearchingFor = "";
      this.getHistories(50);
    },

    search(size, param){

      this.sizeData = size;
      this.isLoading = true;
      axios
        .get("/api/historial/search", param)
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
    getHistories(size) {

      if(this.toSearch != ""){
        
        this.search(this.sizeData,{ params: { page: this.currentPage, size: size, search: this.toSearch } });
      
      }else{

        this.currentPage = 1;
        this.sizeData = size;
        this.isLoading = true;
        axios
          .get("/api/historial", { params: { size: size } })
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

    getHistoryPerPage(page) {

      this.currentPage = page;
      this.isLoading = true;

      if(this.toSearch != ""){
        
        this.search(this.sizeData,{ params: { page: page, size: this.sizeData, search: this.toSearch } });
      
      }else{

        axios
          .get("/api/historial", { params: { page: page, size: this.sizeData } })
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
    }
  }
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

.search-container{
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