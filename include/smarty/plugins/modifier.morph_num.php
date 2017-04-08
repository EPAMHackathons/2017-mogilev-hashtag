<?php
/*
	{1|morph_num:'балл,балла,баллов'}
 */
function smarty_modifier_morph_num($var, $values)
{
	list($f1, $f2, $f3) = explode(',', $values);

	return $var . ' '. morph($var, $f1, $f2, $f3);
}


?>
