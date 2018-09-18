<?php
 include plugin_dir_path( __FILE__ ) . '../includes/http.php';
?>



<table class="wp-list-table widefat fixed ">
	<thead>
		<tr>
			<th class="manage-column column-author">#</th>
			<th class="manage-column column-author">Attribute</th>
		</tr>
	</thead>
	<tbody>

	</tbody>
</table>
<br>
<?php  
	foreach (get_categories(['exclude'=>1 ,'hide_empty' => FALSE]) as $category) {
	}
?>
<form method="post" action="" enctype="multipart/form-data">


    <label for="attribute">Attribute:</label>
    <input type="text" name='name' id="attribute" placeholder="Name">
	
	<label for="url">URL or Website:</label>
    <input type="text" name='url' id="url" placeholder="Name">
	
	<label for="logo">logo:</label>
    <input type="file" name='logo' id="logo" placeholder="Name">

	<label for="overview">Overview:</label>
    <textarea id="overview" name="overview"></textarea>

    <select multiple="true" name="categories[]">
    	<option value="">Select on or more categories</option>
    	<?php foreach(get_categories(['exclude'=>1 ,'hide_empty' => FALSE]) as $category){?>
    		<option value="<?php echo $category->term_id?>"> <?php echo $category->name; ?></option>
    	<?php }?>	
    </select>

	<input type="submit" name='create_attribute' value='Submit'/>

</form>

