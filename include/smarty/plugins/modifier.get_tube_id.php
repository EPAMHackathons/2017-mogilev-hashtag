<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty strip_tags modifier plugin
 *
 * Type:     modifier<br>
 * Name:     strip_tags<br>
 * Purpose:  strip html tags from text
 * @link http://smarty.php.net/manual/en/language.modifier.strip.tags.php
 *          strip_tags (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param boolean
 * @return string
 */
function smarty_modifier_get_tube_id($s)
{
		if (preg_match('@/embed/(.*?)\?@', $s, $m)) return $m[1];
		$a = parse_url($s);
		$q = $a['query'];
		return (preg_match('@v=([\w-]*)@', $q, $m)) ? $m[1] : '';
}

/* vim: set expandtab: */

?>
