const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const Dotenv = require('dotenv-webpack');
const path = require('path');
module.exports = {
    entry: {
        general: './recursos/general',
        ingreso: './recursos/js/auth/ingreso',
        cupones: './recursos/js/cupones/cupones',
        inicio: './recursos/js/dashboard/inicio',
    },
    output: {
        path: path.resolve(__dirname, './public/assets/'),
        filename: '[name].js',
    },

    resolve: {
        extensions: ['.js', '.jsx']
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                use: ['babel-loader'],
                exclude: /node_modules/
            },
            {
                test: /\.css$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader'],
            },
            {
                test: /\.(scss)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader',
                ],
                exclude: /node_modules/
            }, {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: path.resolve(__dirname, './public/fonts/'),
                        }
                    }
                ]
            }, {
                test: /\.(png|jpe?g|gif|ico|)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: path.resolve(__dirname, './public/img/'),
                        }
                    }
                ]
            },
            {
                test: /\.svg$/,
                loader: 'svg-inline-loader'
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin(),
        new Dotenv()
    ],
    optimization: {
        splitChunks: {
            cacheGroups: {
                vendor: {
                    test: /[\\/]node_modules[\\/](react|react-dom)[\\/]/,
                    name: 'vendor',
                    chunks: 'all',
                }
            }
        }
    }
}