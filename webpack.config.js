const path = require('path')

// https://stefanbauer.me/tips-and-tricks/autocompletion-for-webpack-path-aliases-in-phpstorm-when-using-laravel-mix
module.exports = {
  output: {chunkFilename: 'js/[name].js?id=[chunkhash]'},
  resolve: {
    alias: {
      '@': path.resolve('./resources/js'),
      ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue'),
      ziggyRoutes: path.resolve('./resources/js/ziggy'),
    },
    extensions: ['.js', '.vue', '.json'],
  },
  devServer: {
    allowedHosts: 'all',
  },
  stats: {
    children: true,
  },
}
