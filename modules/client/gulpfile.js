/**
 *  Welcome to your gulpfile!
 *  The gulp tasks are splitted in several files in the gulp directory
 *  because putting all here was really too long
 */

'use strict';

var gulp = require('gulp');
var wrench = require('wrench');
var uglify = require('gulp-uglify');
var jshint = require('gulp-jshint');
var args   = require('yargs').argv;
var gulpif = require('gulp-if');
/**
 *  This will load all js or coffee files in the gulp directory
 *  in order to load all gulp tasks
 */
wrench.readdirSyncRecursive('./gulp').filter(function(file) {
  return (/\.(js|coffee)$/i).test(file);
}).map(function(file) {
  require('./gulp/' + file);
});


/**
 *  Default task clean temporaries directories and launch the
 *  main optimization build task
 */
gulp.task('default', ['clean'], function () {
  gulp.start('build');
});

gulp.task('compress', function() {
  return gulp.src("src/app/**/"+args.modulo+"/**/**/**/*.js")
    .pipe(uglify())
    .pipe(gulp.dest('src/dist'));
});


gulp.task('jshint', function() {
  return gulp.src("src/app/"+args.modulo+"/**/**/**/*.js")
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'));
});

gulp.task('tasks', function() {
  gulp.start('jshint', 'compress');
})
