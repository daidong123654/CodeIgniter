<h2>Create a news item</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/create') ?>

<label for="title">Title</label>
<input id="inputSuccess" type="input" name="title" />
<!--<textarea name="text"></textarea><br/>-->
<br/>

<label for="text">Text(拖动右下角来改变大小)</label>
<textarea name="text"></textarea><br/>

<input class="btn btn-success" type=submit name="AdminLogin" value="Create news item"/>
</form>
