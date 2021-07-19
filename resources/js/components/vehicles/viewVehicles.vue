<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Vehiculos</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de vehiculos</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Vehiculos</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras visualizar
          y consultar información sobre los conductores
        </p>
      </div>
    </b-row>

    <b-row>
      <b-col lg="3" md="auto">
        <el-button
          class="button-add"
          type="success"
          @click="goTo('vehiculos-manage')"
          ><i class="fas fa-plus"></i>Crear un nuevo vehiculo</el-button
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
      <el-table-column prop="nombre" label="Nombre"> </el-table-column>
      <el-table-column prop="cedula" label="Cedula"> </el-table-column>
      <el-table-column prop="celular" label="Celular"> </el-table-column>
      <el-table-column prop="estado" label="estado">
        <template slot-scope="scope">
          <el-tag>{{ scope.row.estado }}</el-tag>
        </template>
      </el-table-column>
      <el-table-column label="Operations" width="250">
        <template>
          <el-button type="primary" size="mini">Ver..</el-button>
          <el-button type="primary" icon="el-icon-edit" size="mini"></el-button>
          <el-button
            type="primary"
            icon="el-icon-delete"
            size="mini"
          ></el-button>
        </template>
      </el-table-column>
    </el-table>

    <b-row class="paginator-main">
      <b-col></b-col>
      <b-col align-self="center">
        <el-pagination
          @size-change="handleSizeChange"
          @current-change="handleCurrentChange"
          :current-page.sync="currentPage2"
          :page-sizes="[100, 200, 300, 400]"
          :page-size="100"
          layout="sizes, prev, pager, next"
          :total="1000"
        >
        </el-pagination>
      </b-col>
      <b-col></b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    deleteRow(index, rows) {
      rows.splice(index, 1);
    },
    goTo(location) {
      window.location.href = location;
    }
  },
  data() {
    return {
      tableData: [
        {
          nombre: "JUAN FERNANDO AGUDELO",
          cedula: "1.037.789",
          celular: "+57 301 380 9053",
          estado: "Activo",
        },
        {
          nombre: "LUIS CARLOS SALDARRIAGA",
          cedula: "70.237.789",
          celular: "+57 321 380 9053",
          estado: "Activo",
        },
        {
          nombre: "HECTOR MAURICIO BEDOYA",
          cedula: "80.707.789",
          celular: "+57 311 680 9053",
          estado: "Activo",
        },
        {
          nombre: "CARLOS MARIO PUERTA",
          cedula: "21.707.789",
          celular: "+57 321 680 4444",
          estado: "Activo",
        },
        {
          nombre: "WILSON RICARDO BEDOYA",
          cedula: "77.507.999",
          celular: "+57 301 550 4444",
          estado: "Activo",
        },
        {
          nombre: "NICOLAS ANTONIO ALVAREZ",
          cedula: "80.507.999",
          celular: "+57 301 550 4444",
          estado: "Activo",
        },
        {
          nombre: "JUAN FERNANDO AGUDELO",
          cedula: "1.037.789",
          celular: "+57 301 380 9053",
          estado: "Activo",
        },
        {
          nombre: "LUIS CARLOS SALDARRIAGA",
          cedula: "70.237.789",
          celular: "+57 321 380 9053",
          estado: "Activo",
        },
        {
          nombre: "HECTOR MAURICIO BEDOYA",
          cedula: "80.707.789",
          celular: "+57 311 680 9053",
          estado: "Activo",
        },
        {
          nombre: "CARLOS MARIO PUERTA",
          cedula: "21.707.789",
          celular: "+57 321 680 4444",
          estado: "Activo",
        },
        {
          nombre: "WILSON RICARDO BEDOYA",
          cedula: "77.507.999",
          celular: "+57 301 550 4444",
          estado: "Activo",
        },
        {
          nombre: "NICOLAS ANTONIO ALVAREZ",
          cedula: "80.507.999",
          celular: "+57 301 550 4444",
          estado: "Activo",
        },
      ],
    };
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
