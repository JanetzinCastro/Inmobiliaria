<?php

class clsinmobiliaria{

	public function nombre($nom){

		return "Bienvenido" .$nom.", estas usando el servicio web";

	}
	
	//mostrar terrenos buscar
    public function BuscarTerrenos($ESTADO,$TIPO){
            $reg=0;
            $datos=array();
            if($conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria")){
                $recordset=mysqli_query($conn,"CALL spBuscarTerrenos('$ESTADO','$TIPO');");
                while($resultado = mysqli_fetch_assoc($recordset)){
                	$datos[$reg]["ID"]=$resultado["ID"];
                	$datos[$reg]["DIRECCION"]=$resultado["DIRECCION"];
                    $datos[$reg]["MEDIDAS"]=$resultado["MEDIDAS"];
                    $datos[$reg]["PRECIO"]=$resultado["PRECIO"];
                    $datos[$reg]["ESTATUS"]=$resultado["ESTATUS"];
                    $datos[$reg]["FECHA_REGISTRO"]=$resultado["FECHA_REGISTRO"];
                    $datos[$reg]["PROPIETARIO"]=$resultado["PROPIETARIO"];
                    $datos[$reg]["TIPO"]=$resultado["TIPO"];
                    $reg++;
                }
                mysqli_free_result($recordset);
                mysqli_close($conn);
            }
            return $datos;
        }
        
	//eliminar terreno
	public function eliminarTerreno($CLAVE){
	    $datosE=array();
	    $conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");
	    $renglon=mysqli_query($conn,"CALL spEliminarTerreno('$CLAVE')");
	    	while($resultado = mysqli_fetch_assoc($renglon)){
				$datosE[0]["CLAVE"] = $resultado["CLAVE"];
				if((int)$datosE[0]["CLAVE"]!=0){
					$datosE[0]["CLAVE"]=$resultado["CLAVE"];
				}
			}
			mysqli_close($conn);
			return $datosE;
		}
	//mostrar terrenos reg
    public function MostrarTerrenosReg($id){
            $reg=0;
            $datos=array();
            if($conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria")){
                $recordset=mysqli_query($conn,"CALL spMostrarTerrenosReg('$id');");
                while($resultado = mysqli_fetch_assoc($recordset)){
                	$datos[$reg]["ID"]=$resultado["ID"];
                	$datos[$reg]["DIRECCION"]=$resultado["DIRECCION"];
                    $datos[$reg]["MEDIDAS"]=$resultado["MEDIDAS"];
                    $datos[$reg]["PRECIO"]=$resultado["PRECIO"];
                    $datos[$reg]["DESCRIPCION"]=$resultado["DESCRIPCION"];
                    $datos[$reg]["ESTATUS"]=$resultado["ESTATUS"];
                    $datos[$reg]["FECHA_REGISTRO"]=$resultado["FECHA_REGISTRO"];
                    $datos[$reg]["PROPIETARIO"]=$resultado["PROPIETARIO"];
                    $datos[$reg]["TIPO"]=$resultado["TIPO"];
                    $reg++;
                }
                mysqli_free_result($recordset);
                mysqli_close($conn);
            }
            return $datos;
        }
	
	//eliminar usuario
	public function eliminarUsuario($CLAVE){
	    $datosE=array();
	    $conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");
	    $renglon=mysqli_query($conn,"CALL spEliminarUsuario('$CLAVE')");
	    	while($resultado = mysqli_fetch_assoc($renglon)){
				$datosE[0]["CLAVE"] = $resultado["CLAVE"];
				if((int)$datosE[0]["CLAVE"]!=0){
					$datosE[0]["CLAVE"]=$resultado["CLAVE"];
				}
			}
			mysqli_close($conn);
			return $datosE;
		}

	
	//mostrar MostrarUsuariosReg
    public function MostrarUsuariosReg($id){
            $reg=0;
            $datos=array();
            if($conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria")){
                $recordset=mysqli_query($conn,"CALL spMostrarUsuariosReg('$id');");
                while($resultado = mysqli_fetch_assoc($recordset)){
                	$datos[$reg]["ID"]=$resultado["ID"];
                    $datos[$reg]["NOMBRE"]=$resultado["NOMBRE"];
                    $datos[$reg]["USUARIO"]=$resultado["USUARIO"];
                    $datos[$reg]["ESTATUS"]=$resultado["ESTATUS"];
                    $datos[$reg]["FECHA_REGISTRO"]=$resultado["FECHA_REGISTRO"];
                    $datos[$reg]["ROL"]=$resultado["ROL"];
                    $reg++;
                }
                mysqli_free_result($recordset);
                mysqli_close($conn);
            }
            return $datos;
        }
	
