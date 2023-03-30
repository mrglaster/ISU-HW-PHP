<?php

/**Checks if all dcm files in the dir are valid, adds 
information about the status into the journal file and returns
data of a broken or cuted files. */
function dcmRestorationPrepare($journalFile){
  $MAGIC_SIZE = 528153;
  $data = "Action type; File name; Date\n";
  $parts = array();
  $fileContent = '';
  
  // Enumerate all files in the directory
  foreach(glob('dcms/*.dcm') as $file){
    $fileContent = file_get_contents($file);
	
	// If the file is fine
    if(!isBrokenFile($fileContent)){
      $date = date('d.m.Y H:i:s');
      $data .= 'Validation;'. basename($file). "; $date\n";
    }
	// If the file is broken 
    else if (filesize($file)< $MAGIC_SIZE){
      $date = date('d.m.Y H:i:s');
      $data .= 'Found part;'. basename($file). "; $date\n";
      $parts[]=$file;
    }
  }
  // Appends all recorded logs into the journal file
  file_put_contents($journalFile, $data, FILE_APPEND);
  
  // Returns an array of broken files's paths
  return $parts;
}

/**Checks if the file is broken compairing queue of bytes with the sample*/
function isBrokenFile($fileContent){
  $bites = substr($fileContent, 85, 4);
  $arr = unpack('C*', $bites);
  $true_arr = array(84, 95, 60 ,126);
  return !empty(array_diff($true_arr, $arr));
}

/**Restores some result by the particular data*/
function restoreDcm($journalFile, $parts){
  $queue = array(2, 4, 3, 1, 5, 0);
  $contents = "";
  $out = fopen("result.png", 'wb');
  // Enumerates all broken files parts by a queue and writes the result into the new file
  foreach($queue as $q){
    $filesize = filesize($parts[$q]);
    $f = fopen($parts[$q], 'rb');
    $contents .= fread($f, $filesize);
    fclose($f);
    $date = date('d.m.Y H:i:s');
    file_put_contents($journalFile, 'Deleted;'. basename($parts[$q]). "; $date\n", FILE_APPEND);
  }  
  fwrite($out, $contents);
  fclose($out);
}
/**The main function, runs all the code here*/
function main(){
	$filename = 'journal.csv';
	$parts = dcmRestorationPrepare($filename);
	restoreDcm($filename, $parts);
}

/**The invocation of the main function*/
main();
?>
