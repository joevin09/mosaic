'use strict';
module.exports = function(grunt) {
  // Load all tasks
  require('load-grunt-tasks')(grunt);
  // Show elapsed time
  require('time-grunt')(grunt);

  var jsFileList = [
    '_assets/vendor/bootstrap/js/transition.js',
    '_assets/vendor/bootstrap/js/alert.js',
    '_assets/vendor/bootstrap/js/button.js',
    '_assets/vendor/bootstrap/js/carousel.js',
    '_assets/vendor/bootstrap/js/collapse.js',
    '_assets/vendor/bootstrap/js/dropdown.js',
    '_assets/vendor/bootstrap/js/modal.js',
    '_assets/vendor/bootstrap/js/tooltip.js',
    '_assets/vendor/bootstrap/js/popover.js',
    '_assets/vendor/bootstrap/js/scrollspy.js',
    '_assets/vendor/bootstrap/js/tab.js',
    '_assets/vendor/bootstrap/js/affix.js',
    '_assets/vendor/jquery-dropkick/dropkick.js',
    '_assets/js/plugins/*.js',
    '_assets/js/_*.js'
  ];

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        '__assets/js/*.js',
        '!_assets/js/scripts.js',
        '!_assets/**/*.min.*'
      ]
    },
    less: {
      dev: {
        files: {
          '_assets/css/main.css': [
            '_assets/less/main.less'
          ]
        },
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: '_assets/css/main.css.map',
          sourceMapRootpath: '/app/views/public/default/'
        }
      },
      build: {
        files: {
          '_assets/css/main.min.css': [
            '_assets/less/main.less'
          ]
        },
        options: {
          compress: true
        }
      }
    },
    concat: {
      options: {
        separator: ';',
      },
      dist: {
        src: [jsFileList],
        dest: '_assets/js/scripts.js',
      },
    },
    uglify: {
      dist: {
        files: {
          '_assets/js/scripts.min.js': [jsFileList]
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
      },
      dev: {
        options: {
          map: {
            prev: '_assets/css/'
          }
        },
        src: '_assets/css/main.css'
      },
      build: {
        src: '_assets/css/main.min.css'
      }
    },
    modernizr: {
      build: {
        devFile: '_assets/vendor/modernizr/modernizr.js',
        outputFile: '_assets/js/vendor/modernizr.min.js',
        files: {
          'src': [
            ['_assets/js/scripts.min.js'],
            ['_assets/css/main.min.css']
          ]
        },
        extra: {
          shiv: false
        },
        uglify: true,
        parseFiles: true
      }
    },
    version: {
      default: {
        options: {
          format: true,
          length: 32,
          manifest: '_assets/manifest.json',
          querystring: {
            style: 'roots_css',
            script: 'roots_js'
          }
        },
        files: {
          '../../../helpers/MY_url_helper.php': '_assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      }
    },
    watch: {
      less: {
        files: [
          '_assets/less/*.less',
          '_assets/less/**/*.less'
        ],
        tasks: ['less:dev', 'autoprefixer:dev']
      },
      js: {
        files: [
          jsFileList,
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'concat']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: false
        },
        files: [
          '_assets/css/main.css',
          '_assets/js/scripts.js',
          'templates/*.php',
          '*.php'
        ]
      }
    }
  });

  // Register tasks
  grunt.registerTask('default', [
    'dev-and-build'
  ]);
  grunt.registerTask('dev-and-build', [
    'jshint',
    'less:dev',
    'autoprefixer:dev',
    'concat',
    'jshint',
    'less:build',
    'autoprefixer:build',
    'uglify',
    'modernizr',
    'version'
  ]);
  grunt.registerTask('dev', [
    'jshint',
    'less:dev',
    'autoprefixer:dev',
    'concat'
  ]);
  grunt.registerTask('build', [
    'jshint',
    'less:build',
    'autoprefixer:build',
    'uglify',
    'modernizr',
    'version'
  ]);
};
