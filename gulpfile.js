var gulp = require('gulp');
var packageJson = require(__dirname+'/package.json');
var _tasks = [
	'client'
];

// broccoli-client (frontend) を処理
gulp.task("client", function() {
	gulp.src(["node_modules/px2style/dist/**/*"])
		.pipe(gulp.dest( './htdocs/common/px2style/dist/' ))
	;
});

// src 中のすべての拡張子を処理(default)
gulp.task("default", _tasks);
