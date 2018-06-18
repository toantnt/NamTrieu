<input type="hidden" name="slide_id" value="<?php echo $result->slide_id ?>" /> 
<div class="form-group row">
    <label class="label-control col-md-3">Slider title</label>
    <div class="col-md-9">
        <input type="text" name="slide_name" value="<?php echo $result->slide_name ?>" class="form-control" />
    </div>
</div>
<div class="form-group row">
	<label class="label-control col-md-3">Image</label>
	<div class="col-md-9">
		<div class="input-group">
			<input type="text" name="slide_image" class="form-control" id="ImageUrl<?php echo $result->slide_id ?>" value="<?php echo $result->slide_image ?>" /><span class="input-group-btn">
			<button class="btn btn-primary" type="button" onclick="return getImage('ImageUrl<?php echo $result->slide_id ?>');"><i class="glyphicon glyphicon-search"></i></button></span>
		</div>
	</div>
</div> 
<div class="form-group">
    <label class="label-control col-md-3">Summary</label>
    <div class="col-md-9">
        <textarea name="slide_summary" rows="2" class="form-control"><?php echo $result->slide_summary ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="label-control col-md-3">Collection</label>
    <div class="col-md-6">
		<select name="slide_collection" class="form-control">
			<option value="">Select collection</option>
			<?php 
			if(isset($collection)) {
				foreach ($collection as $item) {
					if($result->slide_collection == $item->cat_id) {
						echo '<option value="'.$item->cat_id.'" selected="selected">'.$item->cat_name.'</option>';
					} else {
						echo '<option value="'.$item->cat_id.'">'.$item->cat_name.'</option>';
					}
					
				}
			} ?>
		</select>
    </div>
</div>