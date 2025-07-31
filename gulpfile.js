const gulp = require("gulp");
const git = require("gulp-git");
const browserSync = require("browser-sync").create();
const webpack = require("webpack-stream");
const named = require("vinyl-named");
const sourcemaps = require("gulp-sourcemaps");
const sass = require("gulp-sass")(require("node-sass"));

/**
 * Default Gulp Tasks
 */
gulp.task("serve", () => {
   browserSync.init({
      proxy: `https://jomachperu.local`,
   });

   gulp.watch("src/scss/**/*.scss", gulp.parallel("sass"));
   gulp.watch("src/js/**/*.js", gulp.parallel("js"));
});

gulp.task("sass", () =>
   gulp
      .src("src/scss/**/*.scss")
      .pipe(sourcemaps.init())
      .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
      .pipe(sourcemaps.write("."))
      .pipe(gulp.dest("assets/css"))
      .pipe(browserSync.stream())
);

gulp.task("js", () =>
   gulp
      .src(["src/js/*.js"])
      .pipe(named())
      .pipe(
         webpack({
            mode: "production",
            module: {
               rules: [
                  {
                     use: ["babel-loader"],
                  },
               ],
            },
         })
      )
      .pipe(gulp.dest("assets/js"))
);
gulp.task("default", gulp.series("sass", "js", "serve"));

/**
 * Gulp Deployment Tasks
 * todo: copy only changed files
 */
const deployPath = `_deploy/wp-content/themes/dentalup`;

gulp.task("precopy", (cb) => {
   gulp
      .src([
         "**/*",
         "!_deploy",
         "!_deploy/**/*",
         "!node_modules",
         "!node_modules/**/*",
         "!src",
         "!src/**/*",
         "!gulpfile.js",
         "!package-lock.json",
         "!package.json",
         "!README.md",
      ])
      .pipe(gulp.dest(deployPath));

   cb();
});

gulp.task("add", () => {
   return gulp
      .src("./*", { cwd: "_deploy/" })
      .pipe(git.add({ cwd: "_deploy/" }));
});

gulp.task("commit", () => {
   return gulp
      .src("./*", { cwd: "_deploy/" })
      .pipe(git.commit("merge", { cwd: "_deploy/" }));
});

gulp.task("push", (cb) => {
   git.push("origin", "main", { cwd: "_deploy/" }, (err) => {
      if (err) throw err;
   });

   cb();
});

/**
 * Simple sequence for deployment, compiles css/js, copies to folder, add/commits and pushes to wpe
 */
gulp.task("copy", gulp.series("sass", "js", "precopy"));
gulp.task("deploy", gulp.series("add", "commit", "push"));