	//Registro de admin
	public function regAdmin($NOMBRE,$APELLIDOPAT,$APELLIDOMAT,$NOMUSU,$PASS)
	{	 
         $datos=array();   
      
      if($conn = mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria") ){
		$renglon = mysqli_query($conn,"CALL spRegistrarAdmin('$NOMBRE' , '$APELLIDOPAT', '$APELLIDOMAT','$NOMUSU','$PASS')");	  			
			while($resultado = mysqli_fetch_assoc($renglon)){
                $datos[0]["CLAVE"] =$resultado["CLAVE"];				
				if((int)$datos[0]!=0)
				{				
					$datos[0]["CLAVE"] =$resultado["CLAVE"];
					
				}
			}							
            mysqli_close($conn); 		
      }    
                 
	   return $datos;
	}
	
	//Editar Terreno
	public function editarTerreno($id,$CALLE,$COLONIA,$MUNICIPIO,$ESTADO,$LARGO,$ANCHO,$PRECIO,$DESCRIPCION,$TIPOCVE){
	    $datos= array();
	  $conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");
	  $recordSet=mysqli_query($conn,"CALL spEditarTerreno('$id','$CALLE','$COLONIA','$MUNICIPIO','$ESTADO','$LARGO','$ANCHO','$PRECIO','$DESCRIPCION','$TIPOCVE')");
	   	while($resultado = mysqli_fetch_assoc($recordSet)){
				$datos[0]["CLAVE"] = $resultado["CLAVE"];
				if((int)$datos[0]["CLAVE"]!=0){
					$datos[0]["CLAVE"]=$resultado["CLAVE"];
				}
			}
			mysqli_close($conn);
			return $datos;
	}

    //baja Terreno
	public function bajaTerreno($CLAVE){
	    $datosE=array();
	    $conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");
	    $renglon=mysqli_query($conn,"CALL spBajaTerreno('$CLAVE')");
	    	while($resultado = mysqli_fetch_assoc($renglon)){
				$datosE[0]["CLAVE"] = $resultado["CLAVE"];
				if((int)$datosE[0]["CLAVE"]!=0){
					$datosE[0]["CLAVE"]=$resultado["CLAVE"];
				}
			}
			mysqli_close($conn);
			return $datosE;
		}

        
    //Registrar Terreno
	public function regTerreno($CALLE,$COLONIA,$MUNICIPIO,$ESTADO,$LARGO,$ANCHO,$PRECIO,$DESCRIPCION,$USUCVE,$TIPOCVE)
	{	 
         $datos=array();   
      
      if($conn = mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria") ){
		$renglon = mysqli_query($conn,"CALL spRegistrarTerreno('$CALLE','$COLONIA','$MUNICIPIO','$ESTADO','$LARGO','$ANCHO','$PRECIO','$DESCRIPCION','$USUCVE','$TIPOCVE')");	  			
			while($resultado = mysqli_fetch_assoc($renglon)){
                $datos[0]["CLAVE"] =$resultado["CLAVE"];				
				if((int)$datos[0]!=0)
				{				
					$datos[0]["CLAVE"] =$resultado["CLAVE"];
					
				}
			}							
            mysqli_close($conn); 		
      }    
                 
	   return $datos;
	}
	
	

    //Editar Perfil
	public function editarPerfil($id,$NOMUSU,$CON,$TELEFONO,$EMAIL,$CALLE,$COLONIA,$MUNICIPIO,$ESTADO,$PAGOCVE){
	    $datos= array();
	    $conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");
	  $recordSet=mysqli_query($conn,"CALL spEditarPerfil('$id','$NOMUSU','$CON','$TELEFONO','$EMAIL','$CALLE','$COLONIA','$MUNICIPIO','$ESTADO','$PAGOCVE')");
	   	while($resultado = mysqli_fetch_assoc($recordSet)){
				$datos[0]["CLAVE"] = $resultado["CLAVE"];
				if((int)$datos[0]["CLAVE"]!=0){
					$datos[0]["CLAVE"]=$resultado["CLAVE"];
				}
			}
			mysqli_close($conn);
			return $datos;
	}
	
   //Registro de Perfil
	public function regPerfil($TELEFONO,$EMAIL,$CALLE,$COLONIA,$MUNICIPIO,$ESTADO,$USUCVE,$PAGOCVE)
	{	 
         $datos=array();   
      
      if($conn = mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria") ){
		$renglon = mysqli_query($conn,"CALL spRegistrarPerfil('$TELEFONO','$EMAIL','$CALLE','$COLONIA','$MUNICIPIO','$ESTADO','$USUCVE','$PAGOCVE')");	  			
			while($resultado = mysqli_fetch_assoc($renglon)){
                $datos[0]["CLAVE"] =$resultado["CLAVE"];				
				if((int)$datos[0]!=0)
				{				
					$datos[0]["CLAVE"] =$resultado["CLAVE"];
					
				}
			}							
            mysqli_close($conn); 		
      }    
                 
	   return $datos;
	} 
    	//mostrar usuario
  public function mostrarUsuario($id){
            $reg=0;
            $datos=array();
            if($conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria")){
                $recordset=mysqli_query($conn,"CALL spMostrarUsuario('$id');");
                while($resultado = mysqli_fetch_assoc($recordset)){
                    $datos[$reg]["NOMBRE"]=$resultado["NOMBRE"];
                    $datos[$reg]["APELLIDO_PATERNO"]=$resultado["APELLIDO_PATERNO"];
                    $datos[$reg]["APELLIDO_MATERNO"]=$resultado["APELLIDO_MATERNO"];
                    $datos[$reg]["NOMBRE_USUARIO"]=$resultado["NOMBRE_USUARIO"];
                    $reg++;
                }
                mysqli_free_result($recordset);
                mysqli_close($conn);
            }
            return $datos;

        }
    
