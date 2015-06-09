module.exports = function(grunt) {

  // Je préfère définir mes imports tout en haut
	grunt.loadNpmTasks('grunt-contrib-less')
	grunt.loadNpmTasks('grunt-contrib-watch')
	grunt.loadNpmTasks('grunt-autoprefixer');

  // Configuration de Grunt
  grunt.initConfig({
    less: {
      dev: {
        options: {
          paths: ["."],
          sourceMap: true,
		  sourceMapFilename: "front.css.map"
        },
		files: { "front.css": "front.less" }
      },
      dist: {
        options: {
          paths: ["."],
          cleancss: true,
          compress: true,
        
        },
		files: { "front.css": "front.less" }
      }
    },
	autoprefixer: {
		target: {
			options: { map: true },
			files: "front.css"
		}
	},
	watch: {
		less: {
			files: '*.less',
			tasks: ['less:dev'],
			options: { livereload: true }
		},
		prefixer: {
			files: '*.css',
			tasks: ['autoprefixer:target']		
		}
	}
  })

  grunt.registerTask('default', ['dev', 'watch'])
  grunt.registerTask('dev', ['less:dev', 'autoprefixer:target'])
  grunt.registerTask('dist', ['less:dist', 'autoprefixer:target'])
}
