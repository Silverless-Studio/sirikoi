const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const psmq = require('postcss-sort-media-queries');
const sassLint = require('gulp-sass-lint');
const cleanCss = require('gulp-clean-css');
const eslint = require('gulp-eslint-new');
const cleanJs = require('gulp-uglify');
const concat = require('gulp-concat');
const replace = require('gulp-replace');

const PATHS = {
  FUNCTIONS: {
    src: './wp-content/themes/silverless/silverless-config.php',
    dest: './wp-content/themes/silverless'
  },
  STYLES: {
    watch: './wp-content/themes/silverless/inc/scss/**/*.scss',
    src: './wp-content/themes/silverless/inc/scss/*.scss',
    dest: './wp-content/themes/silverless/inc/assets/css',
    lintExclude: [
      '!./wp-content/themes/silverless/inc/scss/05-vendor/**/*.scss'
    ]
  },
  SCRIPTS: {
    watch: './wp-content/themes/silverless/inc/js/*.js',
    src: './wp-content/themes/silverless/inc/js/**/*.js',
    dest: './wp-content/themes/silverless/inc/assets/js'
  }
};

/**
 * Bust cache
 */
gulp.task('cache:bust', () => {
  return gulp
    .src(PATHS.FUNCTIONS.src)
    .pipe(
      replace(/'version'\s*=>\s*'\d+'/gi, function handleReplace() {
        return `'version' => '${new Date().getTime()}'`;
      })
    )
    .pipe(gulp.dest(PATHS.FUNCTIONS.dest));
});

/**
 * Lint SCSS
 */
gulp.task('lint:sass', () =>
  gulp
    .src([PATHS.STYLES.watch, ...PATHS.STYLES.lintExclude])
    .pipe(
      sassLint({
        rules: {
          'leading-zero': 0,
          'hex-length': [1, { style: 'long' }],
          'mixins-before-declarations': [1, { exclude: ['respond'] }],
          'class-name-format': [1, { convention: 'hyphenatedbem' }],
          'nesting-depth': [1, { 'max-depth': 5 }],
          'no-transition-all': 0,
          'no-misspelled-properties': [1, { 'extra-properties': ['row-gap', 'scroll-margin-top', 'gap', 'aspect-ratio'] }]
        }
      })
    )
    .pipe(sassLint.format())
);

/**
 * Lint JS
 */
gulp.task('lint:js', () =>
  gulp
    .src(PATHS.SCRIPTS.watch)
    .pipe(
      eslint({
        overrideConfig: {
          env: { browser: true, commonjs: true, jquery: true },
          extends: ['eslint:recommended' /*, 'plugin:jquery/slim'*/],
          globals: { chrome: 'readonly' },
          plugins: ['jquery'],
          rules: { strict: 'error' },
          parserOptions: {
            ecmaVersion: 'latest'
          }
        }
      })
    )
    .pipe(eslint.format())
);

/**
 * Lint SCSS & JS
 */
gulp.task('lint', gulp.series('lint:sass', 'lint:js'));

/**
 * Compile SCSS files
 */
gulp.task(
  'compile:sass',
  gulp.series('lint:sass', () =>
    gulp
      .src(PATHS.STYLES.src)
      .pipe(
        sass({
          indentType: 'tab',
          indentWidth: 1,
          outputStyle: 'expanded' // Expanded so that our CSS is readable
        })
      )
      .on('error', sass.logError)
      .pipe(
        postcss([
          psmq({
            sort: 'mobile-first', // default value
          }),
          autoprefixer({
            cascade: false
          })
          // pcmq()
        ])
      )
      .pipe(gulp.dest(PATHS.STYLES.dest))
  )
);

/**
 * Compile SCSS files - minified
 */
gulp.task(
  'compile:sass-min',
  gulp.series('lint:sass', () =>
    gulp
      .src(PATHS.STYLES.src)
      .pipe(
        sass({
          indentType: 'tab',
          indentWidth: 1,
          outputStyle: 'expanded' // Expanded so that our CSS is readable
        })
      )
      .on('error', sass.logError)
      .pipe(
        postcss([
          psmq({
            sort: 'mobile-first', // default value
          }),
          autoprefixer({
            cascade: false
          })
        ])
      )
      .pipe(gulp.dest(PATHS.STYLES.dest))
      .pipe(cleanCss())
      .pipe(gulp.dest(PATHS.STYLES.dest))
  )
);

/**
 * Compile JS files
 */
gulp.task(
  'compile:js',
  gulp.series('lint:js', () =>
    gulp
      .src(PATHS.SCRIPTS.src)
      .pipe(concat('bundle.js'))
      .pipe(gulp.dest(PATHS.SCRIPTS.dest))
  )
);

/**
 * Compile JS files - minified
 */
gulp.task(
  'compile:js-min',
  gulp.series('lint:js', () =>
    gulp
      .src(PATHS.SCRIPTS.src)
      .pipe(concat('bundle.js'))
      .pipe(gulp.dest(PATHS.SCRIPTS.dest))
      .pipe(cleanJs())
      .pipe(gulp.dest(PATHS.SCRIPTS.dest))
  )
);

/**
 * Compile SCSS & JS files
 */
gulp.task(
  'compile',
  gulp.series('compile:sass-min', 'compile:js-min', 'cache:bust')
);

/**
 * Watch SCSS files
 */
gulp.task(
  'watch:sass',
  gulp.series('compile:sass', () => {
    gulp.watch(PATHS.STYLES.watch, gulp.series('compile:sass'));
  })
);

/**
 * Watch JS files
 */
gulp.task(
  'watch:js',
  gulp.series('compile:js', () => {
    gulp.watch(PATHS.SCRIPTS.watch, gulp.series('compile:js'));
  })
);

/**
 * Watch SCSS & JS files
 */
gulp.task('watch', gulp.parallel('watch:sass', 'watch:js'));

/**
 * Default task executed by running `gulp`
 */
gulp.task('default', gulp.series('watch'));
