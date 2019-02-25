<!DOCTYPE html>
<html>
<head>
<style>
.oculto{
    display: none;
}
.btn{
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
}
.btn:hover{
    background-color: #B4B4B4;
    
}
p{
    margin-top: 0px;
    
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script>
$(document).ready(function(){
    
    $("button").click(function(){
    
        var value = CKEDITOR.instances['editor1'].getData();       	
        
        $("#datos").append(value);
        var dato = $('#datos').find('a'); 
        for(var i=0; i<dato.length; i++){
            var url = dato[i].getAttribute("href"); 
            var n = dato[i].innerHTML;            
            
            $.post("validador.php",
                {url: url, n:n},
                function(validador){
                   $("#mostrar").append(validador);
            });
            
        }
        
    });
});
</script>
</head>
<body>




  <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>
  <div id="datos" class="oculto"></div>
  <br />  
  <button class="btn">Just do it</button> 
  <br />
  <br />
  
  <div id="mostrar"></div>
 
  
  
  
  <script>
    CKEDITOR.replace('editor1', {      
    });
  </script>


</body>
</html>