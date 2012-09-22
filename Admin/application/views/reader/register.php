<?php
/*
 * Created on 2012-9-8
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<script type="text/javascript" src="<?php base_url()?>js/ajax.js"></script>
<form class="form-horizontal" action="<?php echo base_url()?>index.php/reader/readerregister" method="post" name="readerregisterform">
  <div class="control-group">    
    <label class="control-label" for="inputEmail">Username</label>
    <div class="controls">
      <input type="text" id="inputUsername" placeholder="Username" name="readername" onblur='checkname()'>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <input type="password" id="inputPassword" placeholder="Password" name="readerpass" >
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">ConfigPassword</label>
    <div class="controls">
      <input type="password" id="inputPassword" placeholder="ConfigPassword" name="ConfigPassword" onblur="check">
    </div>
  </div> 
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
      <input type="text" id="inputEmail" placeholder="Email" name="readeremail">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">PaperType<?php echo "&nbsp&nbsp"?></label>
	<div class="controls">
      <select class="span2" name="papertype">
		<option selected="selected">身份证</option>
		<option>士兵证</option>
		<option>学生证</option>
      </select>
   </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputPaperCode">PaperCode</label>
    <div class="controls">
      <input type="text" id="inputPaperCode" placeholder="PaperCode" name="papercode">
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">
      
      <button type="submit" class="btn" name="register">Register</button>
    </div>
  </div>
  
</form>


<script type="text/javascript">
check(theForm)
{
	if(theForm.readerpass.value!=theForm.ConfigPass.vlaue)
	{
		alert ("Error!");
	}
}

</script>









