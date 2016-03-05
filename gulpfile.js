'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();

gulp.task('default', ['browserSync', 'sass', 'sass:watch'], function() {

});

gulp.task('browserSync', function() {
  browserSync.init([
  	'app/Resources/assets'
  ], {
  	proxy: '127.0.0.1:8000'
  });
})
 
gulp.task('sass', function() {
  return gulp.src('./app/Resources/assets/sass/application.scss')
  	.pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./web/styles'))
    .pipe(browserSync.reload({
      stream: true
    }));
});
 
gulp.task('sass:watch', function() {
  gulp.watch('./app/Resources/assets/sass/*.scss', ['sass']);
});