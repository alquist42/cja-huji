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
      },
    },
  },

  chainWebpack: config => {
    config.plugin('copy').tap((options) => {
      options[0][0].from = path.resolve(__dirname, 'admin/public/')
      return options
    })
  },

  publicPath: '/admin', //http://localhost:8080
  outputDir: 'public/admin',
  //indexPath: '../../resources/views/admin.blade.php',

  pages: {
    dash: {
      // entry for the page
      entry: 'admin/src/main.js',
      // the source template
      template: 'admin/public/index.html',
      // output as dist/index.html
      // filename: '../../resources/views/admin.blade.php',
      // when using title option,
      // template title tag needs to be <title><%= htmlWebpackPlugin.options.title %></title>
      title: 'Index Page',
      // chunks to include on this page, by default includes
      // extracted common chunks and vendor chunks.
      chunks: ['chunk-vendors', 'chunk-common', 'dash'],
    },
    // when using the entry-only string format,
    // template is inferred to be `public/subpage.html`
    // and falls back to `public/index.html` if not found.
    // Output filename is inferred to be `subpage.html`.
    // subpage: 'src/subpage/main.js'
  },

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
