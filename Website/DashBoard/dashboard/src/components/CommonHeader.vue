<template>
    <div class="header-container">
        <div class="l-content">
            <el-button @click='handleMenu' icon="el-icon-menu" size="mini"></el-button>
            <!-- 面包屑 -->
            <span class="text">Home</span>
        </div>
        <div class="r-content">
            <el-dropdown>
                <span class="el-dropdown-link">
                    <i class="el-icon-user-solid" style="background-color: white; border-radius: 50%; width: 40px; height: 40px; text-align: center; line-height: 40px;"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>黄金糕</el-dropdown-item>
                    <el-dropdown-item>狮子头</el-dropdown-item>
                    <el-dropdown-item>螺蛳粉</el-dropdown-item>
                    <el-dropdown-item disabled>双皮奶</el-dropdown-item>
                    <el-dropdown-item divided>蚵仔煎</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {}
    },
    methods:{
        handleMenu(){
            this.$store.commit('collapseMenu')
        }
    }
}
</script>
<style lang="less" scoped>
.header-container {
    padding: 0 20px;
    background-color: #333;
    height: 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;

    .text {
        color: #fff;
        font-size: 14px;
        margin-left: 10px;
    }
}
</style>