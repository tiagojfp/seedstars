<?php
/**
 * This Challenge was developed by Tiago Pais for SeedStars
 * @email: tiagojfpais@gmail.com
 * @linkedin: https://pt.linkedin.com/in/tiago-pais-2676234b
 */

/** Create / Open DB */
class ChallengeDB extends SQLite3{
	//constructor
	function __construct()
	{
		$this->open(dirname(__DIR__).'/storage/storage.db'); //if the file doen't exists, it will be created
	}
}
//Create Table for Store the new entries
function createTable($sqlScript){
	//open the db
	$db = new ChallengeDB();
	if( !$db ){
		//if the connection fails return error
		$temp['errors'] = "- Database not available!<br/>";
	} 
	else {
		//execute and test it
		$ret = $db->exec($sqlScript);
		if(!$ret){
			//if the connection fails return error
			$temp['errors'] = "- Database table not available!<br/>";
		}
	}
	//Close DB Connection
	$db->close();
	//if has errors - return false! Otherwise return true
	if( !empty($temp['errors']) ) { return false; }
	else { return true; }

}
//Create base table (If not exists)
createTable( "CREATE TABLE IF NOT EXISTS TBL_ITEMS (ID INTEGER PRIMARY KEY AUTOINCREMENT, NAME CHAR(50) NOT NULL, EMAIL CHAR(50) NOT NULL)" );
//Insert Data
function insertData($sqlScript){
	//open the db
	$db = new ChallengeDB();
	if( !$db ){
		//if the connection fails return error
		$temp['errors'] = "- Database not available!<br/>";
	} 
	else {
		//execute and test it
		$ret = $db->exec($sqlScript);
		if(!$ret){
			//if the connection fails return error
			$temp['errors'] = "- Failed to insert the entry into database!<br/>";
		}
	}
	//Close DB Connection
	$db->close();
	//if has errors - return false! Otherwise return true
	if( !empty($temp['errors']) ) { return false; }
	else { return true; }
}
//Select Data
function selectData($sqlScript){
	//open the db
	$db = new ChallengeDB();
	if( !$db ){
		//if the connection fails return error
		$temp['errors'] = "- Database not available!<br/>";
	} 
	else {
		//rows array
		$rows = [];
		//execute and test it
		$ret = $db->query($sqlScript);
		if(!$ret){
			//if the connection fails return error
			$temp['errors'] = "- Failed to get the result from database!<br/>";
		// }else return $row = $ret->fetchArray(SQLITE3_ASSOC);
		}else { while($row = $ret->fetchArray(SQLITE3_ASSOC) ){ $rows[] = $row; } }
	}
	//Close DB Connection
	$db->close();
	//if has errors - return false! Otherwise return true
	if( !empty($temp['errors']) ) { return false; }
	else { return $rows; }
}
// var_dump(selectData('SELECT * FROM TBL_ITEMS'));die();
?>