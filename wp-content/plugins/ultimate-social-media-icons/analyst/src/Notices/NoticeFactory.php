<?php

namespace Analyst\Notices;

class NoticeFactory
{
	private static $instance;

	CONST OPTIONS_KEY = 'analyst_notices';

	/**
	 * Application notifications
	 *
	 * @var array
	 */
	protected $notices = [];

	/**
	 * Read factory from options or make fresh instance
	 *
	 * @return NoticeFactory
	 */
	public static function instance()
	{
		if (!static::$instance) {
			$raw = get_option(self::OPTIONS_KEY);

			// In case this object is not serialized
			// we instantiate new object
			if (!$raw) {
				static::$instance = new self();
			} else {
				static::$instance = unserialize($raw);
			}
		}

		return static::$instance;
	}

	/**
	 * Sync this object data with cache
	 */
	public function sync()
	{
		update_option(self::OPTIONS_KEY, serialize($this));
	}

	/**
	 * Sync this instance data with cache
	 */
	public static function syncData()
	{
		static::instance()->sync();
	}

	/**
	 * @return array
	 */
	public function getNotices()
	{
		return $this->notices;
	}

	/**
	 * Filter out notices for certain account
	 *
	 * @param $accountId
	 * @return array
	 */
	public function getNoticesForAccount($accountId)
	{
		return array_filter($this->notices, function (Notice $notice) use ($accountId) {
			return $notice->getAccountId() === $accountId;
		});
	}

	/**
	 * Add new notice
	 *
	 * @param $notice
	 *
	 * @return $this
	 */
	public function addNotice($notice)
	{
		array_push($this->notices, $notice);

		$this->sync();

		return $this;
	}

	/**
	 * Find notice by id
	 *
	 * @param $id
	 * @return Notice|null
	 */
	public function find($id)
	{
		$notices = array_filter($this->notices, function (Notice $notice) use ($id) {
			return $notice->getId() === $id;
		});

		return array_pop($notices);
	}

	/**
	 * Remove notice by it's id
	 *
	 * @param $id
	 */
	public function remove($id)
	{
		// Get key of notice to remove
		$key = array_search(
			$this->find($id),
			$this->notices
		);

		// Unset notice with key
		unset($this->notices[$key]);

		$this->sync();
	}
}
