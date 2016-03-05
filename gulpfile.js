'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('default', ['sass', 'sass:watch'], function() {

});
 
gulp.task('sass', function() {
  return gulp.src('./app/Resources/assets/sass/application.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./web/styles'));
});
 
gulp.task('sass:watch', function() {
  gulp.watch('./app/Resources/assets/sass/*.scss', ['sass']);
});