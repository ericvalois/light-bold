module.exports = function(grunt) {
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),
        
        // running `grunt sass` will compile once
        sass: {
            development: {
                options: {
                    sourcemap: "none",
                    style: "compressed",
                    update: true,
                    noCache: true,
                },
                files: {
                    "style.css": "sass/style.scss"
                }
            }

        },

        criticalcss: {
            home: {
                options: {
                    url: "http://perf.dev/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/home.css",
                    filename: "style.css", // Using path.resolve( path.join( ... ) ) is a good idea here
                    buffer: 800*1024,
                    ignoreConsole: false
                }
            },
        },

        cssmin: {
          target: {
            files: [{
              expand: true,
              cwd: 'critical',
              src: ['*.css', '!*.min.css'],
              dest: 'critical',
              ext: '.min.css'
            }]
          }
        },

        clean: {
            init: {
                src: ['build/']
            },
            build: {
                src: ['build/*', '!build/<%= pkg.name %>.zip']
            }
        },
        copy: {
            readme: {
                src: 'readme.md',
                dest: 'build/readme.txt'
            },
            build: {
                expand: true,
                src: ['**', '!node_modules/**', '!build/**', '!readme.md', '!Gruntfile.js', '!package.json' ],
                dest: 'build/'
            }
        },
        compress: {
            build: {
                options: {
                    archive: 'build/<%= pkg.name %>.zip'
                },
                expand: true,
                cwd: 'build/',
                src: ['**/*'],
                dest: '<%= pkg.name %>/'
            }
        },
        perfbudget: {
            default: {
                options: {
                    url: 'perf.dev',
                    key: 'A.43da8ba865bc8f510685e0e5ef2fdcd2',
                    budget: {
                        visualComplete: '2000',
                        SpeedIndex: '1000'
                    }
                }
            }
        },

        // running `grunt watch` will watch for changes
        watch: {
            sass: {
                files: ['sass/*.scss'],
                tasks: ["sass"],
                options: {
                  livereload: true,
                },
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-criticalcss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-perfbudget');

    grunt.registerTask('critical', ['criticalcss', 'cssmin']);
    grunt.registerTask( 'build', ['clean:init', 'copy', 'compress:build', 'clean:build']);

};