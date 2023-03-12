<?php 
    function conection()
    {
        //localhost o 127.0.0.1
        $server = "localhost";
        $user = "root";
        $passw = "";
        $bd = "bddocumental";
        
    	$linkConexion = mysqli_connect($server, $user, $passw, $bd);
    
        if (!$linkConexion) 
    	{
    		echo 'No pudo conectarse: ' .mysqli_connect_error();
    		//echo '<script>window.location="index.html"</script>';
    	}
        return $linkConexion;
    }
	
?>