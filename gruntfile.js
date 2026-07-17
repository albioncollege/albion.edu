module.exports = function(grunt) {

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({

        watch: {
            css: {
                files: ['src/scss/**/*.scss'],
                tasks: ['sass', 'autoprefixer'],
                options: {
                    spawn: false
                }
            }
        },


        // we use the Sass
        sass: {
            dist: {
                options: {
                    // nested, compact, compressed, expanded
                    style: 'compressed'
                },
                files: {
                    'dist/css/main-unprefixed.css': 'src/scss/style.scss',
                }
            }
        },


        // auto-prefix our css3 properties.
        autoprefixer: {
            files: {
                dest: 'dist/css/main.css',
                src: 'dist/css/main-unprefixed.css'
            }
        }

    });

    // register task
    grunt.registerTask('default', ['watch']);

    // a build task just in case we want to
    grunt.registerTask('build', ['sass', 'autoprefixer']);

};