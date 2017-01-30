// See the readme file for instructions on installing and running gulp

/**
 * Load Plugins.
 */
var gulp = require('gulp');

// Lazy-load in the order of plugins defined in package.json
// NOTE: prepend task/plugin names with fs object to access
var fs = require('gulp-load-plugins')({
	rename: {
		'gulp-combine-mq': 'combineMediaQueries',
		'gulp-strip-debug': 'stripDebug'
	}
});

/**
 * Set Up Variables for css and javascript tasks
 */

// Grab all sass files in all subdirectories
var styleSrc = 'assets/src/scss/**/*.scss';

// Final output destination for compile sass file
var styleOutputDest = 'assets/css';

// Final output name to be served to the browser
var jsOutputName = 'main.js';

// Final output destination for jsOutputName
var jsOutputDest = 'assets/js';

// Scripts that are enqueued on specific pages
var singleScripts = [
	'assets/src/js/customizer.js',
	'assets/src/js/navigation.js',
	'assets/src/js/skip-link-focus-fix.js'
];

// these scripts will end up compiled together into a 'main.js' file
var prodScripts = [
	'assets/src/js/default.js',
];

/**
 * Task: styles
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *  1. Gets the source scss file
 *  2. Compiles Sass to CSS
 *  3. Autoprefixes it and generates style.css and admin.css
 *  4. Output the final css file
 */
gulp.task('styles', function () {
	gulp.src(styleSrc)
		.pipe(fs.plumber({
			errorHandler: fs.notify.onError('Gulp!: <%= error.message %>')
		}))
		.pipe(fs.sass({
			errLogToConsole: true
		}))
		.pipe(fs.autoprefixer(
			'last 2 version',
			'> 1%',
			'safari 5',
			'ie 9',
			'opera 12.1',
			'ios 6',
			'android 4'))
		.pipe(fs.combineMediaQueries())
		.pipe(fs.cssmin())
		.pipe(fs.rename({suffix: '.min'}))
		.pipe(fs.size({ showFiles:true, showTotal: false }))
		.pipe(gulp.dest(styleOutputDest))
});


/**
 * Task: scripts
 *
 * Concatenate, uglify and output expanded and minified network javascript files.
 *
 * This task does the following:
 *  1. Gets the source folder for vendor, custom js files. Array order is important here.
 *  2. Concatenates all the script files into jsOutputName.js and output to the designated folder
 *  3. Create jsOutputName.min.js and Uglifes/Minifies the script file
 *  4. Place the final generated script file to the designated folder
 */
// Concatenate JS Files
gulp.task('prodscripts', function () {
    return gulp.src(prodScripts)
        .pipe(fs.plumber({
            errorHandler: fs.notify.onError('Gulp!: <%= error.message %>')
        }))
        .pipe(fs.concat(jsOutputName))
        .pipe(fs.rename({suffix: '.min'}))
		.pipe(fs.stripDebug())
		.pipe(fs.streamify(fs.uglify()))
		.pipe(fs.size({ showFiles:true, showTotal: false }))
        .pipe(gulp.dest(jsOutputDest));
});

/**
 * 1) Unminified files written to output folder
 * 2) Pipe maintained, .min added
 * 3) Console Logs stripped
 * 4) Files Minified
 * 5) File Size Report generated for terminal
 * 6) Pipe-out minified files
 */
gulp.task('singlescripts', function () {
	return gulp.src(singleScripts)
        .pipe(fs.plumber({
            errorHandler: fs.notify.onError('Gulp!: <%= error.message %>')
        }))
        .pipe(gulp.dest(jsOutputDest))
        .pipe(fs.rename({suffix: '.min'}))
		.pipe(fs.stripDebug())
        .pipe(fs.streamify(fs.uglify()))
		.pipe(fs.size({ showFiles:true, showTotal: false }))
		.pipe(gulp.dest(jsOutputDest));
});

// Default Task
gulp.task( 'default', ['styles', 'prodscripts', 'singlescripts'] );

// Watch Task
gulp.task('watch', ['styles', 'prodscripts', 'singlescripts'], function () {
    gulp.watch(styleSrc, ['styles']);
    gulp.watch(prodScripts, ['prodscripts']);
    gulp.watch(singleScripts, ['singlescripts']);
});