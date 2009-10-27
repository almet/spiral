<?php

namespace spiral\framework\di\definition\builder;

use \spiral\framework\di\definition\Schema;
use \spiral\framework\di\definition\builder\exception\PathUnavailableException;

/**
 * Build a Schema from files
 *
 * This component make it possible to set the file name has a source of building.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class FilesBuilder extends AbstractBuilder
{
	// TODO Comment
	private $_schemaBuilder;
	private $_fileNames = array();
	
	/**
	 * Build the FilesSchemaBuilder
	 *
	 * @param	File	$file
	 * @return	void
	 */
	public function __construct(File $schemaBuilder)
	{
		$this->_schemaBuilder = $schemaBuilder;
	}
	
	/**
	 * Set the names of files to load
	 *
	 * @return	void
	 */
	public function setFileNames()
	{
		$this->_fileNames = func_get_args();
	}
	
	/**
	 * Load all files in a directory
	 *
	 * @param	string	$dirname
	 * @param	bool	$recursive
	 * @return	void
	 */
	public function loadDir($dirName, $recursive = true)
	{
		$path = $dirName.'/';
		if (!file_exists($dirName))
		{
			throw new PathUnavailableException($dirName);
		}
		$d = dir($path);
		
		while($entry = $d->read())
		{
			if(is_file($path.$entry))
			{
				$this->_fileNames[] = $path.$entry;
			}
			
			// FIXME Do not parse hidden directories 
			if($recursive === true && is_dir($path.$entry) && $entry != '.' && $entry != '..' && $entry != '.svn')
			{
				$this->loadDir($dirName.'/'.$entry);
			}
		}
		$d->close();
	}
	
	/**
	 * Build the Schema and return it
	 * 
	 * @return Schema
	 */
	public function buildSchema()
	{
		$schema = $this->_schemaBuilder->getOriginalSchema();
		
		foreach($this->_fileNames as $fileName)
		{
			$this->_schemaBuilder->setFileName($fileName);
			$this->_schemaBuilder->setOriginalSchema($schema);
			$schema = $this->_schemaBuilder->buildSchema();
		}
		
		return $schema;
	}
}
