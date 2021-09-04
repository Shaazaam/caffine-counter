var mix = require('laravel-mix');

var mapFilesToDirectory = (files, directory) => files.map((file) => directory + file);

var vendorDir = 'node_modules/';
var sourceCSSDir = 'public/src/css/';
var sourceJSDir = 'public/src/js/';
var distCSSDir = 'public/dist/css/';
var distJSDir = 'public/dist/js/';

var vendorCSSFiles = mapFilesToDirectory([], vendorDir);
var vendorJSFiles = mapFilesToDirectory([
    'moment/min/moment.min.js',
    'vue/dist/vue.js',
], vendorDir);
var sourceCSSFiles = mapFilesToDirectory([
    'bootstrap.min.css',
    'style.css',
], sourceCSSDir);
var sourceJSFiles = mapFilesToDirectory([
    'moment.min.js',
    'vue.js',
], sourceJSDir);
var constJsFiles = mapFilesToDirectory([
    'meta-content.js',
    'functions.js',
    'user.js',
    'table-columns.js',
    'dates.js',
    'enumerations.js',
    'filters.js',
    'storage.js',
    'formatters.js',
    'factory.js',
    'table.js',
    'routes.js',
    'config.js',
    'store.js',
    'mixins.js',
    'instances.js',
    'serializers.js',
], sourceJSDir + 'constants/');
var mixinJsFiles = mapFilesToDirectory([
    'global.js',
    'fetch.js',
    'table.js',
    'form-errors.js',
    'number-input.js',
], sourceJSDir + 'mixins/');
var rootJsFiles = mapFilesToDirectory([
    'init.js',
], sourceJSDir);
var serializerJsFiles = mapFilesToDirectory([
    'table.js',
], sourceJSDir + 'serializers/');
vendorCSSFiles.forEach((file) => mix.copy(file, sourceCSSDir));
vendorJSFiles.forEach((file) => mix.copy(file, sourceJSDir));

mix.sass(sourceCSSDir + 'style.scss', sourceCSSDir);
mix.styles(sourceCSSFiles, distCSSDir + 'all.css');
mix.scripts(sourceJSFiles, distJSDir + 'all.js');
mix.scripts(constJsFiles, distJSDir + 'constants.js');
mix.js(mixinJsFiles, distJSDir + 'mixins.js');
mix.js(rootJsFiles, distJSDir + 'init.js');
mix.scripts(serializerJsFiles, distJSDir + 'serializers.js');
