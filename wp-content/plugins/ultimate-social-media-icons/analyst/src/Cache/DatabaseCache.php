<?php

namespace Analyst\Cache;

use Analyst\Contracts\CacheContract;

/**
 * Class DatabaseCache
 *
 * @since 1.1.5
 */
class DatabaseCache implements CacheContract
{
	const OPTION_KEY = 'analyst_cache';

	protected static $instance;

	/**
	 * Get instance of db cache
	 *
	 * @return DatabaseCache
	 */
	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new DatabaseCache();
		}

		return self::$instance;
	}

	/**
	 * DatabaseCache constructor.
	 */
	public function __construct()
	{
		$this->values = unserialize(get_option(self::OPTION_KEY, serialize([])));
	}

	/**
	 * Key value pair
	 *
	 * @var array[]
	 */
	protected $values;

	/**
	 * Save value with given key
	 *
	 * @param string $key
	 * @param string $value
	 *
	 * @return static
	 */
	public function put($key, $value)
	{
		$this->values[$key] = $value;

		$this->sync();

		return $this;
	}

	/**
	 * Get value by given key
	 *
	 * @param $key
	 *
	 * @param null $default
	 * @return string
	 */
	public function get($key, $default = null)
	{
		$value = isset($this->values[$key]) ? $this->values[$key] : $default;

		return $value;
	}

	/**
	 * @param $key
	 *
	 * @return static
	 */
	public function delete($key)
	{
		if (isset($this->values[$key])) {
			unset($this->values[$key]);

			$this->sync();
		}

		return $this;
	}

	/**
	 * Update cache in DB
	 */
	protected function sync()
	{
		update_option(self::OPTION_KEY, serialize($this->values));
	}

	/**
	 * Should get value and remove it from cache
	 *
	 * @param $key
	 * @param null $default
	 * @return mixed
	 */
	public function pop($key, $default = null)
	{
		$value = $this->get($key);

		$this->delete($key);

		return $value;
	}
}
