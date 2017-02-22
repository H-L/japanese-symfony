var gulp         = require('gulp'),
    concat       = require('gulp-concat'),
    sass         = require('gulp-sass'),
    postcss      = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    uglify       = require('gulp-uglify'),
    pump         = require('pump'),
    cleanCSS = require('gulp-clean-css'),
    exec = require('child_process').exec;

var processors = [
  autoprefixer
];

gulp.task('scss', function() {
    return gulp.src('app/Resources/scss/main.scss')
        .pipe(sass())
        .pipe(postcss(processors))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('web/css'))
});

gulp.task('bo-scss', function() {
    return gulp.src('app/Resources/back-office-scss/bo-main.scss')
        .pipe(sass())
        .pipe(postcss(processors))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('web/css'))
});

gulp.task('scripts', function () {
    return gulp.src('app/Resources/js/*.js')
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest('web/js'));
});

gulp.task('server', function () {
    exec('php app/console server:run', logStdOutAndErr);
});

// Without this function exec() will not show any output
var logStdOutAndErr = function (err, stdout, stderr) {
    console.log(stdout + stderr);
};

gulp.task('sync', ['server','scss','bo-scss', 'scripts'], function() {
    gulp.watch("app/Resources/back-office-scss/**/*.scss", ['bo-scss']);
    gulp.watch("app/Resources/scss/**/*.scss", ['scss']);
    gulp.watch("app/Resources/js/**", ['scripts']);
});

gulp.task('watch', ['scss','bo-scss', 'scripts'], function() {
    gulp.watch("app/Resources/back-office-scss/**/*.scss", ['bo-scss']);
    gulp.watch("app/Resources/scss/**/*.scss", ['scss']);
    gulp.watch("app/Resources/js/**", ['scripts']);
});
