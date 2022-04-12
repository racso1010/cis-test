module.exports = {
    devServer: {
        proxy: 'http://localhost:80/'
    },
    configureWebpack: {
        plugins: [
          new MyAwesomeWebpackPlugin()
        ]
    }
}