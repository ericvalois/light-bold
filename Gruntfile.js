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
                    url: "http://lightbold.perfthemes.dev/",
                    width: 1200,
                    height: 800,
                    outputfile: "critical/home.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.lg-col-12','.lg-col-6','.lg-col-4','.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
            homewithslider: {
                options: {
                    url: "http://lightbold.perfthemes.dev/home-with-slider/",
                    width: 1200,
                    height: 1500,
                    outputfile: "critical/home-with-slider.css",
                    filename: "style.css",
                    buffer: 800*1500,
                    forceInclude: ['.lg-col-12','.lg-col-6','.lg-col-4','.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
            archive: {
                options: {
                    url: "http://lightbold.perfthemes.dev/blog/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/archive.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
            page: {
                options: {
                    url: "http://lightbold.perfthemes.dev/about/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/page.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
            single: {
                options: {
                    url: "http://lightbold.perfthemes.dev/hello-world-2/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/single.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
            contact: {
                options: {
                    url: "http://lightbold.perfthemes.dev/contact-us/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/contact.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
            page_404: {
                options: {
                    url: "http://lightbold.perfthemes.dev/abcdefgh/",
                    width: 1200,
                    height: 900,
                    outputfile: "critical/404.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
        },

        cssmin: {
            critical: {
                options: {
                    aggressiveMerging: true,
                    level: {
                        2: {
                          all: true,
                        }
                    }
                },
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
                src: ['build/*', '!build/light-bold.zip']
            },
            style: {
                src: ['style-*']
            },
            temp: {
                src: ['temp.css']
            },
        },

        copy: {
            readme: {
                src: 'readme.md',
                dest: 'build/readme.txt'
            },
            build: {
                expand: true,
                src: ['**', '!node_modules/**', '!build/**', '!readme.md', '!Gruntfile.js', '!package.json', '!.gitignore' ],
                dest: 'build/'
            },
            demo: {
                src: '../../uploads/demo/light-bold-demo.xml',
                dest: 'build/light-bold-demo.xml'
            },
            doc: {
                src: '/Users/bulledev/Google\ Drive/perfthemes.com/themes/light\&bold/documentation.pdf',
                dest: 'build/documentation.pdf'
            },
            extend_lightbold: {
                src: 'build/extend-lightbold.zip',
                dest: 'inc/3rd-party/plugins/extend-lightbold.zip'
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
                cwd: '../light-bold-child/',
                src: ['**/*'],
                dest: '<%= pkg.name %>-child/'
            },
            extend_lightbold: {
                options: {
                    archive: 'build/extend-lightbold.zip'
                },
                expand: true,
                cwd: '../../plugins/extend-lightbold/',
                src: ['**/*'],
                dest: 'extend-lightbold/'
            },
            full: {
                options: {
                    archive: 'build/light-bold.zip'
                },
                expand: true,
                cwd: 'build/',
                src: ['**/*'],
                dest: '<%= pkg.name %>/'
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
    grunt.loadNpmTasks('grunt-string-replace');

    grunt.registerTask('critical', ['criticalcss','cssmin']);
    grunt.registerTask('min', ['cssmin']);

    //grunt.registerTask('cleanstyle', ['clean:style']);
    grunt.registerTask( 'build', ['clean:init', 'compress:extend_lightbold', 'copy:extend_lightbold', 'clean:init', 'copy:build', 'compress:parent', 'clean:first', 'compress:child', 'copy:demo', 'copy:doc', 'compress:full', 'clean:second']);

};