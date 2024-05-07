<?php 
	/**
	 * summary
	 */
	class Conn
	{
	    /**
	     * summary
	     */

	    private $user = "sipalinguser";
	    private $pass = "LiterliPenggunaBias4!";

	    private $dsn = "mysql:host=localhost;dbname=2023_point_of_sales";

	    protected $db;


	    public function __construct()
	    {	
	    	date_default_timezone_set("Asia/Jakarta");
	    	
	        $this->db = new PDO($this->dsn, $this->user, $this->pass);
	        return $this->db;
	    }
	}

?>
