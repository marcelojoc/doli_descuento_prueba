<?php

// Change this following line to use the correct relative path (../, ../../, etc)
$res=0;
if (! $res && file_exists("../main.inc.php")) $res=@include '../main.inc.php';					// to work if your module directory is into dolibarr root htdocs directory
if (! $res && file_exists("../../main.inc.php")) $res=@include '../../main.inc.php';			// to work if your module directory is into a subdir of root htdocs directory
if (! $res && file_exists("../../../dolibarr/htdocs/main.inc.php")) $res=@include '../../../dolibarr/htdocs/main.inc.php';     // Used on dev env only
if (! $res && file_exists("../../../../dolibarr/htdocs/main.inc.php")) $res=@include '../../../../dolibarr/htdocs/main.inc.php';   // Used on dev env only
if (! $res) die("Include of main fails");
// Change this following line to use the correct relative path from htdocs




require_once DOL_DOCUMENT_ROOT.'/product/class/product.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/date.lib.php';
include_once(DOL_DOCUMENT_ROOT.'/core/class/html.formcompany.class.php');
dol_include_once('/Descuentos/class/vendedor.class.php');
dol_include_once('/Descuentos/class/ruta.class.php');

// Load traductions files requiredby by page
$langs->load("Descuentos");
$langs->load("other");

// Get parameters
$id			= GETPOST('id','int');
$action		= GETPOST('action','alpha');
$vendedor = GETPOST('vendedor');
$ruta	= GETPOST('ruta','alpha');




$search_nombre=GETPOST('search_nombre','alpha');

$optioncss = GETPOST('optioncss','alpha');


// Protection if external user
$socid=0;
if ($user->societe_id > 0)
{
    $socid = $user->societe_id;
	accessforbidden();
}



$morejs = array("/descuentos/js/funciones.js");
$morecss = array("descuentos/css/descuentos.css");


 llxHeader('','Reporte Rutas','','','','',$morejs,$morecss,0,0); 

//llxHeader('','Modulo Descuentos','');

//dol_fiche_head();

$vendedores = new Vendedor($db);

$listado = $vendedores->getVendedores();
$lista_rutas= "";

	if(isset($id) and $id!= ""){

	//echo  ("dentro");

		$rutas = new Ruta($db);

		$rutas->setIdVendedor($id);

		$lista_rutas= $rutas->getRutas($ruta);

	}

	//var_dump($lista_rutas);

?>


<style>


</style>

  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-4">


<form class="form-horizontal">

<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Seleccionar Ruta</label>
  <div class="col-md-4 ">
    <select id="selectbasic" name="selectbasic" class="form-control btn-block">
      <option value="1">Ruta 1 - Lunes</option>
      <option value="2">Option two</option>
      <option value="1">Ruta 1 - Lunes</option>
      <option value="2">Option two</option>
      <option value="1">Ruta 1 - Lunes</option>
      <option value="2">Option two</option>
      <option value="1">Ruta 1 - Lunes</option>
      <option value="2">Option two</option>
      <option value="1">Ruta 1 - Lunes</option>
      <option value="2">Option two</option>
    </select>
  </div>
</div>


</form>


            <div class="list-group">
            <a href="#" class="list-group-item disabled">
                Vendedores
            </a>



<?php


		foreach( $listado as $vendedor){

			echo('<a href="reportes.php?id='. $vendedor['rowid']  .'" class="list-group-item">'. $vendedor['nom'] . ' '. $vendedor['lastname'] . '</a>');

		}

?>


   




            </div>



		</div>
		<div class="col-md-8">




            <div class="panel panel-default">
                <div class="panel-heading">
					<h3 class="panel-title">Reporte para NOMBRE VENDEDOR</h3>
					<span class="pull-right clickable "><i class="glyphicon glyphicon-print"></i> Imprimir </span>
				</div>
                <div class="panel-body">
                    
                    

<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							Cod Cliente
						</th>
						<th>
							Nombre
						</th>
						<th>
							Direccion
						</th>
						<th>
							Ruta
						</th>
					</tr>
				</thead>
				<tbody>
					<tr><td>1</td><td>TB - Monthly</td><td>01/04/2012</td><td>Default</td></tr>
					
<?php


	if(isset($lista_rutas)){


		foreach( $lista_rutas as $cliente){

			//echo('<a href="reportes.php?id='. $vendedor['rowid']  .'" class="list-group-item">'. $vendedor['nom'] . ' '. $vendedor['lastname'] . '</a>');


			echo(

				'<tr><td>1</td><td>TB - Monthly</td><td>01/04/2012</td><td>Default</td></tr>'
			);


		}


	}



?>



				</tbody>
			</table>


                </div>
            </div>

		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>


<?php
    //dol_fiche_end();
?>


