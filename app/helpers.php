<?php

function random_readable_string(int $length = 10)
{
	$c = 'ACEFHJKLMNPRTUVWXY';
	$s = '';
	$length = abs($length);

	while ($length--)
		$s .= substr($c, rand(0, strlen($c) - 1), 1);

	return $s;
}

function array_to_hidden_inputs(array $input, string $html = null, string $parent_key = '')
{
	$html = $html ?? '';

	foreach ($input as $key => $value) {
		if (is_array($value)) {
			$html .= array_to_hidden_inputs($value, $html, $parent_key === '' ? $key : $parent_key . '[' . $key . ']');
		} else {
			$html .= '<input type="hidden" name="' . e($parent_key ? $parent_key . '[' . $key . ']' : $key) . '" value="' . e($value) . '">';
		}
	}

	return $html;
}

function escape_like(string $value)
{
	return str_replace(['%', '_'], ['\%', '\_'], $value);
}

function json_vue($value)
{
	return json_encode($value, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}