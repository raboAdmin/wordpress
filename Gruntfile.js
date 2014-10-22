module.exports = function(grunt) {
    "use strict";
    
    var bowerComponents = 'fnd/bower_components/',
        foundationScriptPath = bowerComponents + 'foundation/js/foundation',
        customScripts = 'js/client/*.js',
        pluginScripts = [
            bowerComponents + 'slick-carousel/slick/slick.js'
        ];

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        banner: '/*!\n' +
            ' * <%= pkg.name %> <%= pkg.version %> (<%= pkg.homepage %>)\n' +
            ' * Copyright <%= grunt.template.today("yyyy") %> <%= pkg.author %>\n' +
            ' */\n\n',
        jqueryCheck: 'if (typeof jQuery === "undefined") { throw new Error("Foundation requires jQuery") }\n\n',
        devSwitch: 'var environment = "<%= pkg.environment %>";',

        clean: {
            dist: ['dist', 'src']
        },

        jshint: {
            options: {
                jshintrc: 'js/.jshintrc'
            }
            ,gruntfile: {
                src: 'Gruntfile.js'
            }
            ,foundation: {
                src: [foundationScriptPath + '/*.js']
            }
            ,plugins: {
                src: [pluginScripts]
            }
            ,custom: {
                src: [customScripts]
            }
        },

        concat: {
            options: {
                banner: '<%= banner %><%= jqueryCheck %><%= devSwitch %>',
                stripBanners: false
            }
            ,foundation: {
                src: [
                    bowerComponents + 'fastclick/lib/fastclick.js',
                    //Comment unused scripts out here for extra optimisingness
                    foundationScriptPath + '/foundation.js',
                    foundationScriptPath + '/foundation.abide.js',
                    //foundationScriptPath + '/foundation.accordian.js',
                    foundationScriptPath + '/foundation.alert.js',
                    //foundationScriptPath + '/foundation.clearing.js',
                    foundationScriptPath + '/foundation.dropdown.js',
                    //foundationScriptPath + '/foundation.equalizer.js',
                    //foundationScriptPath + '/foundation.interchange.js',
                    //foundationScriptPath + '/foundation.joyride.js',
                    //foundationScriptPath + '/foundation.magellan.js',
                    //foundationScriptPath + '/foundation.offcanvas.js',
                    //foundationScriptPath + '/foundation.orbit.js',
                    foundationScriptPath + '/foundation.reveal.js',
                    foundationScriptPath + '/foundation.tab.js',
                    foundationScriptPath + '/foundation.tooltip.js',
                    //foundationScriptPath + '/foundation.topbar.js',
                    pluginScripts,
                    customScripts
                ],
                dest: 'src/js/<%= pkg.name %>.js'
            }
        },

        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
                sourceMap: true
            }
            ,build: {
                src: 'src/js/<%= pkg.name %>.js',
                dest: 'dist/js/<%= pkg.name %>.min.js'
            }

        },

        compass: {
            dist: {
                options: {
                    //config: './config.rb'
                    sassDir: 'scss',
                    cssDir: 'css',
                    imagesDir: 'images',
                    fontsDir: 'css/fonts',
                    environment: '<%= pkg.environment %>'
                }
            }
        },

        copy: {
            style: {
                expand: true,
                cwd: 'css/',
                src: ['style.css'],
                dest: './'
            }
        },

        watch: {
            jsWatch: {
                files: ['Gruntfile.js', customScripts],
                tasks: ['jshint:custom', 'concat', 'uglify']
            },
            sassWatch: {
                files: ['scss/**/*.scss'],
                tasks: ['compass', 'copy']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['clean', 'jshint:custom', 'concat', 'uglify', 'compass', 'copy']);
    grunt.registerTask('js', ['jshint:custom', 'concat', 'uglify']);
    grunt.registerTask('style', ['compass', 'copy']);

};