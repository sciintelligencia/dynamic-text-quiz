<?php
if ( !function_exists( 'dtq_insert_dynamic_text' ) )
{
	function dtq_insert_dynamic_text( $attr, $question )
	{
		$option_name = "dtq_text";
		update_option( "dtq_question", $question );
		$options = get_option( $option_name );
		if ( empty($options) )
		{
			$options = [];
			$id = 0;
		} else {
			$options = unserialize($options);
			$id = end($options)['id'];
		}
		$id++;
		$option = [
			"id" => $id,
			"text"  => $attr,
			$id =>  $attr
		];

		array_push( $options, $option );
		$options = serialize($options);
		update_option( $option_name, $options );
		return $options;
	}
}

if ( !function_exists( "dtq_get_all_text" ) )
{
	function dtq_get_all_text()
	{
		$option_name = "dtq_text";
		$options = get_option( $option_name );
		if (empty($options)) {
			return $options = [];
		} else {
			return unserialize( $options );
		}
	}
}

if ( !function_exists( "dtq_get_text_by_name" ) )
{
	function dtq_get_text_by_name( $name, $callback )
	{
		$data = array();
		$count = (int) $callback($name);
		$texts = dtq_get_all_text();
		$text_count = count($texts);
		for ($i = 0; $i < $text_count ;$i++)
		{
			$data = @$texts[$count];
			$count--;
		}
		return $data;
	}
}

if ( !function_exists( "dtq_make_name" ) )
{
	function dtq_make_name( $text, $name )
	{
		$shortcode = "[name]";
		return str_replace( $shortcode, $name, $text );
	}
}

if ( !function_exists( "dtq_dd" ) )
{
	function dtq_dd( $value = "" )
	{
		var_dump($value);
		echo "<pre>";
		print_r( $value );
		echo "</pre><br>";
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		exit();
	}
}

if ( !function_exists( "dtq_delete_text_by_id" ) )
{
	function dtq_delete_text_by_id( $id )
	{
		$texts = dtq_get_all_text();
		foreach ( $texts as $text )
		{
			if ($text['id'] == $id)
			{
				unset($text);
			} else {
				$data[] = $text;
			}
		}
		if (!empty($data))
		{
			$data = serialize($data);
		} else {
			$data = "";
		}

		update_option( "dtq_text", $data );
	}
}

if ( !function_exists( "dtq_callback_function_1" ) )
{
	function dtq_callback_function_1( $name )
	{
		$name = str_split( $name,1 );
		$name = (int) count($name);
		return $name;
	}
}

//$data = [1,2,3,4,5,6,7,8,9,0];
//foreach ($data as $datum)
//{
//	dtq_insert_dynamic_text($datum, "What is your name?");
//}