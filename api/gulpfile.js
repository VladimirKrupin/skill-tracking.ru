const gulp          = require('gulp');
const autoprefixer  = require('gulp-autoprefixer');
const concat        = require('gulp-concat');
const less          = require('gulp-less');
const minifyCSS     = require('gulp-minify-css');
const uglify        = require('gulp-uglify');

var paths = {
    js:['public/src/js/scripts/**/*.*'],
    css: [
        'public/src/less/**/*.*',
        'public/src/css/**/*.*'
    ]
};

// Задачи запускаемые по умолчанию
gulp.task('default', function () {
    gulp.start([
        'css',
        'js',
        'watcher'
    ]);
});

gulp.task('watcher',function(){
    gulp.watch(paths.js, ['js']);
    gulp.watch(paths.css, ['css']);            // Запускаем задачу или ряд задач, если что-то из перечисленных файлов изменилось
});

// Сборка CSS
gulp.task('css', function () {
    gulp.src([
        'public/src/less/styles.less',
        'public/src/css/**/*.*'
    ])
        .pipe(less())
        .pipe(autoprefixer({
            browsers: ['last 5 versions'],     // CSS префиксы для последних 10 версий всех браузеров
            cascade: false                      // Отключаем визуальный каскад
        }))

        .pipe(concat(
            'main.css',                    // Файл после конкатинации
            {
                newLine: ''                     // Задаём стиль новой строки
            }
        ))
        .pipe(minifyCSS())                      // Минифицируем CSS
        .pipe(gulp.dest('public')) // Сохраняем изменения в файл
});

// Сборка JS
gulp.task('js', function () {
    gulp.src([
        'public/src/js/**/*.js'
    ])
        .pipe(uglify())                 // Минифицируем js
        .pipe(concat(
            'main.js',                    // Файл после конкатинации
            {
                newLine: ''                     // Задаём стиль новой строки
            }
        ))

        .pipe(gulp.dest('public')) // Сохраняем изменения в файл
});