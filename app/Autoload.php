<?php
namespace app;

/**
* Autoloader
*
*/


class Autoload{
	/**
	* save namespaces
	*/
	private $namespaces = [];
	/**
	* save files
	*/
	private $files = [];
	
	
	/**
	* register class
	*
	*/
	public function register(){
		spl_autoload_register(array($this,'setAutoload'));
	}
	
	/**
	* add namespaces and Path 
	* param array namesAndFiles with 2 index namespaces and files
	* param string requireFile
	*/
	public function setNamespaceFile(array $namesAndFiles, $dir='' ){
		if(empty($namesAndFiles)) return;
		
		foreach( $namesAndFiles as $key=>$unit ){
			switch($key){
				case 'namespaces' : $this->setNamespaces( $unit, $dir ); break;
				case 'files' : $this->setFiles( $unit, $dir ); break;
				default : throw new \Exception('Wrong array setNamespaceFile');
			}
		}
	}
	
	/**
	* test output namespaces and Path 
	*/
	public function getNamespaceFile(){
		print_r($this->namespaces);
		print_r($this->files);
	}
	
	/**
	* add Path of Namespace
	* param string Namespace
	* param string directory
	*/
	public function addNamespace($namespace, $dir ){
		$namespace = trim($namespace,'\\').'\\';
		$dir = rtrim($dir, DIRECTORY_SEPARATOR) . '/';
		
		if( !isset($this->namespaces[$namespace]) ) {
			$this->namespaces[$namespace] = [];
         }
		$this->namespaces[$namespace][] = $dir;
	}
	
	/**
	* add Path of Namespaces (array)
	* param array Namespace
	* param string directory
	*/
	public function setNamespaces( array $namespaces, $dir='' ){
		if(empty($namespaces)) return;
		
		foreach( $namespaces as $key => $unit ){
			if( is_numeric($key) && is_array($unit) ){
				$namespace = current($unit);
				$newdir = rtrim($dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.trim($unit[$namespace],DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
				$this->addNamespace($namespace,$newdir);
			}
			else if( !is_numeric($key) && !is_array($unit) ){
				$namespace = $key;
				$newdir = rtrim($dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.trim($unit,DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
				$this->addNamespace($namespace,$newdir);
			}
			else{
				throw new \Exception('Wrong array setNamespaces');
			}
		}
	}
	
	/**
	* add Path to classfile
	* param string filename
	* param string requireFile
	*/
	public function addFile($filename, $requireFile ){
		$this->files[$filename] = $requireFile;
	}
	
	/**
	* add Path to classfiles (array)
	* param array filename
	* param string requireFile
	*/
	public function setFiles(array $files, $dir='' ){
		if(empty($files)) return;
		
		foreach( $files as $key=>$unit ){
			if( is_numeric($key) && is_array($unit) ){
				$file = current($unit);
				$newdir = rtrim($dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$unit[$file];
				$this->addFile($file,$newdir);
			}
			else if( !is_numeric($key) && !is_array($unit) ){
				$newdir = rtrim($dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$unit;
				$this->addFile($key,$newdir);
			}
			else{
				throw new \Exception('Wrong array setFiles');
			}
		}
	}
	
	
	
	/**
	* require class file
	* param string $className
	*/
	private function setAutoload($className){
		
		if( isset($this->files[$className]) ) {
			if( !$this->requireFile($this->files[$className]) ){
				throw new \Exception('Classfile dos not exists');
			}
			return true;
		}
		else{
			$hlpNamespace = $className;
			while (false !== $pos = strrpos($hlpNamespace, '\\')) {
				$hlpNamespace = substr($className, 0, $pos + 1);
				$relative_class = substr($className, $pos + 1);
				$mapped_file = $this->loadMappedFiles($hlpNamespace, $relative_class);
				if ($mapped_file) { return $mapped_file; }
				$hlpNamespace = rtrim($hlpNamespace, '\\');
			}
		}
		throw new \Exception('Autoload no class found: '.$className);
	}
	
	/**
     * Load the mapped file for a namespace prefix and relative class.
     *
     * @param string $prefix The namespace prefix.
     * @param string $relative_class The relative class name.
     */
    private function loadMappedFiles($prefix, $relative_class){
        // are there any base directories for this namespace prefix?
        if (isset($this->namespaces[$prefix]) === false) { return false; }

        // look through base directories for this namespace prefix
        foreach ($this->namespaces[$prefix] as $base_dir) {
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
            if($this->requireFile($file)) { return $file; }
        }
        return false;
    }
	
	/**
     * If a file exists, require it from the file system.
     *
     * @param string $file The file to require.
     * @return bool True if the file exists, false if not.
     */
    private function requireFile($file) {
        if(file_exists($file)) { 
			require_once($file);
			return true;
        }
        	return false;
    }
}