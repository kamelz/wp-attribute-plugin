<?php
include plugin_dir_path( __FILE__ ) . '../includes/http.php';
$categories = get_categories(['exclude'=>1 ,'hide_empty' => FALSE]);
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
			<th class="manage-column column-author">Attribute</th>
			<th class="manage-column column-author">URL</th>
			<th class="manage-column column-author">Overview</th>
			<th class="manage-column column-author">Categories</th>
			<th class="manage-column column-author">Action</th>
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
		<h2 style='cursor:auto'class="hndle ui-sortable-handle"><span>Add Attributes</span></h2>
		<div class="container">
			<form method="post" class='flex' action="" enctype="multipart/form-data">
				<ul class="flex-outer">
					<li>
						<label for="attribute">Attribute:</label>
						<input type="text" name='name' id="attribute" placeholder="Attribute">
					</li>
					<li>
						<label for="url">URL or Website:</label>
						<input type="text" name='url' id="url" placeholder="URL">
					</li>
					
					<li>
						<label for="overview">Overview:</label>
						<textarea id="overview" name="overview"></textarea>
					</li>
					<li>
						<label >Select on or more categories</label>
						<select multiple="true" id="categories" name="categories[]">
							<?php foreach($categories as $category){?>
							<option value="<?php echo $category->term_id?>"> <?php echo $category->name; ?></option>
							<?php }?>
						</select>
					</li>
					<li>
						<label for="logo">logo:</label>
						<input type="file" name='logo' id="logo" placeholder="Logo">
					</li>
					<li>
						<input type="submit" name='create_attribute' class='submit-btn' value='Submit'/>
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