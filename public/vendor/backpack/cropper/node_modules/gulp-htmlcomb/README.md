# [gulp-htmlcomb](https://github.com/fengyuanchen/gulp-htmlcomb)

> [HTMLComb](https://github.com/fengyuanchen/htmlcomb) plugin for [Gulp](http://gulpjs.com).


## Getting Started

### Install

```
npm install gulp-htmlcomb
```


### Usage

```js
var gulp = require('gulp'),
    htmlcomb = require('gulp-htmlcomb');

gulp.task('htmlcomb', function () {
  return gulp.src('src/*.html')
  .pipe(htmlcomb(/*options*/))
  .pipe(gulp.dest('dist'));
});
```


## Options

See the [HTMLComb options](https://github.com/fengyuanchen/htmlcomb#options)

If there is `.htmlcombrc` file present in the same folder as the source file(s), or in the project root folder, gulp-htmlcomb will read config settings from it.


## [License](LICENSE.md)

[MIT](http://opensource.org/licenses/MIT) © [Fengyuan Chen](http://github.com/fengyuanchen)
