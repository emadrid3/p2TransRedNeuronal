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
      <el-table-column prop="fecha" label="Fecha" sortable> </el-table-column>
      <el-table-column prop="origen" label="Origen"> </el-table-column>
      <el-table-column prop="destino" label="Destino"> </el-table-column>
      <el-table-column prop="conductor" label="Conductor"> </el-table-column>
      <el-table-column prop="vehiculo" label="Vehiculo"> </el-table-column>
      <el-table-column
        prop="estado"
        label="Estado"
        :filters="[
          { text: 'Pago', value: 'Pago' },
          { text: 'Pendiente Pago', value: 'Pendiente Pago' },
          { text: 'Pendiente facturar', value: 'Pendiente facturar' },
        ]"
      >
        <template slot-scope="scope">
          <el-dropdown >
            <el-button size="small" :type="scope.row.estado == 'En proceso' ? 'warning':'success'">
              {{scope.row.estado}}<i class="el-icon-arrow-down el-icon--right"></i>
            </el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>En proceso</el-dropdown-item>
              <el-dropdown-item>Liquidado</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </template>
      </el-table-column>
      <el-table-column label="Operations" width="250">
        <template>
          <el-button type="primary" size="mini">Ver mas..</el-button>
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
    },
  },
  data() {
    return {
      tableData: [
        {
          fecha: "17/07/2021",
          origen: "Medellin",
          destino: "Cali",
          conductor: "JUAN FERNANDO AGUDELO",
          vehiculo: "SMG045",
          estado: "En proceso",
        },
        {
          fecha: "11/07/2021",
          origen: "Cartagena",
          destino: "Medellin",
          conductor: "HECTOR MAURICIO BEDOYA",
          vehiculo: "TMZ466",
          estado: "En proceso",
        },
        {
          fecha: "12/07/2021",
          origen: "Barranquilla",
          destino: "Medellin",
          conductor: "NICOLAS ANTONIO ALVAREZ",
          vehiculo: "STE402",
          estado: "Liquidado",
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