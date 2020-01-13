<template>
	<vue-ckeditor v-model="dataName"  required  :config="config" @blur="onBlur($event)" @focus="onFocus($event)" />
</template>
<script>
	import VueCkeditor from "vue-ckeditor2";

	const checkEditor = {
		props:['mydata', 'retData'],

		created: function(){
			this.$watch('mydata', function(newVal, oldVal){
				this.dataName = newVal;
			});
			this.$watch('dataName', function(newVal, oldVal){
				this.retData(newVal);
			});
		},

		components: { VueCkeditor },


		data:function() {
			return{
				config: {
					toolbar: [
					{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
					{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
					{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
					{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
					'/',
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
					{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
					{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
					{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
					'/',
					{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
					{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
					{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
					{ name: 'others', items: [ '-' ] },
					{ name: 'about', items: [ 'About' ] },
					{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
					{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
					{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
					{ name: 'forms' },
					'/',
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
					{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
					{ name: 'links' },
					{ name: 'insert' },
					'/',
					{ name: 'styles' },
					{ name: 'colors' },
					{ name: 'tools' },
					{ name: 'others' },
					{ name: 'about' }
					]
				},
				dataName: ""
			}
		},
		methods: {
			onBlur(editor) {
				console.log(editor);
			},
			onFocus(editor) {
				console.log(editor);
			}
		}
	}
	export default checkEditor;

</script>
