<?php
namespace Spiral\Framework\DI\Definition\Builder;
use \Spiral\Framework\DI\Definition\Builder\File;
use \Spiral\Framework\DI\Definition\Builder\Exception\PathUnavailableException;

/**
 * Build a Schema from files
 *
 * This component make it possible to set the file name has a source of building.
 *
 * @author  	Frédéric Sureau		10 jun. 2009
 * @author 		Alexis Métaireau	09 jul. 2009	
 * @copyright	Frédéric Sureau, Alexis Métaireau	 	2009 
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class FilesBuilder extends AbstractBuilder
{
	private $_schemaBuilder;
	private $_fileNames = array();
	
	/**
	 * Build the FilesSchemaBuilder
	 *
	 * @param	\Spiral\Framework\DI\Definition\Builder\File	$file
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
	 * @return \Spiral\Framework\DI\Definition\Schema
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
