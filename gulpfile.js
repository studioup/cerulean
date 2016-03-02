// Grab our gulp packages
var $      = require('gulp-load-plugins')(),
    gulp  = require('gulp'),
    fs = require('fs'),
    jsonSass = require('gulp-json-sass'),
    stripJsonComments = require('strip-json-comments')
    config =  JSON.parse(stripJsonComments( fs.readFileSync('./config.json', 'utf8'))),
    gutil = require('gulp-util'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    plumber = require('gulp-plumber'),
    bower = require('gulp-bower'),
    remoteSrc = require('gulp-remote-src'),
    //closureCompiler = require('gulp-closure-compiler'),
    jsonWrapper = require('gulp-json-wrapper')
    isProduction = false;
    

gulp.task('scss-settings', function() {
    //config.foundationUtils,
    return gulp.src(['./config_sass.json'])
        .pipe(jsonSass({
            sass: false
        }))
        .pipe(rename('_json_generated_config.scss'))
        .pipe(gulp.dest('./scss/'));
});


gulp.task('minify-styles',['generate-styles'], function() {
 
    return gulp.src(['./css/style.css'])
        //.pipe($.sourcemaps.init({}))
        .pipe($.minifyCss( {keepSpecialComments:0 }))
        .pipe(rename({suffix: '.min'}))
        //.pipe( $.sourcemaps.write('./maps/'))
        .pipe(gulp.dest('./css/'));
        
});


gulp.task('generate-styles',['scss-settings'], function() {
    var sitemap = []
    if(isProduction){
        remoteSrc('', {
            base: config.url + '?show_sitemap'
        }).pipe(gulp.dest('sitemap.json'));
        sitemap = require('./sitemap.json');
    }
    
    //var uncss = $.if(isProduction, );
    var uncss = $.if(isProduction, $.uncss({
            html: sitemap,
            ignore: [
                new RegExp('^meta\..*'),
                new RegExp('^\.is-.*'),
                new RegExp('^\..*-active')
            ]
        }));
    //var minifycss = $.if(isProduction, $.minifyCss());

    return gulp.src(['./scss/style.scss'])
        .pipe($.sourcemaps.init())
        .pipe($.sass({
            //includePaths: PATHS.sass
            includePaths: config.scssPaths
        })
        .on('error', $.sass.logError))
        .pipe($.autoprefixer(config.autoPrefixer))     
        .pipe(uncss)
        //.pipe($.minifyCss())
        .pipe($.if(!isProduction, $.sourcemaps.write()))
        .pipe($.if(isProduction, rename({suffix: '.clean'})))
        .pipe(gulp.dest('./css/'));
                
    
});

  
gulp.task('set-production', function() {
    isProduction = true;
});
    
// JSHint, concat, and minify JavaScript
gulp.task('site-js', function() {
  
  gulp.src( config.customJs )
    .pipe(plumber())
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'));
  
  return gulp.src( config.jsLibraries.concat(config.customJs))
    .pipe(plumber())
    .pipe($.sourcemaps.init({loadMaps: true}))
    .pipe(jsonWrapper({
        src: 'config_sass.json',
        namespace: 'configShared'
    }))
    .pipe(concat('scripts.js'))
    .pipe($.sourcemaps.write('./maps/'))
    .pipe(gulp.dest('./js'));
    //.pipe(rename({suffix: '.min'}))
    //.pipe(uglify())
    //.pipe(gulp.dest('./js'))
});    

// JSHint, concat, and minify Foundation JavaScript
gulp.task('foundation-js', function() {
    return gulp.src(config.jsBase)
    .pipe(plumber())
    .pipe($.sourcemaps.init({loadMaps: true}))
    .pipe(concat('foundation.js'))
    .pipe($.sourcemaps.write('./maps/'))
    .pipe(gulp.dest('./js'));
    //.pipe(rename({suffix: '.min'}))
    //.pipe(uglify())
    //.pipe(gulp.dest('./js'))
});


// JSHint, concat, and minify Foundation JavaScript
gulp.task('app-js', function() {
    return gulp.src([	
        './js/foundation.js',
        './js/scripts.js',
    ])
    .pipe($.sourcemaps.init({loadMaps: true}))
    //.pipe(concat('combined.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe($.sourcemaps.write('./maps/'))
    .pipe(gulp.dest('./js'))
});

gulp.task('app-js-sync', ['foundation-js','site-js'], function() {
    gulp.start('minify-styles', 'app-js');
});


// Update Foundation with Bower and save to /vendor
gulp.task('bower', function() {
  return bower({ cmd: 'update'})
    .pipe(gulp.dest('bower_components/'))
});    

// Create a default task 
gulp.task('default', function() {
  gulp.start('minify-styles', 'app-js-sync');
});

gulp.task('diet', ['set-production'] ,function() {
  gulp.start('minify-styles', 'app-js-sync');
});

gulp.task('update-config',function() {
    config =  JSON.parse(stripJsonComments( fs.readFileSync('./config.json', 'utf8')));
    gulp.start('default', 'app-js-sync');
});

// Watch files for changes
gulp.task('watch', function() {
    
  gulp.start('default');
  // Watch .scss files
  gulp.watch(['./scss/**/*.scss','./config_sass.json'], ['minify-styles']);

  // Watch site-js files
  gulp.watch('./js/sources/*.js', ['site-js']);
  
  // Watch site-js files
  gulp.watch('./config.json', ['update-config']);
  
  gulp.watch(['./js/foundation.js','./js/scripts.js'], ['app-js']);
  
  // Watch foundation-js files
  gulp.watch('./bower_components/foundation-sites/js/*.js', ['foundation-js']);

});
