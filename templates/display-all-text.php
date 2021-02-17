<?php
if (isset($_GET['id']))
{
	$id = $_GET['id'];
	dtq_delete_text_by_id($id);
	echo '<div id="message" class="updated notice is-dismissible"><p>Data Deleted Successfully. </p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

}
?>
<div class="wrap">
	<table width="100%"  style="text-align: center">
		<tr>
			<th>Id</th>
			<th>Text</th>
			<th>Delete</th>
		</tr>

		<?php $text = dtq_get_all_text();
		if (!empty($text))
		{
			foreach ( $text as $value ): ?>
			<tr>
				<td><?= $value['id'] ?></td>
				<td><?= $value['text'] ?></td>
				<td><a href="admin.php?page=dynamic-text-quiz-all-text&id=<?= $value['id'] ?>">Delete</a></td>
			</tr>
			<?php endforeach;
		} else {
			echo "No Record Found";
		} ?>
	</table>
</div>