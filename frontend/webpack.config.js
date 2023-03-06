module.exports = {
  chainWebpack: config => {
    config.module
      .rule('css')
      .test(/\.css$/)
      .use('css-loader')
      .loader('css-loader')
      .end();
  }
}
