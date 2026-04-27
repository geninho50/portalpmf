/* globals require, process */
/* jshint node: true */

'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const del = require('del');
const pump = require('pump');
const jshint = require('gulp-jshint');
const gulpif = require('gulp-if');
const fs = require('fs');
const path = require('path');
const rename = require('gulp-rename');
const merge = require('merge-stream');


var isDev = false;
var isDeploy = false;
var suffix;

for (var i = 0; i  < process.argv.length; i++){
	if (process.argv[i] == '--dev') isDev = true;
	if (process.argv[i] == '--deploy') isDeploy = true;
	if (process.argv[i].substr(0,9) === '--suffix=') suffix = process.argv[i].substr(9);
}

const pathBase = {
  commonSrc: './',
	scriptsSrc: './scripts/js/xtt',
  sassSrc: './layout/sass',
  fontsSrc: './layout/fonts'
};

const paths = {
	scssSrc: pathBase.sassSrc + '/**/*.scss',
	scssDest: pathBase.commonSrc + '/layout/themePMF/css',
	hsfSrc: pathBase.scriptsSrc + '',
	hsfDest: pathBase.commonSrc + '/layout/themePMF/js',
	libsSrc: pathBase.commonSrc + '/scripts/js/libs',
	libsDest: pathBase.commonSrc + '/layout/themePMF/lib',
	fontsSrc: [
		pathBase.fontsSrc + "/Libre_Franklin/*",
		pathBase.fontsSrc + "/Work_Sans/*"
	],
	fontsDest: pathBase.commonSrc + '/layout/themePMF/fonts'
};


gulp.task('sass', function () {
  pump([
		gulp.src(paths.scssSrc),
		gulpif(process.argv.indexOf('--deploy') < 0, sourcemaps.init({largeFile: true})),
		sass({
			outputStyle: (process.argv.indexOf('--deploy') < 0) ? 'expanded' : 'compressed'
		}).on('error', sass.logError),
		autoprefixer({
			browsers: ['last 2 versions', 'ie > 11', 'iOS >= 7'],
			cascade: false
		}),
		sourcemaps.write('.'),
		gulpif(process.argv.indexOf('--deploy') < 0, sourcemaps.write('.')),
		concat('style.css'),
		gulp.dest(paths.scssDest)
	]);
});

function getFolders(dir) {
    return fs.readdirSync(dir)
      .filter(function(file) {
        return fs.statSync(path.join(dir, file)).isDirectory();
      });
}
gulp.task('header', function(){
	pump([
		gulp.src([pathBase.sassSrc + "/header.scss", pathBase.sassSrc + "font-awesome/font-awesome"]),
		sass({
			outputStyle: 'compressed'
		}).on('error', sass.logError),
		autoprefixer({
			browsers: ['last 2 versions', 'ie >= 10', 'iOS >= 7'],
			cascade: false
		}),
		concat('header.min.css'),
		gulp.dest(paths.scssDest)
	]);
	pump([
		gulp.src(path.join(paths.hsfSrc, '/xtt.header.js')),
			jshint({
				devel: true
			}),
			jshint.reporter('default'),
			jshint.reporter('fail'),
			concat('main.js'),
			gulp.dest(paths.hsfDest),
			uglify(),
			rename('header.min.js'),
			gulp.dest(paths.hsfDest)
	]);
});

gulp.task('general-js', function(cb) {
	pump([
		gulp.src(path.join(paths.hsfSrc, '/*.js')),
			jshint({
				devel: isDev
			}),
			jshint.reporter('default'),
			jshint.reporter('fail'),
			gulpif(isDeploy, sourcemaps.init({largeFile: true})),
			concat('main.js'),
			gulp.dest(paths.hsfDest),
			gulpif(!isDev, uglify()),
			gulpif(isDeploy, sourcemaps.write('.')),
			rename('main.min.js'),
			gulp.dest(paths.hsfDest)
	],cb);
});

gulp.task('specific-page-js', function() {
	var folders = getFolders(pathBase.scriptsSrc);
	folders.forEach(function(folder){
		pump([
			gulp.src(path.join(paths.hsfSrc, folder, '/*.js')),
				jshint({
					devel: isDev
				}),
				jshint.reporter('default'),
				jshint.reporter('fail'),
				gulpif(isDeploy, sourcemaps.init({largeFile: true})),
				concat(folder + '.js'),
				gulp.dest(paths.hsfDest),
				gulpif(!isDev, uglify()),
				gulpif(isDeploy, sourcemaps.write('.')),
				rename(folder + '.min.js'),
				gulp.dest(paths.hsfDest)
		]);
	});
});

gulp.task('clean', function () {
	del([
		pathBase.commonSrc + '/layout/themePMF/css/*',
		pathBase.commonSrc + '/layout/themePMF/js/*'
	]);
});

gulp.task('watch', function () {
	gulp.watch(paths.scssSrc, ['sass']);
	gulp.watch(paths.hsfSrc + "/**/*.js", ['specific-page-js', 'general-js']);
});


gulp.task('default', ['specific-page-js', 'general-js', 'sass', 'header']);
