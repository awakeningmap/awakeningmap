define(function (require) {

	var Vue = require('elgg/Vue');

	var template = require('text!admin/landing/editor/components/HtmlBlock.html');

	Vue.component('landing-editor-htmlblock', {
		template: template,
		props: {
			block: {
				type: Object
			},
			parentId: {}
		},
		data: function() {
			return {
				
			};
		},
		methods: {
            escapeHtml: function(html) {
                var div = document.createElement('div');
                var text = document.createTextNode(html);
                div.appendChild(text);
                
                return div.innerHTML;
            },

			resolveInputName: function(prop) {
				return 'blocks[' + this.parentId + '][' + prop + ']';
			}
		}
	});

});