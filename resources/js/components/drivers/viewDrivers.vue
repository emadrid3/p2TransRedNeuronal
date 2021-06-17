<template>
    <div>
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
            <el-breadcrumb-item>Conductores</el-breadcrumb-item>
            <el-breadcrumb-item>Lista de conductores</el-breadcrumb-item>
        </el-breadcrumb>

        <b-row class="title">
            <h2>Conductores</h2>

            <div class="title__info">
                <p><i class="fas fa-info-circle"></i>Desde esta ventana podras visualizar y consultar información sobre los conductores</p>
            </div>
        </b-row>

        <b-row>
            <b-col lg="3" md="auto">
                <el-button class="button-add" type="success"><i class="fas fa-plus"></i>Crear un nuevo conductor</el-button>
            </b-col>
        </b-row>

        <el-table
            :data="tableData"
            border
            class="table-main"
            style="width: 100%"
            max-height="420">
            <el-table-column
            prop="date"
            label="Date">
            </el-table-column>
            <el-table-column
            prop="name"
            label="Name">
            </el-table-column>
            <el-table-column
            prop="state"
            label="State">
            </el-table-column>
            <el-table-column
            prop="city"
            label="city">
            <template slot-scope="scope">
                <el-tag>{{scope.row.city}}</el-tag>
            </template>
            </el-table-column>
            <el-table-column
            prop="address"
            label="Address"
            width="200">
            </el-table-column>
            <el-table-column
            prop="zip"
            label="Zip">
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
      deleteRow(index, rows) {
            rows.splice(index, 1);
        }
        },
        data() {
        return {
            tableData: [{
            date: '2016-05-03',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-02',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-04',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-01',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-08',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-06',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-07',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            },{
            date: '2016-05-03',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-02',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-04',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-01',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-08',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            }, {
            date: '2016-05-06',
            name: 'Tom',
            state: 'California',
            city: 'Los Angeles',
            address: 'No. 189, Grove St, Los Angeles',
            zip: 'CA 90036'
            },]
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
