<?php 

class DBManager {

	public $client;
	public $selected;
	
	public function __construct() {
		$lines = file("Config.properties"); 
		foreach ($lines as $line) {
			list($k, $v) = explode('=', $line);
			if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.username"))) {
				$user = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.port"))) {
				$port = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.password"))) {
				$password = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.ip"))) {
				$ip = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.name"))) {
				$dbName = rtrim(ltrim($v));
			}
		}
			$this->client = pg_connect("host=ec2-34-206-148-196.compute-1.amazonaws.com port=5432 dbname=d9cr5h5ieniqqb user=juvomfaqzzjnjw password=4406af6a3ed6c65a7b4f95b0528d9bc7995a5e7d39f0d6274ddaafd801816156") 
			or die('Could not connect: ' . pg_last_error());
			
    }

	
	function saveDoc($name, $email, $description) {
		
		try{
			pg_query("CREATE TABLE app42_user(name VARCHAR(255), email VARCHAR(355), description TEXT)");
		}catch(Exception $e){
			print_r("Table Already Created");
		}		
		
		$query = "insert into app42_user(name,email,description) values('$name','$email','$description')";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		pg_close($this->client);
    }
	
	function getAllDocs() {
		
		$query = "select * from app42_user";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		return $result;
		
    }

}

?>