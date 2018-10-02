<?php
include plugin_dir_path( __FILE__ ) . '../includes/http.php';
$categories = get_categories(['exclude'=>1 ,'hide_empty' => FALSE]);
die(var_dump(get_locale()));
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<style type="text/css">
.delete-btn{
	background-color: #ad1515;
    color: white;
    border-radius: 10px;
    border: none;
    cursor: pointer;
}

.update-btn{
	background-color: #2ead15;
    color: white;
    border-radius: 10px;
    border: none;
    cursor: pointer;
}

.submit-btn{
	background-color: #1593ad;
    color: white;
    border-radius: 10px;
    border: none;
    cursor: pointer;
}

.container {
width: 80%;
max-width: 1200px;
margin: 0 auto;
}
.container * {
box-sizing: border-box;
}
.flex-outer,
.flex-inner {
list-style-type: none;
padding: 0;
}
.flex-outer {
max-width: 800px;
margin: 0 auto;
}
.flex-outer li,
.flex-inner {
display: flex;
flex-wrap: wrap;
align-items: center;
}
.flex-inner {
padding: 0 8px;
justify-content: space-between;
}
.flex-outer > li:not(:last-child) {
margin-bottom: 20px;
}
.flex-outer li label,
.flex-outer li p {
padding: 8px;
letter-spacing: .09em;
text-transform: uppercase;
}
.rtl{
	direction: rtl;
}

.flex-outer > li > label,
.flex-outer li p {
flex: 1 0 120px;
max-width: 220px;
}
.flex-outer > li > label + *,
.flex-inner {
flex: 1 0 220px;
}
.flex-outer li p {
margin: 0;
}
.flex-outer li input:not([type='checkbox']),
.flex-outer li textarea {
padding: 15px;
}
.flex-outer li button {
margin-left: auto;
padding: 8px 16px;
border: none;
background: #333;
color: #f2f2f2;
text-transform: uppercase;
letter-spacing: .09em;
border-radius: 2px;
}
.flex-inner li {
width: 100px;
}
.categories-select span.select2 {
	width: 201px!important;
}
</style>

<table class="wp-list-table widefat fixed rtl">
	<thead>
		<tr>
			<th class="manage-column column-author">#</th>
			<th class="manage-column column-author"><?php echo AG\Includes\Language::lang('attribute');?></th>
			<th class="manage-column column-author"><?php echo AG\Includes\Language::lang('url');?></th>
			<th class="manage-column column-author"><?php echo AG\Includes\Language::lang('overview');?></th>
			<th class="manage-column column-author"><?php echo AG\Includes\Language::lang('categories');?></th>
			<th class="manage-column column-author"><?php echo AG\Includes\Language::lang('action');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
				(new Attribute)->render();
		?>
	</tbody>
</table>
<br>
<div id="poststuff 	">
	<div class="postbox">
		<h2 style='cursor:auto'class="hndle ui-sortable-handle"><span><?php echo AG\Includes\Language::lang('add-attribute');?></span></h2>
		<div class="container">
			<form method="post" class='flex' action="" enctype="multipart/form-data">
				<ul class="flex-outer">
					<li>
						<label for="attribute"><?php echo AG\Includes\Language::lang('attribute');?>:</label>
						<input type="text" name='name' id="attribute" placeholder=<?php echo AG\Includes\Language::lang('attribute');?>>
					</li>
					<li>
						<label for="url"><?php echo AG\Includes\Language::lang('url-or-website');?>:</label>
						<input type="text" name='url' id="url" placeholder=<?php echo AG\Includes\Language::lang('url');?>>
					</li>
					
					<li>
						<label for="overview"><?php echo AG\Includes\Language::lang('overview');?>:</label>
						<textarea id="overview" name="overview"></textarea>
					</li>
					<li>
					
						<select multiple="true" id="categories" name="categories[]">
							<?php foreach($categories as $category){?>
							<option value="<?php echo $category->term_id?>"> <?php echo $category->name; ?></option>
							<?php }?>
						</select>
							<label ><?php echo AG\Includes\Language::lang('select-categoreis');?></label>
						<div><?php echo AG\Includes\Language::lang('select-all');?> <input type='checkbox' onchange=selectAll(this) /></div>
					</li>
					<li>
						<label for="logo"><?php echo AG\Includes\Language::lang('logo');?>:</label>
						<input type="file" name='logo' id="logo" placeholder=<?php echo AG\Includes\Language::lang('logo');?>>
					</li>
					<li>
						<input type="submit" name='create_attribute' class='submit-btn' value=<?php echo AG\Includes\Language::lang('submit');?> />
					</li>
				</ul>
			</form>
		</div>
	</div>
</div>

<script>
	
	jQuery(document).ready(function() {
		if (!jQuery.fn.select2) {
  			jQuery('select').select2();
		}
	});

	function selectAll(elem){
	
		for(var i=0; i< elem.parentElement.parentElement.childNodes[1].options.length; i++){
			elem.parentElement.parentElement.childNodes[1].options[i].selected = elem.checked;
		}
			jQuery('select').select2();
	}

</script>