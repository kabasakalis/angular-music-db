
module.exports = function (grunt) {

   require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

 grunt.initConfig({

     env : {
         options : {
             /* Shared Options Hash */
             //globalOption : 'foo'
         },
         dev: {
             ENV : 'DEVELOPMENT',
             BASEURL:'/music_db_src/'
         },
         prod : {
             ENV : 'PRODUCTION',
             BASEURL:'/music_db/'
         }
     },
     preprocess : {
         dev : {
             src : './index.tpl.html',
             dest : './index.html',
         },
         prod : {
             src : './index.tpl.html',
             dest : './../music_db/index.html',
         }
     },

     shell: {
         options: {
             stdout: true
         },
         selenium: {
             command: './selenium/start',
             options: {
                 stdout: false,
                 async: true
             }
         },
         protractor_install: {
             command: 'node ./node_modules/protractor/bin/webdriver-manager update --standalone'
         },
         npm_install: {
             command: 'npm install'
         }
     },
     ts: {
         prod: {                                 // a particular target
             src: ["js/**/*.ts"],        // The source typescript files, http://gruntjs.com/configuring-tasks#files
            // html: ["test/work/**/*.tpl.html"], // The source html files, https://github.com/basarat/grunt-ts#html-2-typescript-support
           //  reference: "./test/reference.ts",  // If specified, generate this file that you can use for your reference management
             out: 'js/app.js',                // If specified, generate an out.js file which is the merged js file
            // outDir: 'test/outputdirectory',    // If specified, the generate javascript files are placed here. Only works if out is not specified
           //  watch: 'js',                     // If specified, watches this directory for changes, and re-runs the current target
             options: {                         // use to override the default options, http://gruntjs.com/configuring-tasks#options
                 target: 'es3',                 // 'es3' (default) | 'es5'
                 module: 'amd',            // 'amd' (default) | 'commonjs'
                 sourceMap: true,               // true (default) | false
                 declaration: false,            // true | false (default)
                 comments: false                // true | false (default)
             },
         },
         dev: {                                 // a particular target
             src: ["js/**/*.ts"],        // The source typescript files, http://gruntjs.com/configuring-tasks#files
             // html: ["test/work/**/*.tpl.html"], // The source html files, https://github.com/basarat/grunt-ts#html-2-typescript-support
             //  reference: "./test/reference.ts",  // If specified, generate this file that you can use for your reference management
             out: 'js/app.js',                // If specified, generate an out.js file which is the merged js file
             // outDir: 'test/outputdirectory',    // If specified, the generate javascript files are placed here. Only works if out is not specified
             watch: 'js',                     // If specified, watches this directory for changes, and re-runs the current target
             options: {                         // use to override the default options, http://gruntjs.com/configuring-tasks#options
                 target: 'es3',                 // 'es3' (default) | 'es5'
                 module: 'amd',            // 'amd' (default) | 'commonjs'
                 sourceMap: true,               // true (default) | false
                 declaration: false,            // true | false (default)
                 comments: false                // true | false (default)
             },
         }

     },

     //Copy
     copy: {
          fontsprod: {
             files: [
                 {
                     cwd: './libs/bootswatch/fonts/',
                     src: '*.*',
                     dest: './../music_db/fonts/',
                     expand: true
                 },
                 {
                     src:'./.htaccess',
                     dest: './../music_db/',
                 }
             ]
         },
         fontsdev: {
             files: [
                 {
                     cwd: './libs/bootstrap/dist/fonts/',
                     src: '*.*',
                     dest: './libs/bootswatch/fonts/',
                     expand: true
                 }
             ]
         }
     },
     //Bake angular html  views/templates  into cachable js
     html2js: {
        options: {
            base:''
        },
        main: {
          src: [  'partials/*.tpl.html'],
          dest: 'partials/views.js'
        }
      },


//Concatenate css for production
        concat: {
            options: {
                //   separator: ';'
            },
            prod_css: {
                src: [
                    //main app css
                    './libs/bootswatch/cyborg/bootstrap.css',
                    './css/jumbotron.css',
                    './css/main.css',
                   './libs/toastr/toastr.css'
                ],
                dest: './css/all.css'
            }
        },
     imagemin: {
         img: {
             files: [
                 {
                     src: './img/*.*',
                     dest: './../music_db/',
                     expand: true
                 }
             ],
             options: {
                 optimizationLevel: 7
             }
         }
     },
     htmlmin: {
         dist: {
             options: {
                 removeComments: true,
                 collapseWhitespace: true
             },
             files: {
                 './../music_db/index.html':   './../music_db/index.html',
             }
         }
     },
     watch: {
         options : {
             livereload: 7777
         },
         protractor: {
             files: ['js/app.js','test/e2e/**/*.js'],
             tasks: ['protractor:auto']
         }
     },

        requirejs: {
            scripts: {
                options: {
                    baseUrl: './js/',
                    findNestedDependencies: true,
                    logLevel: 0,
                    mainConfigFile: './js/loader.js',
                    name: 'loader',
                    onBuildWrite: function (moduleName, path, contents) {
                        var modulesToExclude, shouldExcludeModule;
                        modulesToExclude = ['loader'];
                        shouldExcludeModule = modulesToExclude.indexOf(moduleName) >= 0;
                        if (shouldExcludeModule) {
                            return '';
                        }
                        return contents;
                    },
                     optimize: 'uglify',
                   // optimize: 'none',//for debugging
                    out: './../music_db/js/app.min.js',
                    preserveLicenseComments: true,
                    skipModuleInsertion: true,
                    uglify: {
                        no_mangle: true
                    }
                }
            },
            styles: {
                options: {
                    baseUrl: './css/',
                    cssIn: './css/all.css',
                    logLevel: 0,
                    optimizeCss: 'standard',
                    out: './../music_db/css/app.min.css'
                }
            }
        },
     connect: {
         options: {
             base: './'
         },
         webserver: {
             options: {
                 port: 8888,
                 keepalive: true
             }
         },
         devserver: {
             options: {
                 port: 8888
             }
         },
         testserver: {
             options: {
                 port: 9999
             }
         },
         coverage: {
             options: {
                 base: 'coverage/',
                 port: 5555,
                 keepalive: true
             }
         }
     },
     open: {
         devserver: {
             path: 'http://localhost:8888'
         },
         coverage: {
             path: 'http://localhost:5555'
         }
     },

     karma: {
         unit: {
             configFile: './test/karma-unit.conf.js',
             autoWatch: false,
             singleRun: true
         },
         unit_auto: {
             configFile: './test/karma-unit.conf.js',
             autoWatch: true,
             singleRun: false
         },
         unit_coverage: {
             configFile: './test/karma-unit.conf.js',
             autoWatch: false,
             singleRun: true,
             reporters: ['progress', 'coverage'],
             preprocessors: {
                 'js/app.js': ['coverage']
             },
             coverageReporter: {
                 type : 'html',
                 dir : 'coverage/'
             }
         },
     },

     protractor: {
         options: {
             keepAlive: true,
             configFile: "./test/protractor.conf.js"
         },
         singlerun: {},
         auto: {
             keepAlive: true,
             options: {
                 args: {
                     seleniumPort: 4444
                 }
             }
         }
     },

    });



    //single run tests
    grunt.registerTask('test', ['test:unit', 'test:e2e']);
    grunt.registerTask('test:unit', ['karma:unit']);
    grunt.registerTask('test:e2e', ['connect:testserver','protractor:singlerun']);

    //autotest and watch tests
    grunt.registerTask('autotest', ['karma:unit_auto']);
    grunt.registerTask('autotest:unit', ['karma:unit_auto']);
    grunt.registerTask('autotest:e2e', ['connect:testserver','shell:selenium','watch:protractor']);

    //coverage testing
    grunt.registerTask('test:coverage', ['karma:unit_coverage']);
    grunt.registerTask('coverage', ['karma:unit_coverage','open:coverage','connect:coverage']);

    //installation-related
    grunt.registerTask('install', ['update','shell:protractor_install']);
    grunt.registerTask('update', ['shell:npm_install']);

    //server daemon
    grunt.registerTask('serve', ['connect:webserver']);

    //defaults
    grunt.registerTask('default', ['dev']);

    //parse index.tpl.html, Run this every time you modify index.tpl.html
    grunt.registerTask('compileindex', [
        'env:dev', //set the production environmental parameter
        'preprocess:dev',  //parse the index.tpl.html file
    ]);

    //development
    grunt.registerTask('dev', [
        'env:dev', //set the production environmental parameter
        'preprocess:dev',  //parse the index.tpl.html file to index.html
       // 'connect:devserver',//nodejs server,optionally
       // 'open:devserver',
        'ts:dev',//Compile and watch  the Typescript files.Output is app.js
    ]);

    //production
    grunt.registerTask('prod',
        [
            'ts:prod',
           'html2js',  //bake all partial tpl.html files into a single  views.js file to be concatenated and minified with the rest of the js files.
           'concat:prod_css', //concatenate all css files to app.css and copy to music_db
           'requirejs', //concatenate and minify all js files,minimize the concatenated app.css file.Copy them to music_db folder.
            'env:prod', //set the production environmental parameter
            'preprocess:prod',  //parse the index.tpl.html file and copy  to music_db
            'copy:fontsprod', //copy fonts to music_db
            'imagemin', //minimize images
            'htmlmin:dist', //let's go grazy and minimize even html!
        ]);

};
