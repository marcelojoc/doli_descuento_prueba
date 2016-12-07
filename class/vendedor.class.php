<?php


class Vendedor 
{
  var $idVendedor;
  

	public function __construct(DoliDB $db, $id = null)
	{
		$this->db = $db;
		$this->idVendedor = $id;
		return 1;
		
	}


	public function setIdVendedor( $idVendedor){

		$this->idVendedor = $idVendedor;

	}


	public function getVendedor(){

		return $this->idVendedor;
	}
 
 
 


 // metodos para traer los vendedores


    function getVendedores (){

       

        $sql= "
        SELECT `rowid`, `lastname`, firstname FROM `llx_user` WHERE llx_user.`admin` != 1
        ";


        $this->db->begin();
        $resql = $this->db->query($sql);


        if ($resql)
        {
            $num = $this->db->num_rows($resql);
            $i = 0;
            if ($num)
            {
                    while ($i < $num)
                    {
                            $obj = $this->db->fetch_object($resql);
                            if ($obj)
                            {
                                    // You can use here results
                                    $respuesta[]= array(
                                        'cod_client'=> $obj->code_client,
                                        'nom'=>$obj->nom,
                                        'adress'=> $obj->address,
                                        'ruta'=> $obj->ruta1,
                                    );
                            }
                            $i++;
                    }
            }
        }else{

            $respuesta = 'hay un error en la conexion';
        }

        $this->db->commit();


        return  $respuesta;


    }



}