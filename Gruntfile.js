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
                    "temp.css": "sass/style.scss"
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
                    filename: "style-<%= pkg.version %>.css",
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
                    filename: "style-<%= pkg.version %>.css",
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
                    filename: "style-<%= pkg.version %>.css",
                    buffer: 800*1024,
                    ignoreConsole: false
                }
            },
            single: {
                options: {
                    url: "http://perf.dev/lorem-ipsum-dolor-sit-amet/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/single.css",
                    filename: "style-<%= pkg.version %>.css",
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
                    filename: "style-<%= pkg.version %>.css",
                    buffer: 800*1024,
                    ignoreConsole: false
                }
            },
            page_404: {
                options: {
                    url: "http://perf.dev/abcdefgh/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/404.css",
                    filename: "style-<%= pkg.version %>.css",
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
            first: {
                src: ['build/*', '!build/<%= pkg.name %>-parent.zip']
            },
            second: {
                src: ['build/*', '!build/lightbold.zip']
            },
            style: {
                src: ['style-*']
            },
            temp: {
                src: ['temp.css']
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
            },
            demo: {
                src: '../../uploads/demo/demo-lightbold.xml',
                dest: 'build/demo-lightbold.xml'
            },
            doc: {
                src: '/Users/bulledev/Google\ Drive/perfthemes.com/themes/light\&bold/documentation.pdf',
                dest: 'build/documentation.pdf'
            },
            stylesheet: {
                src: 'temp.css',
                dest: 'style-<%= pkg.version %>.css'
            },


        },

        compress: {
            parent: {
                options: {
                    archive: 'build/<%= pkg.name %>-parent.zip'
                },
                expand: true,
                cwd: 'build/',
                src: ['**/*'],
                dest: '<%= pkg.name %>/'
            },
            child: {
                options: {
                    archive: 'build/<%= pkg.name %>-child.zip'
                },
                expand: true,
                cwd: '../lightbold-child/',
                src: ['**/*'],
                dest: '<%= pkg.name %>-child/'
            },
            full: {
                options: {
                    archive: 'build/lightbold.zip'
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

        autoprefixer: {
            options: {
                browsers: ['last 2 versions']
            },
            dist: {
                files: {
                    'temp.css': 'temp.css'
                }
            }
        },

        'string-replace': {
          dist: {
            files: [{
              //expand: true,
              cwd: '',
              src: 'functions.php',
              dest: 'functions.php'
            }],
            options: {
              replacements: [{
                pattern: /(style-)(\*|\d+(\.\d+){0,3}(\.\*)?)(.css)/ig,
                replacement: 'style-<%= pkg.version %>.css'
              }]
            }
          }
        },

        // running `grunt watch` will watch for changes
        watch: {
            sass: {
                files: ['sass/*.scss'],
                tasks: ['clean:style', 'sass', 'string-replace', 'autoprefixer', 'copy:stylesheet', 'clean:temp'],
                options: {
                  livereload: false,
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
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-string-replace');

    grunt.registerTask('critical', ['criticalcss', 'cssmin']);
    //grunt.registerTask('cleanstyle', ['clean:style']);
    grunt.registerTask( 'build', ['clean:init', 'copy', 'compress:parent', 'clean:first', 'compress:child', 'copy:demo', 'copy:doc', 'compress:full', 'clean:second']);

};