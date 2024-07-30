const path = require("path");

const postcssPresetEnv = require('postcss-preset-env');

const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const SVGSpritemapPlugin = require("svg-spritemap-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const CopyWebpackPlugin = require('copy-webpack-plugin');
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");



const extractSass = new MiniCssExtractPlugin({
  filename: "../css/[name].css"
});

const spriteMap = new SVGSpritemapPlugin("src/svg/*.svg", {
  output: {
    filename: "../img/svgstore.svg",
    svg4everybody: true,
    svg: {
      sizes: true
    },
    svgo: {
      multipass: true,
      plugins: [
        {
          cleanupIDs: {
            minify: false,
          },
        },
        { removeViewBox: false },
        { removeDimensions: true }
      ],
    }
  },
  sprite: {
    prefix: false,
    generate: {
      title: false
    }
  },
  styles: {
    filename: path.join(__dirname, "src/scss/util/_sprites.scss")
  }
});

const browserSync = new BrowserSyncPlugin({
  files: ["dist/**/*"],
  server: "dist"
},
{ reload: false });

const copyFiles = new CopyWebpackPlugin([
  { from: 'src/fonts', to: '../fonts' },
  { from: 'src/img', to: '../img' }
]);



const config = {
  devtool: 'source-map',
  entry: {
    main: "./src/index"
  },
  output: {
    filename: "[name].js",
    path: path.resolve(__dirname, "dist/js")
  },
  module: {
    rules: [
      {
        test: /\.html$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: "[name].html",
              outputPath: "../"
            }
          },
          {
            loader: "nunjucks-html-loader",
            options: {
              searchPaths: [
                path.resolve(__dirname, "src/html"),
                path.resolve(__dirname, "src/html/modules"),
                path.resolve(__dirname, "src/html/templates"),
                path.resolve(__dirname, "src/html/util")
              ]
            }
          }
        ]
      },
      {
        test: /\.js|jsx$/,
        include: /src\/js/,
        use: {
          loader: "babel-loader",
          options: {
            presets: [
              ['@babel/preset-env', {
                useBuiltIns: 'usage',
                corejs: 3,
              }]
            ],
            plugins: [
              ["@babel/plugin-transform-react-jsx", {
                "pragma": "h",
                "pragmaFrag": "Fragment",
              }]
            ]
          }
        }
      },
      {
        test: /\.(sc|c)ss$/,
        use: [
          { loader: MiniCssExtractPlugin.loader },
          {
            loader: "css-loader",
            options: {
              url: false,
              importLoaders: 2,
              sourceMap: true
            }
          },
          {
            loader: "postcss-loader",
            options: {
              ident: "postcss",
              parser: "postcss-scss",
              sourceMap: true,
              plugins: () => [
                postcssPresetEnv()
              ]
            }
          },
          {
            loader: "sass-loader",
            options: {
              sourceMap: true
            }
          }
        ]
      },
    ]
  },
  resolve: {
    extensions: ['.js', '.jsx'],
    alias: {
      "react": "preact/compat",
      "react-dom/test-utils": "preact/test-utils",
      "react-dom": "preact/compat",
    }
  },
  plugins: [
    new CleanWebpackPlugin(),
    extractSass,
    spriteMap,
    copyFiles,
    browserSync,
  ],
};

module.exports = (env, argv) => {
  return config;
};
