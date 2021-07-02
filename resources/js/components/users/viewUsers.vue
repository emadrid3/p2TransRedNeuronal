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
                <p><i class="fas fa-info-circle"></i>Desde esta ventana podras visualizar y consultar información sobre los usuarios</p>
            </div>
        </b-row>

        <b-row>
            <b-col lg="3" md="auto">
                <el-button class="button-add" type="success" @click="goTo('usuarios-manage')"><i class="fas fa-plus" ></i>Crear un nuevo usuario</el-button>
            </b-col>
        </b-row>

        <el-table
            :data="tableData"
            border
            class="table-main"
            style="width: 100%"
            max-height="420">
            <el-table-column
            prop="nombre"
            label="Nombre Completo">
            </el-table-column>
            <el-table-column
            prop="rol"
            label="rol">
            </el-table-column>
            <el-table-column
            prop="estado"
            label="Estado">
            <template slot-scope="scope">
                <el-tag>{{scope.row.estado}}</el-tag>
            </template>
            </el-table-column>
            <el-table-column
            label="Operations"
            width="250">
            <template>
                <el-button type="primary" size="mini">Ver..</el-button>
                <el-button type="primary" icon="el-icon-edit" size="mini"></el-button>
                <el-button type="primary" icon="el-icon-delete" size="mini"></el-button>
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
                :total="1000">
                </el-pagination>
            </b-col>
            <b-col></b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            goTo(location){
                window.location.href = location;
            },

            deleteRow(index, rows) {
                rows.splice(index, 1);
            }
        },
        data() {
        return {
            tableData: [{
            nombre: 'Pedro Hoyos',
            rol: 'Gerente',
            estado: 'Activo',
            },
            {
            nombre: 'Cristian Aristizabal Giraldo',
            rol: 'Contador',
            estado: 'Activo',
            },
            {
            nombre: 'Andres Gil',
            rol: 'Administrador',
            estado: 'Activo',
            },
            {
            nombre: 'Emanuel Madrid Restrepo',
            rol: 'Sistemas',
            estado: 'Activo',
            }]
        }
        }
    }
</script>

<style lang="scss" scoped>

.title{
    margin-top: 20px;
    margin-left: 0px;
    display: flex;
    flex-direction: column;
}

.button-add{
    width: 100%;
    background-color: #007900;

    &:hover{
        background-color: #019901;
    }
}

.table-main{
    margin-top: 20px;
}

.paginator-main{
    margin-top: 20px ;
}


::v-deep .el-table th, .el-table tr{
    background-color: #007900;
    color: white;
    font-weight: normal;
    border: none;
}

::v-deep .el-table tbody, .el-table tr{
    font-size: 12px;
    font-weight: normal;
}   

::v-deep .el-table td{
    padding: 3px;
} 
</style>
