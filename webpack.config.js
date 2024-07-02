// webpack.config.js

const Encore = require("@symfony/webpack-encore");

Encore.setOutputPath("public/build/")
  .setPublicPath("/build")
  .addEntry("app", "./assets/js/app.js")
  .enableReactPreset()
  .splitEntryChunks()
  .enableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .configureBabel((config) => {
    // Ne pas ajouter @babel/preset-react ici car .enableReactPreset() le fait déjà
    // config.presets.push('@babel/preset-react');
  });

module.exports = Encore.getWebpackConfig();
