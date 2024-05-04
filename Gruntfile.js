const sass = require('node-sass');

module.exports = function (grunt) {
  grunt.initConfig({
    //uglify: {
    //  my_target: {
    //    files: {
    //      'wp-content/themes/gargano/js/min/min.js': ['wp-content/themes/gargano/js/lib/*.js', 'wp-content/themes/gargano/js/*.js']
    //    }
    //  }
    //},
    sass: {
      options: {
        implementation: sass,
        sourceMap: true,
        outputStyle: 'compressed',
      },
      dist: {
        files: {
          'style.css': 'css/sass/style.scss'
        }
      }
    },
    autoprefixer:{
      dist:{
        files:{
          'style.css':'style.css'
        }
      }
    },
    watch: {
      scripts: {
        files: ['css/**/*.scss'],
        tasks: ['sass', 'autoprefixer'],
        options: {
          spawn: false
        }
      }
    },
    uglify: {
      my_target: {
        files: {
          'min.js': ['js/*.js']
        }
      }
    },
    /*
    penthouse: {
      extract: {
        outfile: './critical/out.css',
        css: './style.css',
        url: 'https://silber-kraft.de',
        width: 1300,
        height: 900,
        skipErrors: false // this is the default
      }
    },*/


  });

  //  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.registerTask('default', ['sass']);
  grunt.registerTask('watcher', ['watch']);
};
