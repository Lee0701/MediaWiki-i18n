<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

/**
 * Korean (韓國語)
 *
 * @ingroup Languages
 */
class LanguageKo_kore extends LanguageKo {

	static $hangul = '(?:\xea[\xb0-\xbf][\x80-\xbf]'
		. '|[\xeb-\xec][\x80-\xbf]{2}'
		. '|\xed[\x80-\x9d][\x80-\xbf]'
		. '|\xed\x9e[\x80-\xa3])';
	static $hanja = '(?:\xe3[\x88-\xbf][\x80-\xbf]'
		. '|[\xe4-\xe8][\x80-\xbf]{2}'
		. '|\xe9[\x80-\xa5][\x80-\xbf]'
		. '|\xe9\xa6[\x80-\x99])';

	/**
	 * @return bool
	 */
	public function hasWordBreaks() {
		return true;
	}

	/**
	 * this should give much better diff info
	 *
	 * @param string $text
	 * @return string
	 */
	public function segmentForDiff( $text ) {
		$hangul = self::$hangul;
		$hanja = self::$hanja;
		$reg = "/($hangul|$hanja)/";
		return preg_replace( $reg, ' $0', $text );
	}

	/**
	 * @param string $text
	 * @return string
	 */
	public function unsegmentForDiff( $text ) {
		$hangul = self::$hangul;
		$hanja = self::$hanja;
		$reg = "/ ($hangul|$hanja)/";
		return preg_replace( $reg, '$1', $text );
	}

	/**
	 * @param string $string
	 * @return string
	 */
	public function segmentByWord( $string ) {
		$hangul = self::$hangul;
		$hanja = self::$hanja;
		$reg = "/({$hangul}+|{$hanja}+)/";
		$s = self::insertSpace( $string, $reg );
		return $s;
	}

}
