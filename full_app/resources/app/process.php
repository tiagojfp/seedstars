<?php 
/**
 * This Challenge was developed by Tiago Pais for SeedStars
 * @email: tiagojfpais@gmail.com
 * @linkedin: https://pt.linkedin.com/in/tiago-pais-2676234b
 */

//Setting up Environment
	session_start(); //Start session to use the session vars
	include(dirname(__DIR__).'/config/db_connect.php');

/**
 * Processing the Request
 */
	//Getting the method
	$request_method = $_SERVER['REQUEST_METHOD'];

	//Filter the Request Method
	switch ($request_method) {
	  case 'POST':
	  	//Process New Entry
	    addNewEntry();
	    break;
	  default:
	    break;
	}

	//Setting session vars for Messages
	$_SESSION['success'] = "";  //success messages
	$_SESSION['errors'] = "";   //error messages

/**
 * Functions
 */
	//Validate Requests
	function validateRequest(){
		/** Check Token */
		if ( isset($_POST['_token']) ) {
			//Getting the session token
			$session_token = $_SESSION['csrf_token'];
			//Remove Session token and close session write
			unset($_SESSION['csrf_token']);
			//Checking if both tokens are equal
			if( $_POST['_token'] != $session_token ) {
				$_SESSION['errors'] .= "- Security token doesn't match!<br/>";
			}
			/** 
			 * XSS Cleaner For Name and Email Fields
			 */
			//sanitize vars
			$name = strip_tags($_POST['name']);
			$email = strip_tags($_POST['email']);
			//checking if post vars are empty or invalid
			$name = trim($name);
			$email = trim($email);
			//check empty or if name is smaller than 2 chars
			if( empty($name) || strlen($name) < 3 || empty($email) ){
				$_SESSION['errors'] .= "- The fields are empty or invalid!<br/>";
			}
		}else{
			$_SESSION['errors'] .= "- Security token doesn't exists!<br/>";
			//Close Session Write
			session_write_close();
			//redirect
			header("Location: ../../add"); die();
		}
		//If any errors ocurred
		if( !empty($_SESSION['errors']) ){
			//Close Session Write
			session_write_close();
			//redirect
			header("Location: ../../add"); die();
		}else{
			return true;
		}
	}
	//Add New Entry
	function addNewEntry(){
		if( $valid_request = validateRequest() ){
			//prepare Post vars
			/** 
			 * XSS Cleaner For Name and Email Fields
			 */
			//sanitize vars
			$name = strip_tags($_POST['name']);
			$email = strip_tags($_POST['email']);
			//checking if post vars are empty or invalid
			$name = trim($name);
			$email = trim($email);
			//prepare insert SQL Script
			$insert_sql = "INSERT INTO TBL_ITEMS (NAME,EMAIL) VALUES ('".$name."','".$email."')";
			//insert into database
			$resp = insertData($insert_sql);
			//check anwser and redirect
			if( !$resp ) { 
				$_SESSION['errors'] .= "- Fail to insert into database!<br/>";
			}
			else {
				$_SESSION['success'] .= "- The data was inserted successfully!<br/>";
			}
			//Close Session Write
			session_write_close();
			//redirect
			header("Location: ../../add"); die();
		}else {
			$_SESSION['errors'] .= "- The request was not accepted!<br/>";
			//Close Session Write
			session_write_close();
			//redirect
			header("Location: ../../add"); die();
		}
	}
	//Select All Items from DB
	function getAllItems(){
		//sql query
		$select_sql = "SELECT * FROM TBL_ITEMS";
		//Getting the results for the sql query
		$results = selectData($select_sql);
		return $results;
		//return
		if( !$results ) { return false; }
		else return $results;
	}
	// var_dump(getAllItems() );
//Close Session and clean vars
	unset($_SESSION['success']);
	unset($_SESSION['errors']);
	session_write_close();
?>