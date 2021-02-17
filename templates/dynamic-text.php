<?php
if (isset($_POST['enter-name']))
{
	$name = $_POST['enter-name'];
	$scripts = dtq_get_text_by_name( $name, "dtq_callback_function_1" );
	?>
	<style type="text/css">
		.dynamic-main {
			display: none;
		}
	</style>
	<div class="dynamic-result">
		<?php if (!empty($scripts)) {
			echo dtq_make_name($scripts['text'], $name);
        } else {
		    $scripts = dtq_get_all_text();
		    echo dtq_make_name( $scripts[0]['text'], $name );
        } ?>
	</div>
<?php

}
$question = get_option( "dtq_question" );
?>

<div class="dynamic-main">
	<div class="dynamic-image">

	</div>
	<div class="dynamic-input">
        <div class="dynamic-question">
	        <?= $question ?>
        </div>
		<form action="#" method="post">
			<label for="enter-name">Enter Your Name</label>
			<input style="text-align: center" autocomplete="off" placeholder="ENTER YOUR NAME" type="text" class="dynamic-input-name" name="enter-name" id="enter-name">

			<button class="dynamic-button">
				<b>
					Click To Start
					&#8594;
				</b>
			</button>
		</form>
	</div>
</div>