    //mostrar terreno
    public function mostrarTerreno($id){
            $reg=0;
            $datos=array();
            if($conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria")){
                $recordset=mysqli_query($conn,"CALL spMostrarTerreno('$id');");
                while($resultado = mysqli_fetch_assoc($recordset)){
                    $datos[$reg]["ID"]=$resultado["ID"];
                    $datos[$reg]["CALLE"]=$resultado["CALLE"];
                    $datos[$reg]["COLONIA"]=$resultado["COLONIA"];
                    $datos[$reg]["MUNICIPIO"]=$resultado["MUNICIPIO"];
                    $datos[$reg]["ESTADO"]=$resultado["ESTADO"];
                    $datos[$reg]["LARGO"]=$resultado["LARGO"];
                    $datos[$reg]["ANCHO"]=$resultado["ANCHO"];
                    $datos[$reg]["SUPERFICIE"]=$resultado["SUPERFICIE"];
                    $datos[$reg]["PRECIO"]=$resultado["PRECIO"];
                    $datos[$reg]["DESCRIPCION"]=$resultado["DESCRIPCION"];
                    $datos[$reg]["FECHA"]=$resultado["FECHA"];
                    $datos[$reg]["TIPO"]=$resultado["TIPO"];
                    $reg++;
                }
                mysqli_free_result($recordset);
                mysqli_close($conn);
            }
            return $datos;
        }
    //mostrar perfil
    public function mostrarPerfil($id){
            $reg=0;
            $datos=array();
            if($conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria")){
                $recordset=mysqli_query($conn,"CALL spMostrarPerfil('$id');");
                while($resultado = mysqli_fetch_assoc($recordset)){
                    $datos[$reg]["NOMBRE"]=$resultado["NOMBRE"];
                    $datos[$reg]["APELLIDO_PATERNO"]=$resultado["APELLIDO_PATERNO"];
                    $datos[$reg]["APELLIDO_MATERNO"]=$resultado["APELLIDO_MATERNO"];
                    $datos[$reg]["NOMBRE_USUARIO"]=$resultado["NOMBRE_USUARIO"];

                    $datos[$reg]["TELEFONO"]=$resultado["TELEFONO"];
                    $datos[$reg]["CORREO"]=$resultado["CORREO"];
                    $datos[$reg]["CALLE"]=$resultado["CALLE"];
                    $datos[$reg]["COLONIA"]=$resultado["COLONIA"];
                    $datos[$reg]["MUNICIPIO"]=$resultado["MUNICIPIO"];
                    $datos[$reg]["ESTADO"]=$resultado["ESTADO"];
                    $datos[$reg]["FORMA_PAGO"]=$resultado["FORMA_PAGO"];
                    $reg++;
                }
                mysqli_free_result($recordset);
                mysqli_close($conn);
            }
            return $datos;
        }

	public function acceso($usuario,$contra){

		$datos=array();

		if($conn = mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria")){

			$renglon = mysqli_query($conn,"CALL spValidarAccesoAdm('$usuario','$contra')");

			while($resultado = mysqli_fetch_assoc($renglon)){

				$datos[0]["CLAVE"] = $resultado["CLAVE"];

				if((int)$datos[0]["CLAVE"]!=0){

					$datos[1]["NOMBRE"]=$resultado["NOMBRE"];

					$datos[2]["ROL"]=$resultado["ROL"];

				}
			}
			mysqli_close($conn);
		}
		//devuelve el arreglo de datos
    	return $datos;
	}



  //Registro de Usuario
	public function regUsuario($NOMBRE,$APELLIDOPAT,$APELLIDOMAT,$NOMUSU,$PASS)
	{	 
         $datos=array();   
      
      if($conn = mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria") ){
		$renglon = mysqli_query($conn,"CALL spRegistrarUsuarios('$NOMBRE' , '$APELLIDOPAT', '$APELLIDOMAT','$NOMUSU','$PASS')");	  			
			while($resultado = mysqli_fetch_assoc($renglon)){
                $datos[0]["CLAVE"] =$resultado["CLAVE"];				
				if((int)$datos[0]!=0)
				{				
					$datos[0]["CLAVE"] =$resultado["CLAVE"];

				
				
										
				}
			}							
            mysqli_close($conn); 		
      }    
                 
	   return $datos;
	}
	
}
