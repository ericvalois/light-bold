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
            sideHome: {
                options: {
                    url: "http://lightbold.local/",
                    width: 1200,
                    height: 1500,
                    outputfile: "../../plugins/extend-lightbold/critical/side-nav/home.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.lg-col-12','.lg-col-6','.lg-col-4','.menu__breadcrumbs','lg-flex','.thumb_section1'],
                    ignoreConsole: false
                }
            },
            topHome: {
                options: {
                    url: "http://lightbold.local/?topnav=1",
                    width: 1200,
                    height: 1500,
                    outputfile: "../../plugins/extend-lightbold/critical/top-nav/home.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.lg-col-12','.lg-col-6','.lg-col-4','.menu__breadcrumbs','lg-flex','.thumb_section1'],
                    ignoreConsole: false
                }
            },
            sideHomewithslider: {
                options: {
                    url: "http://lightbold.local/home-with-slider/",
                    width: 1200,
                    height: 1500,
                    outputfile: "../../plugins/extend-lightbold/critical/side-nav/home-with-slider.css",
                    filename: "style.css",
                    buffer: 800*1500,
                    forceInclude: ['.lg-col-12','.lg-col-6','.lg-col-4','.menu__breadcrumbs','lg-flex','.thumb_section1'],
                    ignoreConsole: false
                }
            },
            topHomewithslider: {
                options: {
                    url: "http://lightbold.local/home-with-slider/?topnav=1",
                    width: 1200,
                    height: 1500,
                    outputfile: "../../plugins/extend-lightbold/critical/top-nav/home-with-slider.css",
                    filename: "style.css",
                    buffer: 800*1500,
                    forceInclude: ['.lg-col-12','.lg-col-6','.lg-col-4','.menu__breadcrumbs','lg-flex','.thumb_section1'],
                    ignoreConsole: false
                }
            },
            sideArchive: {
                options: {
                    url: "http://lightbold.local/blog/",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/side-nav/archive.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs','.lg-pr4','.lg-pl4', '.lg-col-8', '.lg-col-4', '.lg-col'],
                    ignoreConsole: false
                }
            },
            topArchive: {
                options: {
                    url: "http://lightbold.local/blog/?topnav=1",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/top-nav/archive.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs','.lg-pr4','.lg-pl4', '.lg-col-8', '.lg-col-4', '.lg-col'],
                    ignoreConsole: false
                }
            },
            sidePage: {
                options: {
                    url: "http://lightbold.local/about/",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/side-nav/page.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs','.lg-pr4','.lg-pl4', '.lg-col-8', '.lg-col-4', '.lg-col'],
                    ignoreConsole: false
                }
            },
            topPage: {
                options: {
                    url: "http://lightbold.local/about/?topnav=1",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/top-nav/page.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs','.lg-pr4','.lg-pl4', '.lg-col-8', '.lg-col-4', '.lg-col'],
                    ignoreConsole: false
                }
            },
            
            sideSingle: {
                options: {
                    url: "http://lightbold.local/hello-world-2/",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/side-nav/single.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs','.entry-meta', '.entry-meta span', '.lg-show','.lg-pr4','.lg-pl4', '.lg-col-8', '.lg-col-4', '.lg-col'],
                    ignoreConsole: false
                }
            },
            topSingle: {
                options: {
                    url: "http://lightbold.local/hello-world-2/?topnav=1",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/top-nav/single.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs','.entry-meta', '.entry-meta span', '.lg-show','.lg-pr4','.lg-pl4', '.lg-col-8', '.lg-col-4', '.lg-col'],
                    ignoreConsole: false
                }
            },
            sideContact: {
                options: {
                    url: "http://lightbold.local/contact-us/",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/side-nav/contact.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
            topContact: {
                options: {
                    url: "http://lightbold.local/contact-us/?topnav=1",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/top-nav/contact.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
            sidePage_404: {
                options: {
                    url: "http://lightbold.local/abcdefgh/",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/side-nav/404.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
            topPage_404: {
                options: {
                    url: "http://lightbold.local/abcdefgh/?topnav=1",
                    width: 1200,
                    height: 1200,
                    outputfile: "../../plugins/extend-lightbold/critical/top-nav/404.css",
                    filename: "style.css",
                    buffer: 800*1024,
                    forceInclude: ['.menu__breadcrumbs'],
                    ignoreConsole: false
                }
            },
        },

        cssmin: {
            sideCritical: {
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
                    cwd: '../../plugins/extend-lightbold/critical/side-nav/',
                    src: ['*.css', '!*.min.css'],
                    dest: '../../plugins/extend-lightbold/critical/side-nav/',
                    ext: '.min.css'
                }]
            },
            topCritical: {
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
                    cwd: '../../plugins/extend-lightbold/critical/top-nav/',
                    src: ['*.css', '!*.min.css'],
                    dest: '../../plugins/extend-lightbold/critical/top-nav/',
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
            doc: {
                src: '/Volumes/GoogleDrive/Mon\ disque/TTFB/themes/light\&bold/documentation.pdf',
                dest: 'build/documentation.pdf'
            },
            extend_lightbold: {
                src: 'build/extend-lightbold.zip',
                dest: 'inc/3rd-party/plugins/extend-lightbold.zip'
            },
            acf_pro: {
                src: 'build/advanced-custom-fields-pro.zip',
                dest: 'inc/3rd-party/plugins/advanced-custom-fields-pro.zip'
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
            acf_pro: {
                options: {
                    archive: 'build/advanced-custom-fields-pro.zip'
                },
                expand: true,
                cwd: '../../plugins/advanced-custom-fields-pro/',
                src: ['**/*'],
                dest: 'advanced-custom-fields-pro/'
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
    grunt.registerTask( 'build', ['clean:init', 'compress:extend_lightbold', 'copy:extend_lightbold', 'compress:acf_pro', 'copy:acf_pro', 'clean:init', 'copy:build', 'compress:parent', 'clean:first', 'compress:child', 'copy:doc', 'compress:full', 'clean:second']);

};