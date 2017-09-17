/*!
 * gulp-htmlcomb
 * https://github.com/fengyuanchen/gulp-htmlcomb
 *
 * Copyright (c) 2015 Fengyuan Chen
 * Released under the MIT license
 */

'use strict';

var gutil = require('gulp-util');
var through2 = require('through2');
var RcLoader = require('rcloader');
var HTMLComb = require('htmlcomb');

module.exports = function (options) {
  var rcLoader = new RcLoader('.htmlcombrc', options);
  var htmlcomb = new HTMLComb(options);

  return through2.obj(function (file, enc, cb) {
    if (file.isNull()) {
      cb(null, file);
      return;
    }

    if (file.isStream()) {
      cb(new gutil.PluginError('gulp-htmlcomb', 'Streaming not supported'));
      return;
    }

    rcLoader.for(file.path, function (err, options) {
      if (!err) {
        try {
          file.contents = new Buffer(htmlcomb.format(String(file.contents), options));
        } catch (e) {
          err = e;
        }
      }

      if (err) {
        cb(new gutil.PluginError('gulp-htmlcomb', err));
        return;
      }

      cb(null, file);
    });
  }, function (cb) {
    cb();
  });
};
