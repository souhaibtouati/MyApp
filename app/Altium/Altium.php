<?php

namespace App\Altium;


use App\Altium\Models\EloquentPart;
use Illuminate\Support\Facades\Input;
use App\Altium\PartRepositoryinterface;
use Sentinel;
use Webcreate\Vcs\Svn;
use File;
use View;
use Webcreate\Vcs\Common\Reference;

/**
* 
*/
class Altium 
{

	protected $parts;
	
	// public function __construct() 
	// {

 //    }

	public function CreateClass($type, $table)
	{
        $class = '\App\Altium\Models\\'.$type ;
        $part = new $class();
        $part->setTable($table);

        return $part;
	}

	public function getPartRepository($type, $table)
	{
		$part = $this->CreateClass($type, $table);
		return new PartRepository($part);
	}

	public function InitSVN()
	{
		$Repo = new svn(Sentinel::getUser()->svnPath);
        $Repo->setCredentials(Sentinel::getUser()->svnUsername, Sentinel::getUser()->svnPassword);
        $Repo->getAdapter()->setExecutable('/usr/bin/svn');
        
        
        return $Repo;
	}

	public function ImportToSVN($PartType, $fileType)
    {
    	$attribute = [];
    	switch ($fileType) {
    		case 'SYM':
    			$strings = ['input'=>'symbol', 'extension' =>'Schlib'];
    			break;
    		
    		case 'FTPT':
    			$strings = ['input'=>'footprint', 'extension' =>'PCBLib'];
    			break;
    	}
        $tmpFile = Input::file($strings['input']);
        if($tmpFile === null || $tmpFile === ''){
            throw new \Exception('Please choose a '.$strings['extension'].' File');
        }
        $fileFullname = $tmpFile->getClientOriginalName();
        $fileName = pathinfo($fileFullname, PATHINFO_FILENAME);
        $fileExt = pathinfo($fileFullname, PATHINFO_EXTENSION);
        if (strcasecmp($fileExt, $strings['extension']) <> 0) {
        	throw new \Exception('Please check the '. $strings['input'] . ' Library file-type');
        }

        File::cleanDirectory(storage_path('tmp'));
        $tmpFile->move(storage_path('tmp'),$fileFullname);
        $importPath = $fileType .'/'.$PartType.'/'.$fileFullname;

        $repo = Altium::InitSVN();
        $repo->import(storage_path('tmp/').$fileFullname , $importPath , $strings['input'].' imported');
        $attribute['name'] = $fileName;
        $attribute['path'] = $repo->getSvnUrl($importPath);
        
        return $attribute;
    }


    public function SVNrmFile($fileURL)
    {

    	$repo = Altium::InitSVN();
        $result = $repo->execute('rm', array($fileURL, '-m'=>'Removed '.pathinfo($fileURL, PATHINFO_FILENAME)));
    	
    	return $result;
    }

   public function populateRefs($type, $table, $ref)
   {
   		$parts = $this::getPartRepository($type, $table)->getRefs($ref);
        foreach ($parts as $key => $part) {
            $Refs[$key] = $part->$ref; 
        }
        return $Refs;
   }

    public function UploadDatasheet($request, $type)
    {
       if($request->hasFile('ComponentLink1URL'))
        {
            $datasheet = Input::file('ComponentLink1URL');
            $destination = public_path('/Altium/Datasheets/'. $type) ;
            $filename = $datasheet->getClientOriginalName();
            $datasheet->move($destination, $filename);
            $path = $request->root().'/Altium/Datasheets/' . $type .'/' . $filename;
            
            return $path;
        }
        return null;
    }


    public function showLoading()
    {
        return View::make('partials.wait');
    }

}