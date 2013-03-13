
seajs.config({
  // Enable plugins
  plugins: ['shim'],

  // Configure shim for non-CMD modules
  shim: {
    'jquery': {
      src: 'lib/jquery-1.9.1.min.js',
      exports: 'jQuery'
    },
  	'bootstrap': {
  	 src: 'lib/bootstrap.js',
  	 deps: ['jquery'],
     exports: 'jQuery'
  	}
  }
});
