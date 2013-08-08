<?php

/**
 * ownCloud - Music app
 *
 * @author Morris Jobke
 * @copyright 2013 Morris Jobke <morris.jobke@gmail.com>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Music\Utility;

use \OCA\AppFramework\Core\API;

/**
 * an extractor class for getID3
 */
class ExtractorGetID3 implements Extractor {

	private $api;
	private $getID3;

	public function __construct(API $api, \getID3 $getID3){
		$this->api = $api;
		$this->getID3 = $getID3;
	}

	/**
	 * get metadata info for a media file
	 *
	 * @param $path the path to the file
	 * @return array extracted data
	 */
	public function extract($path) {
		$metadata = $this->getID3->analyze($path);

		// TODO make non static
		\getid3_lib::CopyTagsToComments($metadata);

		return $metadata;
	}
}