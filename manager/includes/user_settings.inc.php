<?php
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODX Content Manager instead of accessing this file directly.");

// START HACK
if (isset ($modx)) {
	$user_id = $modx->getLoginUserID();
} else {
	$user_id = $_SESSION['mgrInternalKey'];
}
// END HACK

if (!empty($user_id)) {
	// Raymond: grab the user settings from the database.
	$rs = $modx->db->select('setting_name, setting_value', $modx->getFullTableName('user_settings'), "user=".$modx->getLoginUserID());
	$number_of_settings = $modx->db->getRecordCount($rs);
	
	while ($row = $modx->db->getRow($rs)) {
		$settings[$row['setting_name']] = $row['setting_value'];
		if (isset($modx->config)) {
			$modx->config[$row['setting_name']] = $row['setting_value'];
		}
	}
	
	extract($settings, EXTR_OVERWRITE);
}
?>