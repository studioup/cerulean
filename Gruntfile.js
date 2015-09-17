
module.exports = function(grunt) {

  var url = grunt.option( "url" ) || 'http://static.studioup.it/img/logo_fb.png';
  var themeUrl = grunt.option( "themeUrl" );
  var jsMapPath = "";
  if(grunt.option( "themeUrl" ) != undefined){
      if(!(/^https?:\/\//.test(url)))
      {
        url = "http://" + url;
      }
      if(themeUrl.substr(-1) == '/') {
          themeUrl = themeUrl.substr(0, themeUrl.length - 1);
      }
      jsMapPath = "//# sourceMappingURL="+themeUrl+"/compiled.js.map\n";
  }
  if(!(/^https?:\/\//.test(themeUrl)))
  {
    url = "http://" + themeUrl;
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
    surround: {
        options: {
        },
        js_map: {
            options: {
                append: jsMapPath,
                //ignoreRepetition: true
            },
            files: [{
              src: 'js/compiled.js',
              dest: 'js/compiled.js'
            }]
        },
      },
    sass: {
      options: {
        //includePaths: ['bower_components/foundation/scss','bower_components/compass-mixins/lib/'],
        loadPath: ['bower_components/font-awesome/scss/', 'bower_components/animate-sass/'],
        sourcemap: 'auto',
        compass: true
      },
      dist: {
        options: {
          //outputStyle: 'compressed'
          style: 'compressed'
        },
        files: {
          //'css/app.css': 'scss/app.scss',
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
        files: 'scss/*.scss',
        tasks: ['sass']
        //tasks: ['sass','bless']
      },
      closurecompiler: {
        files: ['js/app.js','js/include.*.js'],
        tasks: ['js']
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
                'bower_components/object-fit/dist/polyfill.object-fit.js',
                'bower_components/cookies-enabler/cookies-enabler.js',
                'bower_components/animsition/dist/js/jquery.animsition.js',
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
                'bower_components/foundation/js/foundation/foundation.reveal.js',
                //'bower_components/foundation/js/foundation/foundation.slider.js',
                //'bower_components/foundation/js/foundation/foundation.tab.js',
                //'bower_components/foundation/js/foundation/foundation.tooltip.js',
                'bower_components/foundation/js/foundation/foundation.topbar.js',
                'bower_components/wow/dist/wow.js',
                'js/include.*.js',
                'bower_components/outdated-browser/outdatedbrowser/outdatedbrowser.js',
                'bower_components/FlexSlider/jquery.flexslider.js',
                'js/app.js',
                // Will expand to 'static/src/debug.api.js',
                //   'static/src/debug.console.js'...
            ],
            jsOutputFile: 'js/compiled.js',
            options: {
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
        },
    }
  });
  //# sourceMappingURL=../compiled.js.map

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-closure-compiler');
  grunt.loadNpmTasks('grunt-surround');

  grunt.loadNpmTasks('grunt-contrib-watch');
  //grunt.loadNpmTasks('grunt-bless');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  //grunt.loadNpmTasks('grunt-closure-tools');
  require('coffee-script/register');
  grunt.loadNpmTasks('grunt-screenshot-element');

  grunt.registerTask('screen',['screenshot-element']);
  grunt.registerTask('wrap',['surround']);
  grunt.registerTask('js',['closure-compiler','surround']);
  grunt.registerTask('build', ['sass','closure-compiler','surround']);
  //grunt.registerTask('build', ['sass','bless']);
  grunt.registerTask('default', ['build','watch']);
}
