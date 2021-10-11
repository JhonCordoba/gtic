<html>
    <head>
        <title>SGT</title>
        
        <style>
            
            body{
                background-image: url("/svg/background.jpg");
                width: 100%;
                background-size: cover;
                overflow: hidden;
            }
            
            #contenedor_formulario_cambio_password{
                
                position: absolute;
                
                
                box-sizing: border-box;
                
                width: 50%;
                top: 25%;
                
                margin-left: 25%;
                
                text-align: center;
                
                
                background-color: rgba(35, 44, 44, 0.8);
                
                border-radius: 14px 14px 14px 14px;
                -moz-border-radius: 14px 14px 14px 14px;
                -webkit-border-radius: 14px 14px 14px 14px;
                border: 0px solid #000000;
                
                -webkit-box-shadow: 3px 3px 5px 0px rgba(0,0,0,0.75);
                -moz-box-shadow: 3px 3px 5px 0px rgba(0,0,0,0.75);
                box-shadow: 3px 3px 5px 0px rgba(0,0,0,0.75);                
                
            }
            
            .inputs_formulario_cambiar_password{
                display: block; 
                margin-bottom: 1.5em;       
                width: 95%;
                margin-left: 2.5%;
                margin-right: 2.5%;
                margin-top: 2em;
                text-align: center;
                border-radius: 14px 14px 14px 14px;
                -moz-border-radius: 14px 14px 14px 14px;
                -webkit-border-radius: 14px 14px 14px 14px;
                border: 0px solid #000000;                   
            }
            
            button{
                border-radius: 14px 14px 14px 14px;
                -moz-border-radius: 14px 14px 14px 14px;
                -webkit-border-radius: 14px 14px 14px 14px;                
            }
            
            h1{
                color: white;
            }
            
        </style>
        
    </head>
    <body>

        <div id="contenedor_formulario_cambio_password">
            
            <h1>Cambio de contraseña requerido</h1>
            
            <form method="post" action="cambiar_password">

                @csrf
                
                <input required name="old_password" class="inputs_formulario_cambiar_password" type="password" placeholder="Ingresa una contraseña nueva"> </input>

                <input required name="new_password" class="inputs_formulario_cambiar_password"  type="password" placeholder="Confirma la nueva contraseña"> </input>

                <button>Guardar cambios</button>

            </form>            
            
        </div>
        
    </body>
    
    
    <script>
    
    </script>
</html>

