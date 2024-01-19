// webpack.config.js
const Encore = require('@symfony/webpack-encore');

Encore
  // ... other Encore configurations

  // Add Babel loader for JSX files
  .configureBabel((config) => {
    config.presets.push('@babel/preset-react');
  });

module.exports = Encore.getWebpackConfig();
