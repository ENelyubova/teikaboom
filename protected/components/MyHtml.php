<?php

/**
 * 
 */
class MyHtml extends CHtml
{
	public static function script($text,array $htmlOptions=array())
	{
		$defaultHtmlOptions=array(
		);
		$htmlOptions=array_merge($defaultHtmlOptions,$htmlOptions);
		return self::tag('script',$htmlOptions,"\n/*<![CDATA[*/\n{$text}\n/*]]>*/\n");
	}

	/**
	 * Includes a JavaScript file.
	 * @param string $url URL for the JavaScript file
	 * @param array $htmlOptions additional HTML attributes (see {@link tag})
	 * @return string the JavaScript file tag
	 */
	public static function scriptFile($url,array $htmlOptions=array())
	{
		$defaultHtmlOptions=array(
			'src'=>$url
		);
		$htmlOptions=array_merge($defaultHtmlOptions,$htmlOptions);
		return self::tag('script',$htmlOptions,'');
	}
}