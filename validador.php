<?php


$url = $_POST['url'];
$nombre = $_POST['n'];





    $resultado = url_exists2($url);
    if($resultado == "No existe"){
        $clase = 'class = "nanai"';
    }
    echo "<span $clase>".$resultado."</span>";
    echo "<p>Nombre: ".$nombre."<br/>";    
    echo "Direccion: ".$url."</p>";
    echo '<a href="'.$url.'" target = "_blank">Ver enlace</a>';
    echo '<br>';    
    echo '<p>******************************************************************************</p>';
    


/*
$resultado = url_exists2($url);
echo $resultado; 
*/


/**********************************************************************/

function validador_url($url){
   
    
    // llamar a la API de Google PageSpeed ??Insights 
    $googlePagespeedData  =  file_get_contents( "https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$url");
        
    // descifrar los datos de json 
    $googlePagespeedData  =  json_decode($googlePagespeedData,true);
        
        
    // datos de captura de pantalla $ screenshot  =  $ googlePagespeedData [ 'screenshot' ] [ 'data' ];
        
    if($googlePagespeedData['responseCode']!=200){
        
        $data_img = "No existe";
    }else{ 
        
        $data_img = "Existe";
        
    }
    return $data_img;
}




/**********************************************************************/

function url_exists( $url = NULL ) {
$validador ="Sin validar";
    if( empty( $url ) ){
        $validador = "No existe";
        return $validador;
    }

    
    stream_context_set_default(
        array(
            'http' => array(
                'method' => 'HEAD'
             )
        )
    );
    $headers = @get_headers( $url );
    sscanf( $headers[0], 'HTTP/%*d.%*d %d', $httpcode );

    // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
    $accepted_response = array( 200, 301, 302 );
    if( in_array( $httpcode, $accepted_response ) ) {
        $validador = "Existe";
        return $validador;
    } else {
        $validador = "No existe";
        return $validador;
    }
}

/**********************************************************************/

function url_exists2( $url = NULL ) {
 $validador ="Sin validar";
    if( empty( $url ) ){
        return false;
    }
 
    $options['http'] = array(
        'method' => "HEAD",
        'ignore_errors' => 1,
        'max_redirects' => 0
    );
    $body = @file_get_contents( $url, NULL, stream_context_create( $options ) );
    
    // Ver http://php.net/manual/es/reserved.variables.httpresponseheader.php
    if( isset( $http_response_header ) ) {
        sscanf( $http_response_header[0], 'HTTP/%*d.%*d %d', $httpcode );
 
        // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array( 200, 301, 302 );
        if( in_array( $httpcode, $accepted_response ) ) {
            $validador = "Existe";
        return $validador;
        } else {
            $validador = "No existe";
        return $validador;
        }
     } else {
         $validador = "No existe";
        return $validador;
     }
}

?>