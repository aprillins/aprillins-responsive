module.exports = function(grunt){
	//grunt configuration goes here
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		compass: {
		    dev: {
			options: {
				sassDir: 'sass',
				cssDir: 'css',
				imagesDir: 'images',
				environment: 'development',	
				httpGeneratedImagesPath: ' images'
				}
			}
		},
		watch: {
			scripts: {
				options: {livereload: true},
				files: ['sass/*.scss'],
				tasks: ['compass'],
				
			}
		}
		
	});
	
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.registerTask('default', ['compass:dev']);
}
