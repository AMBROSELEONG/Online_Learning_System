const { defineConfig } = require('@vue/cli-service');

module.exports = defineConfig({
  transpileDependencies: true,
  lintOnSave: false, //关闭eslint校验

  devServer: {
    proxy: {
      '/api': {
        target: 'http://localhost:8989',
        changeOrigin: true,
        ws: true,
        pathRewrite: {
          '^/api': ''
        }
      }
    }
  }
});
