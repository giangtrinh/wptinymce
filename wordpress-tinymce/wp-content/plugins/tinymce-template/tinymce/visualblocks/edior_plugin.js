(function() {
	tinymce.PluginManager.add( 'post_template', function( editor, url ) {
		    text: 'Example plugin',
			context: 'tools',
			onclick: function() {
			  // Open window with a specific url
			  editor.windowManager.open({
				title: 'TinyMCE site',
				url: 'http://www.tinymce.com',
				width: 800,
				height: 600,
				buttons: [{
				  text: 'Close',
				  onclick: 'close'
				}]
			  });
			}
		  });
	});
})();