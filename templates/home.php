<?php
if (isset($_POST['submit']))
{
	dtq_insert_dynamic_text( $_POST['dynamic-text'], $_POST['question'] );
	echo '<div id="message" class="updated notice is-dismissible"><p>Data Submitted Successfully. </p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
}

$question = get_option( "dtq_question" );
?>
<div class="wrap">

	<form action="admin.php?page=dynamic-text-quiz-home" method="post">

		<table class="form-table">
            <tr>
                <th>
                    <label for="question"><?= __( 'Enter Question', 'dynamic-text-quiz' )?></label>
                </th>
                <td>
                    <input type="text" value="<?= $question ?>" name="question" id="question">
                </td>
            </tr>
			<tr>
				<th>
					<label for="enter-text"><?= __( 'Enter Text', 'dynamic-text-quiz' )?></label>
				</th>
				<td>
					<?php wp_editor( "", "dynamic-text" );?>
				</td>
			</tr>
		</table>
		<?php submit_button() ?>
	</form>
</div>