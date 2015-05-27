var gulp = require('gulp'),
    plumber      = require('gulp-plumber'),
    browsersync  = require('browser-sync'),
    sass         = require('gulp-sass'),
    gulpFilter   = require('gulp-filter'),
    autoprefixer = require('gulp-autoprefixer'),
    compass   = require('gulp-compass'),
    sourcemaps   = require('gulp-sourcemaps'),
    config       = require('./gulpconfig.json'),
    closureCompiler = require('gulp-closure-compiler'),
    path = require('path');

gulp.task('sass', function() {
  var sassConfig = config.sass.options;

  sassConfig.onError = browsersync.notify;

  // Don’t write sourcemaps of sourcemaps
  var filter = gulpFilter(['*.css', '!*.map']);

  browsersync.notify('Compiling Sass');

  return gulp.src(config.sass.src)
    .pipe(plumber())
    .pipe(compass({
      config_file: './config.rb',
      css: './css',
      sass: './sass'
    }))
    .pipe(sourcemaps.init())
    .pipe(autoprefixer(config.autoprefixer))
    .pipe(filter) // Don’t write sourcemaps of sourcemaps
    .pipe(sourcemaps.write('.', { includeContent: false }))
    .pipe(filter.restore()) // Restore original files
    .pipe(gulp.dest(config.sass.dest));
    //.pipe(sass(config.sass.src,sassConfig))
    //.pipe(sass(config.sass.src,sassConfig))
  /*
    
    
    .pipe(sourcemaps.init())
    .pipe(autoprefixer(config.autoprefixer))
    .pipe(filter) // Don’t write sourcemaps of sourcemaps
    .pipe(sourcemaps.write('.', { includeContent: false }))
    .pipe(filter.restore()) // Restore original files
    .
   */
});


gulp.task('js', function() {
  return gulp.src('./*.js')
    .pipe(closureCompiler({
        compilerPath: './bower_components/closure-compiler/lib/vendor/compiler.jar',
        fileName: 'compiled.js',
        compilerFlags: {
            debug: true,
            process_jquery_primitives: undefined,
            //compilation_level: 'ADVANCED_OPTIMIZATIONS',
            compilation_level: 'SIMPLE_OPTIMIZATIONS',
            //compilation_level: 'WHITESPACE_ONLY',
            //language_in: 'ECMASCRIPT5_STRICT',
            //formatting: 'PRETTY_PRINT',
            create_source_map: 'compiled.js.map',
            externs: [
                'closure-compiler/externs/jquery-1.9.js',
                'js/externs/modernizr.externs.js',
                'js/externs/foundation.externs.js'
            ]
        }
    }))
    .pipe(gulp.dest('dist'));
});


gulp.task('watch', function() {
  gulp.watch(config.watch.sass,    ['sass']);
  
});

 
