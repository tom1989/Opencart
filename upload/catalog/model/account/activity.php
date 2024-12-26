<?php
namespace Opencart\Catalog\Model\Account;
/**
 * Class Activity
 * 
 * @example $activity_model = $this->model_account_activity;
 *
 * Can be called from $this->load->model('account/activity');
 *
 * @package Opencart\Catalog\Model\Account
 */
class Activity extends \Opencart\System\Engine\Model {
	/**
	 * Add Activity
	 *
	 * @param string               $key
	 * @param array<string, mixed> $data array of data
	 *
	 * @return void
	 */
	public function addActivity(string $key, array $data): void {
		if (isset($data['customer_id'])) {
			$customer_id = $data['customer_id'];
		} else {
			$customer_id = 0;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_activity` SET `customer_id` = '" . (int)$customer_id . "', `key` = '" . $this->db->escape($key) . "', `data` = '" . $this->db->escape(json_encode($data)) . "', `ip` = '" . $this->db->escape(oc_get_ip()) . "', `date_added` = NOW()");
	}

	/**
	 * Delete Activities
	 *
	 * @param int $customer_id primary key of the customer record
	 *
	 * @return void
	 */
	public function deleteActivities(int $customer_id): void {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_activity` WHERE `customer_id` = '" . (int)$customer_id . "'");
	}
}
