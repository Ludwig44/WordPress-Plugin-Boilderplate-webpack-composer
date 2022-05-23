const path                      = require( 'path' );
const MiniCssExtractPlugin      = require( 'mini-css-extract-plugin' );
const CssMinimizerPlugin        = require( "css-minimizer-webpack-plugin" );
const TerserPlugin              = require( "terser-webpack-plugin" );

const JS_DIR    = path.resolve( __dirname, 'js' );
const BUILD_DIR = path.resolve( __dirname, '../js' );

const entry = {
    /*'exemple' : JS_DIR + '/exemple.js'*/
};
const output = {
    path: BUILD_DIR,
    filename: '[name].js',
    libraryTarget: 'var',
    library: 'Global'
};
const rules = [
    {
        test: /\.js$/,
        include: [ JS_DIR ],
        exclude: /node_modules/,
        use: {
            loader: "babel-loader",
            options: {
                presets: ['@babel/preset-env']
            }
        }
    },
    {
        test: /\.(sa|sc|c)ss$/,
        // exclude: /node_modules/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader,
            },
            {
                loader: 'css-loader',
                options: {
                    sourceMap: true,
                    url: false
                }
            },
            {
                loader: 'postcss-loader',
                options: {
                    postcssOptions: {
                        plugins: [
                          [
                            "autoprefixer",
                            {
                              sourceMap: true,
                            },
                          ],
                        ],
                    },
                }
            },
            {
                loader: 'sass-loader',
                options: {
                    sourceMap: true,
                    sassOptions: {
                        outputStyle: 'expanded',
                    },
                }
            }
        ],
    }
];

module.exports = ( env, argv ) => ({
    entry: entry,
    output: output,
    module: {
        rules: rules
    },
    optimization: {
        minimize: 'production' === argv.mode,
        minimizer: [
            new CssMinimizerPlugin(),
            new TerserPlugin()
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/[name].css'
        })
    ],
    externals: {
        jquery: 'jQuery'
    }
});