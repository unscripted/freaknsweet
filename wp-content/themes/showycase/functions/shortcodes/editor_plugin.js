
(function() {
	tinymce.create('tinymce.plugins.pt_shortcodes', {
		init : function(ed, url) {

			ed.addCommand('pt_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/interface.php',
					width : 510 + ed.getLang('pt_shortcodes.delta_width', 0),
					height : 550 + ed.getLang('pt_shortcodes.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			
			ed.addButton('pt_shortcodes', {
				title : 'Premitheme Shortcodes',
				cmd : 'pt_shortcodes',
				image : url + '/btn.png'
			});
			
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('pt_shortcodes', n.nodeName == 'IMG');
			});
			
		},
		
		createControl : function(n, cm) {
			return null;
		},
		
		getInfo : function() {
			return {
					longname  : 'pt_shortcodes',
					author 	  : 'premitheme',
					version   : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('pt_shortcodes', tinymce.plugins.pt_shortcodes);
})();


