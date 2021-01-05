const cssImport = require("postcss-import");
const cssNesting = require("postcss-nesting");
const mix = require("laravel-mix");
const path = require("path");
const purgeCss = require("@fullhuman/postcss-purgecss");
const tailwindCss = require("tailwindcss");

mix
  .js("resources/js/app.js", "public/js")
  .postCss("resources/css/app.css", "public/css/app.css")
  .options({
    postCss: [
      cssImport(),
      cssNesting(),
      tailwindCss("tailwind.config.js"),
      ...(mix.inProduction()
        ? [
            purgeCss({
              content: [
                "./resources/views/**/*.blade.php",
                "./resources/js/**/*.vue",
              ],
              defaultExtractor: (content) =>
                content.match(/[\w-/:.]+(?<!:)/g) || [],
              // whitelist: [/nprogress/, /pretty-checkbox/], //use inline ignore instead
            }),
          ]
        : []),
    ],
  })
  .webpackConfig({
    output: { chunkFilename: "js/[name].js?id=[chunkhash]" },
    resolve: {
      alias: {
        vue$: "vue/dist/vue.runtime.esm.js",
        "~": path.resolve("resources/js"),
      },
    },
  })
  .version()
  .sourceMaps();
