(function() {
	tinymce.PluginManager.add( 'post_template', function( editor, url ) {
		// Add Button to Visual Editor Toolbar
		editor.addButton('post_template', {
			text: 'My button',
			icon: false,
			onclick: function() {
			  // Open window
			  editor.windowManager.open({
				title: 'Image and Text', 
				body: [
				  {type: 'textbox', name: 'title', label: 'Title'},
				  {type: 'textbox', name: 'content', label: 'Content'}
				],
				onsubmit: function(e) {
				  // Insert content when the window form is submitted
				  editor.insertContent('Title: ' + e.data.title);
				  editor.insertContent('Content: ' + e.data.content);
				}
			  });
			}
		  });  
	});
})();