const path = require('path')
const ManifestPlugin = require('webpack-manifest-plugin')

module.exports = {

  configureWebpack: {
    plugins: [
      new ManifestPlugin({
        writeToFileEmit: true,
      }),
    ],
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'admin/src/'),
        'vue$': 'vue/dist/vue.common.js',
      },
    },
    entry: {
      app: './admin/src/main.js',
    },
  },

  chainWebpack: config => {
    config.plugin('copy').tap((options) => {
      options[0][0].from = path.resolve(__dirname, 'admin/public/')
      return options
    })
  },

  publicPath: (process.env.NODE_ENV === 'development' ? 'http://localhost:8080' : '') + '/admin',
  outputDir: 'public/admin',
  //indexPath: '../../resources/views/admin.blade.php',

  devServer: {
    disableHostCheck: true,
  },

  transpileDependencies: ['vuetify'],

  pluginOptions: {
    i18n: {
      locale: 'en',
      fallbackLocale: 'en',
      localeDir: 'locales',
      enableInSFC: false,
    },
  },
}
