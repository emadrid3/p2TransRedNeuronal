<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Historial</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Eventos</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras gestionar
          los eventos
        </p>
      </div>
    </b-row>

    <!-- This b-row ahead is for search functionality  -->
    <b-row>
      <b-col lg="12" md="auto">
        <div>
          <p>
            <b>X1</b> Recibe 1 si se abrio la tapa o 0 si no se abrio la tapa
          </p>
          <el-input placeholder="Buscar" v-model="data.x1"></el-input>
        </div>
      </b-col>
    </b-row>
    <br />
    <br />
    <b-row>
      <b-col lg="12" md="auto">
        <div>
          <p>
            <b>X2</b> Recibe 1 si la tapa fue abierta fuera de una estación de
            gasolina o 0 si la tapa se abrio dentro de una estación de gasolina
          </p>
          <el-input placeholder="Buscar" v-model="data.x2"></el-input>
        </div>
      </b-col>
    </b-row>
    <br />
    <br />
    <b-row>
      <b-col lg="12" md="auto">
        <div>
          <p>
            <b>X3</b> Recibe 1 si tenia que tanquear o 0 si no tenia que
            tanquear
          </p>
          <el-input placeholder="Buscar" v-model="data.x3"></el-input>
        </div>
      </b-col>
    </b-row>
    <br />
    <br />
    <b-row>
      <b-col lg="12" md="auto">
        <div>
          <p>
            <b>X4</b> Recibe 1 si llega con la cantidad de gasolina aprox que
            deberia de haber llegado o 0 Si no llego con la cantidad de gasolina
            que deberia de haber llegado
          </p>
          <el-input placeholder="Buscar" v-model="data.x4"></el-input>
        </div>
      </b-col>
    </b-row>
    <br />

    <b-row>
      <b-col lg="6" md="auto">
        <el-button type="success" size="large" @click="send"
          >Enviar <i class="fas fa-save"></i
        ></el-button>
      </b-col>
      <b-col lg="6" md="auto">
        <h1>El resultado es:</h1>
      </b-col>
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
      data: {
        x1: 0,
        x2: 0,
        x3: 0,
        x4: 0,
      },
      result: 0,
    };
  },

  methods: {
    send() {
      axios
        .post(
          "http://138.197.57.237/perceptron/" +
            this.data.x1 +
            "/" +
            this.data.x2 +
            "/" +
            this.data.x3 +
            "/" +
            this.data.x4, {
                headers: {"Access-Control-Allow-Origin" : "*"}
            }
        )
        .then((response) => {
          console.log(response);
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