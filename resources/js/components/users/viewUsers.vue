<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Usuarios</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de usuarios</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Usuarios</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras visualizar
          y consultar información sobre los usuarios
        </p>
      </div>
    </b-row>

    <b-row>
      <b-col lg="3" md="auto">
        <el-button
          class="button-add"
          type="success"
          @click="goTo('usuarios-manage')"
          :disabled="auth.rol !=1"
          ><i class="fas fa-plus"></i>Crear un nuevo usuario</el-button
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
      <el-table-column prop="name" label="Nombre Completo" sortable> </el-table-column>
      <el-table-column prop="email" label="Correo"> </el-table-column>
      <el-table-column prop="rol" label="Rol" sortable>
        <template slot-scope="props">
          <el-tag> {{ props.row.user.rol }} </el-tag>
        </template>
      </el-table-column>
      <el-table-column label="Acciones" :width="130">
        <template slot-scope="props">
          <el-button
            type="primary"
            icon="el-icon-edit"
            size="mini"
            @click="goTo('/usuarios-manage/' + props.row.id)"
            :disabled="auth.rol !=1"
          ></el-button>
          <el-button
            @click="deleteUser(props.row.id)"
            type="danger"
            icon="el-icon-delete"
            size="mini"
            :disabled="auth.rol !=1"
          ></el-button>
        </template>
      </el-table-column>
    </el-table>

    <Spinner size="120" v-if="isLoading" />

    <b-row class="paginator-main">
      <b-col></b-col>
      <b-col align-self="center">
        <el-pagination
          @size-change="getUser"
          @current-change="getUserPerPage"
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
  created() {
    this.getUser(50);
  },
  methods: {

    reset(){
      this.currentPage = 1;
      this.toSearch = "";
      this.isSearchingFor = "";
      this.getUser(50);
    },

    search(size, param){

      this.sizeData = size;
      this.isLoading = true;
      axios
        .get("/api/usuarios/search", param)
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

    goTo(location) {
      window.location.href = location;
    },

    getUser(size) {

      if(this.toSearch != ""){
        
        this.search(this.sizeData,{ params: { page: this.currentPage, size: size, search: this.toSearch } });
      
      }else{

        this.currentPage = 1;
        this.sizeData = size;
        this.isLoading = true;

        axios
        .get("/api/usuarios", { params: { size: size } })
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

    getUserPerPage(page) {

      this.currentPage = page;
      this.isLoading = true;

      if(this.toSearch != ""){
        
        this.search(this.sizeData,{ params: { page: page, size: this.sizeData, search: this.toSearch } });
      
      }else{

        axios
        .get("/api/usuarios", { params: { page: page, size: this.sizeData } })
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

    deleteUser(id) {
      this.swal({
        title: "Atencion!",
        text: "Esta seguro que desea eliminar este usuario?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          axios
            .delete("/api/usuario", {
              params: { id: id },
            })
            .then((response) => {
              this.getUserPerPage(this.currentPage);
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
