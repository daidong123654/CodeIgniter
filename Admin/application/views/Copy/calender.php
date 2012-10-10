 <div class="x-form-item" >
	  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">生日:</label>
	  <div class="x-form-element"  style="padding-left: 80px;">
	  <input name="dob" id="dob" type="text"  size="12" value='<?php echo $editing['dob']?>'  class="x-form-text x-form-field " readonly="readonly" />
	  <input name="selbtn" type="button"  id="selbtn" onclick="return showCalendar('dob', '%Y-%m-%d', false, false, 'selbtn');" value="选择" class="button"   />
	  </div>
	  <div class="x-form-clear-left"></div>
    </div>
	