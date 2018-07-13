<?php

/* Copyright (c) 1998-2017 ILIAS open source, Extended GPL, see docs/LICENSE */


/**
 * Class ilContainerAccess
 *
 *
 * @author Alex Killing <alex.killing@gmx.de>
 *
 * @ingroup ServicesContainer
 */
class ilContainerAccess
{
	/**
	 * @param ilWACPath $ilWACPath
	 *
	 * @return bool
	 */
	public function canBeDelivered(ilWACPath $ilWACPath) {
		global $ilAccess;

		preg_match("/\\/obj_([\\d]*)\\//uism", $ilWACPath->getPath(), $results);
		foreach (ilObject2::_getAllReferences($results[1]) as $ref_id) {
            // TZ: custom icons of courses are being blocked when access is checked on the "read" attribute
            // "read" was changed to "visible" -> https://ilias.de/mantis/view.php?id=23308
			if ($ilAccess->checkAccess('visible', '', $ref_id)) {
				return true;
			}
		}

		return false;
	}
}

?>