<?php
	function getSystemSetting($pdo, $parameter) {
		//********************************/
		// Used to fetch System Setting  */
		//	 using Parameter as key      */
		//********************************/
		$sql = " SELECT Value
					FROM system_settings
					WHERE Parameter = ? ";
		try {
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$parameter]);

			return $stmt->fetchColumn();
		}
		catch (PDOException $e) {
			return $e->getMessage();
		}
	}

	function getAllSystemSettings($pdo) {
		//*********************************/
		// Used to fetch System Settings  */
		//	 not one BUT ALL              */
		//*********************************/
		$sql = " SELECT Parameter, Value
					FROM system_settings ";
		try {
			$ret = $pdo->query($sql);
			$arrRet= array();
			while ($row = $ret->fetch()) {
				$arrRet[$row['Parameter']] = $row['Value'];
			}

			return $arrRet;
		}
		catch (PDOException $e) {
			return $e->getMessage();
		}
	}
?>