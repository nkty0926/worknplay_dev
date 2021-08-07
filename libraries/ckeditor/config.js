/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	config.language = 'en';
	config.height = 230;
	config.resize_minHeight = 400;
	config.resize_maxHeight = 630;
	config.allowedContent = true;
	config.toolbarCanCollapse = true;
	config.toolbarStartupExpanded = false;
	config.filebrowserUploadUrl = '/actions/FileUpload';
	// config.contentsCss = [ '/assets/css/custom.css', '/assets/css/worknplay.css' ];
	// config.skin = 'be';
	config.extraPlugins = [ 'oembed', 'bootstrapTabs', 'jsplusInclude', 'jsplusBootstrapTableTools', 'jsplusBootstrapTools', 'jsplus_maps' ];
	config.jsplusInclude = { framework: 'b4',
			css: [ '/assets/css/custom.css', '/assets/css/worknplay.css' ],
			js: [ '/assets/js/custom.js', '/assets/js/custom.form.js', '/assets/js/worknplay.js', '/assets/js/worknplay.form.js' ],
			includeCssToGlobalDoc: false, includeJsToGlobalDoc: false, includeTheme: false, includeIeFix: false, inContainer: false, includeJQuery: true
	};
	config.jsplus_bootstrap_table_new_default_bordered = true;
	config.jsplus_bootstrap_table_new_default_striped = false;
	config.jsplus_bootstrap_table_new_default_condensed = false;
	config.jsplus_maps_api_key = 'AIzaSyBiitqGFFM9Rm3hLqJ6Th0Ony2L1LUXDKY';
	config.jsplus_maps_default_x = '37.566535';
	config.jsplus_maps_default_y = '126.9779692';
	config.jsplus_maps_default_zoom = 11;
	config.toolbar = [
		{ name: 'document', items: [ 'NewPage', 'Source', 'Maximize', 'ShowBlocks' ] },
		{ name: 'clipboard', items: [ 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText' ] },
		{ name: 'paragraph', items: [ 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
		{ name: 'blocks', items: [ 'NumberedList', 'BulletedList', 'Blockquote', 'CreateDiv' ] },
		{ name: 'links', items: [ 'Link', 'Unlink' ] },
		{ name: 'insert', items: [ 'HorizontalRule', 'SpecialChar', 'Image', /*'Table', */'oembed', 'BootstrapTabs', 'jsplus_maps' ] },
		{ name: 'styles', items: [ 'Styles', 'Format', 'FontSize' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		'/',
		{ name: 'jsplusBootstrapTools', items: [ 'jsplusShowBlocks', '-', 'jsplusBootstrapToolsRowAdd', 'jsplusBootstrapToolsRowDelete', 'jsplusBootstrapToolsRowAddBefore', 'jsplusBootstrapToolsRowAddAfter', 'jsplusBootstrapToolsRowMoveUp', 'jsplusBootstrapToolsRowMoveDown', '-', 'jsplusBootstrapToolsColEdit', 'jsplusBootstrapToolsColAdd', 'jsplusBootstrapToolsColDelete', 'jsplusBootstrapToolsColAddBefore', 'jsplusBootstrapToolsColAddAfter', 'jsplusBootstrapToolsColMoveLeft', 'jsplusBootstrapToolsColMoveRight' ] },
		{ name: 'jsplusBootstrapTableTools', items: [ 'jsplus_bootstrap_table_new', 'jsplus_bootstrap_table_conf', '-', 'jsplus_bootstrap_table_row_conf', 'jsplusTableRowDelete', 'jsplusTableRowAddBefore', 'jsplusTableRowAddAfter', 'jsplusTableRowMoveUp', 'jsplusTableRowMoveDown', '-', 'jsplus_bootstrap_table_col_conf', 'jsplusTableColDelete', 'jsplusTableColAddBefore', 'jsplusTableColAddAfter', 'jsplusTableColMoveLeft', 'jsplusTableColMoveRight', '-', 'jsplus_bootstrap_table_cell_conf', 'jsplusTableCellMergeRight', 'jsplusTableCellMergeDown', 'jsplusTableCellSplit' ] }
	];
};
// jsplusInclude, jsplusBootstrapTools: r.includeJs&&r.includeJQuery&&e.jMm("/assets/js/jquery.min.js",o)
// jsplus_maps: &key=AIzaSyBiitqGFFM9Rm3hLqJ6Th0Ony2L1LUXDKY&language=en&region=en
//	var c=1;this.softed=0;this.unprotectSource=function(f){a="";