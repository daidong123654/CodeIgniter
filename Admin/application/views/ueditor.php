<?php
/*
 * Created on 2012-9-28
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<html>
<head>

<script type="text/javascript" src="<?php echo base_url();?>ueditor/editor_config.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>ueditor/editor_all.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>ueditor/themes/default/ueditor.css"/>
</head>
<body>
<div id="myEditor"></div>
<script type="text/javascript">
        var editor = new baidu.editor.ui.Editor();
        editor.render("myEditor");
</script>
</body>
</html>