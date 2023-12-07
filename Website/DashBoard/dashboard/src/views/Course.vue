<template>
    <div class="course">
        <h3>Course Management</h3>
        <div class="header">
            <el-input v-model="input" placeholder="请输入内容"></el-input>
            <el-button type="primary">Search</el-button>
            <el-button type="primary">Add Course</el-button>
        </div>
        <div class="wrapper">
            <el-table :data="tableData" stripe>
                <el-table-column type="selection" width="55">
                </el-table-column>
                <el-table-column prop="date" label="ID" width="100">
                </el-table-column>
                <el-table-column prop="name" label="Name" width="100">
                </el-table-column>
                <el-table-column prop="address" label="Price">
                </el-table-column>
                <el-table-column prop="address" label="Licturer" width="100">
                </el-table-column>
                <el-table-column prop="address" label="Picture">
                </el-table-column>
                <el-table-column prop="address" label="Operate">
                    <template slot-scope="scope">
                        <el-button size="mini" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                        <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</div></template>
<script>
export default {
    data() {
        return {
            input: "",
            tableData: []
        }
    },
    methods: {
        // 编辑操作
        handleEdit() {

        },

        // 删除操作
        handleDelete() {

        }
    },
    created() {
        this.$api.getCourseList({
            page: 1,
        })
        .then(res => {
            console.log(res, data);
            if (res.data.status === 200) {
                this.tableData = res.data.data; //数据列表
            }
        })
    }
}
</script>
<style lang="less" scoped>
.course {
    margin: 20px;
}

h3 {
    text-align: center;
}

.header {
    display: flex;

    button {
        margin-left: 20px;
    }
}

.wrapper {
    margin: 20px 0;
}
</style>