
module.exports = function(grunt) {

  var url = grunt.option( "url" ) || 'http://static.studioup.it/img/logo_fb.png';
  if(!(/^https?:\/\//.test(url)))
  {
    url = "http://" + url;
  }
  var size = {
      width: 1280,
      height: 1280
    };
  if(grunt.option( "url" ) == undefined){
      size = {
          width: 300,
          height: 300
      }; 
  }
  
  
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        //includePaths: ['bower_components/foundation/scss','bower_components/compass-mixins/lib/'],
        sourcemap: 'auto',
        compass: true
      },
      dist: {
        options: {
          //outputStyle: 'compressed'
          style: 'compressed'
        },
        files: {
          'css/app.css': 'scss/app.scss',
          'css/style.css': 'scss/style.scss'
        }        
      }
    },
    bless: {
        css: {
          options: {
              force: true,
              compress: true,
          },
          files: {
            'css/app.css': 'css/app.css',
            'css/style.css': 'css/style.css'
          }
        }
      },

    watch: {
      grunt: { files: ['Gruntfile.js'] },

      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass']
        //tasks: ['sass','bless']
      }
    },
    'screenshot-element': {
        options: {
            selector: 'html',
            viewport: size
        },
        chart: {
          images: [
                {
                    url: url,
                    file: 'screenshot.png',
                }
            ]
        }
    },
    'closure-compiler': {
        frontend: {
            closurePath: 'closure-compiler',
            js: [
                'bower_components/jquery/dist/jquery.js',
                'bower_components/modernizr/modernizr.js',
                'bower_components/foundation/js/foundation/foundation.js',
                //'bower_components/foundation/js/foundation/foundation.abide.js',
                //'bower_components/foundation/js/foundation/foundation.accordion.js',
                //'bower_components/foundation/js/foundation/foundation.alert.js',
                //'bower_components/foundation/js/foundation/foundation.clearing.js',
                //'bower_components/foundation/js/foundation/foundation.dropdown.js',
                //'bower_components/foundation/js/foundation/foundation.equalizer.js',
                //'bower_components/foundation/js/foundation/foundation.interchange.js',
                //'bower_components/foundation/js/foundation/foundation.joyride.js',
                //'bower_components/foundation/js/foundation/foundation.magellan.js',
                //'bower_components/foundation/js/foundation/foundation.offcanvas.js',
                //'bower_components/foundation/js/foundation/foundation.orbit.js',
                //'bower_components/foundation/js/foundation/foundation.reveal.js',
                //'bower_components/foundation/js/foundation/foundation.slider.js',
                //'bower_components/foundation/js/foundation/foundation.tab.js',
                //'bower_components/foundation/js/foundation/foundation.tooltip.js',
                'bower_components/foundation/js/foundation/foundation.topbar.js',
                'js/include.*.js',
                'bower_components/outdated-browser/outdatedbrowser/outdatedbrowser.js',
                'js/app.js',
                // Will expand to 'static/src/debug.api.js',
                //   'static/src/debug.console.js'...
            ],
            jsOutputFile: 'js/compiled.js',
            options: {
                debug: true,
                //compilation_level: 'ADVANCED_OPTIMIZATIONS',
                compilation_level: 'SIMPLE_OPTIMIZATIONS',
                //language_in: 'ECMASCRIPT5_STRICT',
                //formatting: 'PRETTY_PRINT',
                create_source_map: 'js/compiled.js.map',
                externs: [
                    'closure-compiler/externs/jquery-1.9.js',
                    'js/externs/foundation.externs.js'
                ]
            }
        },
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-closure-compiler');

  grunt.loadNpmTasks('grunt-contrib-watch');
  //grunt.loadNpmTasks('grunt-bless');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  //grunt.loadNpmTasks('grunt-closure-tools');
  require('coffee-script/register');
  grunt.loadNpmTasks('grunt-screenshot-element');
  
  grunt.registerTask('screen',['screenshot-element']);
  grunt.registerTask('js',['closure-compiler']);
  grunt.registerTask('build', ['sass']);
  //grunt.registerTask('build', ['sass','bless']);
  grunt.registerTask('default', ['build','watch','closure-compiler']);
}