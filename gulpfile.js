'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('default', ['sass', 'sass:watch'], function() {

});
 
gulp.task('sass', function() {
  return gulp.src('./app/Resources/assets/sass/application.scss')
  	.pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./web/styles'));
});
 
gulp.task('sass:watch', function() {
  gulp.watch('./app/Resources/assets/sass/*.scss', ['sass']);
});