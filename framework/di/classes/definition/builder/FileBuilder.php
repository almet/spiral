<?php

namespace spiral\framework\di\definition\builder;

/**
 * Schema builder from a file name
 * 
 * This component make it possible to set the file name has a source of building.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class FileBuilder extends AbstractBuilder
{
    /**
     * Set the file name to build
     *
     * @param   string  $fileName
     * @return	void
     */
	abstract public function setFileName($fileName);
}
