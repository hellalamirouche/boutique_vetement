<?php

if (! function_exists('analyst_assets_path')) {
	/**
	 * Generates path to file in assets folder
	 *
	 * @param $file
	 * @return string
	 */
	function analyst_assets_path($file)
	{
		$path = sprintf('%s/assets/%s', realpath(__DIR__ . '/..'), trim($file, '/'));

		return wp_normalize_path($path);
	}
}


if (! function_exists('analyst_assets_url')) {
	/**
	 * Generates url to file in assets folder
	 *
	 * @param $file
	 * @return string
	 */
	function analyst_assets_url($file)
	{
		$absolutePath = analyst_assets_path($file);

		$contentDir = wp_normalize_path(WP_CONTENT_DIR);

		$relativePath = str_replace( $contentDir, '', $absolutePath);

		return content_url(wp_normalize_path($relativePath));
	}
}

	if (! function_exists('analyst_templates_path')) {
		/**
		 * Generates path to file in templates folder
		 *
		 * @param $file
		 * @return string
		 */
		function analyst_templates_path($file)
		{
			$path = sprintf('%s/templates/%s', realpath(__DIR__ . '/..'), trim($file, '/'));

			return wp_normalize_path($path);
		}
	}

if (! function_exists('analyst_require_template')) {
	/**
	 * Require certain template with data
	 *
	 * @param $file
	 * @param array $data
	 */
	function analyst_require_template($file, $data = [])
	{
		// Extract data to current scope table
		extract($data);

		require analyst_templates_path($file);
	}
}

if (! function_exists('dd')) {
	/**
	 * Dump some data
	 *
	 * @param array $params
	 */
	function dd ($params)
	{
		die(var_dump($params));
	}
}
