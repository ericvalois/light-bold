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
                    "style.css": "sass/style.scss",
                    "critical/critical-admin.css": "sass/critical-admin.scss"
                }
            }
        },

        criticalcss: {
            home: {
                options: {
                    url: "http://perf.dev/",
                    width: 1200,
                    height: 1500,
                    outputfile: "critical/home.css",
                    filename: "style.css",
                    buffer: 800*1500,
                    forceInclude: [],
                    ignoreConsole: false
                }
            },
            archive: {
                options: {
                    url: "http://perf.dev/blog/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/archive.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    ignoreConsole: false
                }
            },
            page: {
                options: {
                    url: "http://perf.dev/about/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/page.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    ignoreConsole: false
                }
            },
            contact: {
                options: {
                    url: "http://perf.dev/contact-us/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/contact.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    ignoreConsole: false
                }
            },
            404: {
                options: {
                    url: "http://perf.dev/abcdefgh/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/404.css",
                    filename: "style.css",
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
                tasks: ['sass'],
                options: {
                  livereload: true,
                },
            },
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