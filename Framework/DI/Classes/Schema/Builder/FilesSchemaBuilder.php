<?php
/**
 * Schema builder from a file name
 *
 * This component make it possible to set the file name has a source of building.
 *
 * @package     SpiralDi
 * @subpackage  SchemaBuilder  
 * @author  	Frédéric Sureau		10 jun. 2009
 * @author 		Alexis Métaireau	09 jul. 2009	
 * @copyright	Frédéric Sureau, Alexis Métaireau	 	2009 
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class SpiralDi_SchemaBuilder_Files extends SpiralDi_SchemaBuilder_Abstract
{
	private $_schemaBuilder;
	private $_fileNames = array();
	
	public function __construct(SpiralDi_SchemaBuilder_File $schemaBuilder)
	{
		$this->_schemaBuilder = $schemaBuilder;
	}
	
	public function setFileNames()
	{
		$this->_fileNames = func_get_args();
	}
	
	public function loadDir($dirName, $recursive = true)
	{
		$path = /*SITE_PATH.*/$dirName.'/';
		if (!file_exists($dirName)){
			throw new SpiralDi_SchemaBuilder_Exception_PathUnavailable($dirName);
		}
		$d = dir($path);
		
		while($entry = $d->read())
		{
			if(is_file($path.$entry))
			{
				$this->_fileNames[] = $path.$entry;
			}
			
			if($recursive && is_dir($path.$entry) && $entry != '.' && $entry != '..' && $entry != '.svn')
			{
				$this->loadDir($dirName.'/'.$entry);
			}
		}
		$d->close();
	}
	
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
