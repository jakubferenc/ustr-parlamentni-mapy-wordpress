// ==========================================
// 1. DEPENDENCIES
// ==========================================
// node modules
const fs = require('fs');

// gulp-dev-dependencies
const gulp = require('gulp');

// check package.json for gulp plugins
const gulpLoadPlugins = require('gulp-load-plugins');
const $ = gulpLoadPlugins();

// dev-dependencies
const browserSync = require('browser-sync').create();
const ftp = require( 'vinyl-ftp' );
const changed = require('gulp-changed')
const ftpSettings = require('./ftp.json');

const GulpSSH = require('gulp-ssh');

const settingsSSH = require('./ssh.json');


// ==========================================
// 2. CONFIG
// ==========================================
const configSSH = {
  host: settingsSSH.host,
  port: settingsSSH.port,
  username: settingsSSH.username,
  privateKey: fs.readFileSync(settingsSSH.privateKey)
}
// ==========================================
// 3. FUNCTIONS
// ==========================================
const gulpSSH = new GulpSSH({
  ignoreErrors: false,
  sshConfig: configSSH
})
// ==========================================
// 4. TASKS
// ==========================================

gulp.task('deployFtp', function () {
  var conn = ftp.create( {
      host:     ftpSettings.ftp.host,
      user:     ftpSettings.ftp.user,
      password: ftpSettings.ftp.password,
      parallel: 10,
      timeOffset: ftpSettings.ftp.time
  } );

  return gulp.src( ftpSettings.globs, { base: ftpSettings.base, buffer: false } )
      .pipe( conn.newerOrDifferentSize( ftpSettings.ftp.dir ) )
      .pipe( conn.dest( ftpSettings.ftp.dir ) )
      .pipe(browserSync.stream());
});

gulp.task('buildStage', function () {
  return gulpSSH
    .shell(['cd /www/jakubferenc.cz/ustr-parlamentni-mapy/', 'composer update'], {filePath: 'shell.log'})
    .pipe(gulp.dest('logs'))
})

gulp.task('deployProduction', function () {
  return gulpSSH
    .shell(['cp -Rfu /www/assemblage.cz/DOPLNIT/. /www/DOPLNIT.cz/'], {filePath: 'shell.log'})
    .pipe(gulp.dest('logs'))

});
