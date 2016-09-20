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
dol_include_once('/Descuentos/class/prueba.class.php');

// Load traductions files requiredby by page
$langs->load("Descuentos");
$langs->load("other");

// Get parameters
$id			= GETPOST('id','int');
$action		= GETPOST('action','alpha');
$backtopage = GETPOST('backtopage');
$myparam	= GETPOST('myparam','alpha');




$search_nombre=GETPOST('search_nombre','alpha');


$optioncss = GETPOST('optioncss','alpha');

// Load variable for pagination
// $limit = GETPOST("limit")?GETPOST("limit","int"):$conf->liste_limit;
// $sortfield = GETPOST('sortfield','alpha');
// $sortorder = GETPOST('sortorder','alpha');
// $page = GETPOST('page','int');
// if ($page == -1) { $page = 0; }
// $offset = $limit * $page;
// $pageprev = $page - 1;
// $pagenext = $page + 1;
// if (! $sortfield) $sortfield="t.rowid"; // Set here default search field
// if (! $sortorder) $sortorder="ASC";

// Protection if external user
$socid=0;
if ($user->societe_id > 0)
{
    $socid = $user->societe_id;
	accessforbidden();
}
 $object=new Prueba($db);
    
	if ($action == 'prueba')
	{

       
		
		$result=$object->todo();

		//echo($result);
		// if ($result > 0)
		// {
		// 	// Delete OK
		// 	setEventMessages("RecordDeleted", null, 'mesgs');
		// 	header("Location: ".dol_buildpath('/Descuentos/list.php',1));
		// 	exit;
		// }
		// else
		// {
		// 	if (! empty($object->errors)) setEventMessages(null, $object->errors, 'errors');
		// 	else setEventMessages($object->error, null, 'errors');
		// }
	}


// Load object if id or ref is provided as parameter





/***************************************************
* VIEW
*
* Put here all code to build page
****************************************************/

llxHeader('','Modulo Descuentos','');



	if ($action == 'listar')
	{

       
		
		$result=$object->todo();


dol_fiche_head();

$result=$object->traer(1);

var_dump($result->nombre);

print '



<div class="container">


<h3>Modulo Descuentos <small> </small></h3>

		<div id="content"> <!---inicio content  y tabs----->

			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
				<li class="active"><a href="#newdesc" data-toggle="tab">Descuento Nuevo</a></li>
                <li><a href="#regla" data-toggle="tab">Reglas</a></li>
				<li><a href="#about" data-toggle="tab">Acerca De</a></li>

			</ul>
			<div id="my-tab-content" class="tab-content">
				<div class="tab-pane active" id="newdesc">


                <br>

                <div>
                
                

                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Datos</div>

                                <div class="panel-body">
                                    <!-- inicio del form -->
<form class="form-inline">


                                            <div class="row">

                                             

                                                <div class="col-xs-12 col-sm-12">
                                                
                                                    <div class="form-group col-xs-4">


                                                        <label for="exampleInputName2">Nombre Regla</label>
                                                        <input type="text" class="form-control" id="nombre" name ="nombre" placeholder="Jane Doe">


                                                    </div>
                                                    <div class="form-group col-xs-4">

                                                        <label for="exampleInputEmail2">Producto</label>

                                                            <select class="form-control">
                                                            <option>Default select</option>
                                                            <option>Default select</option>
                                                            <option>Default select</option> 
                                                            </select>

                                                    </div>
                                                    <div class="form-group col-xs-4">


                                                        <h4> <small>Valor </small> $88,88</h4>

                                                    </div>
                                                

                                                </div>


                                            </div> <!-- fn de row -->








<hr>




                                            <div class="row">

                                             

                                                <div class="col-xs-12 col-sm-12">
                                                
                                                    <div class="form-group col-xs-4">


                                                        <label for="exampleInputName2">Desde</label>
                                                        <input type="text" class="form-control" id="nombre" name ="nombre" placeholder="Jane Doe">


                                                    </div>
                                                    <div class="form-group col-xs-3">

                                                        <label for="exampleInputEmail2">Hasta</label>

                                                        <input type="text" class="form-control input-md" id="nombre" name ="nombre" placeholder="Jane Doe">


                                                    </div>
                                                    <div class="form-group col-xs-3">

                                                        <label for="exampleInputEmail2">descuento</label>
                                                        <input type="text" class="form-control input-md" id="nombre" name ="nombre" placeholder="Jane Doe">

                                                    </div>


                                                     <div class="form-group col-xs-2">

                                                            <button type="button" class="btn btn-default btn-xs">+</button>
                                                            <button type="button" class="btn btn-default btn-xs">-</button>

                                                    </div>


                                                </div>


                                            </div> <!-- fn de row -->
<hr>

                       

  </form>  <!-- fn del form -->
                               

                                </div>  <!-- fn panel body -->

                            </div> <!-- fn del panel princ -->

                
                </div>


				</div>



				<div class="tab-pane" id="regla"> <!--panel de reglas-->


                 <br>

                    <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Lista escalonada de Precios</div>

                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Rango</th>
                                <th>Valor con Descuento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Rocky</td>
                                <td> 1 a 11 latas</td>
                                <td>$12.15</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="panel-footer">Panel footer</div>
                    </div>



                    <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        </li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        </li>
                    </ul>
                    </nav>


				</div>


				<div class="tab-pane" id="about">  <!--panel de acerca de-->


                            <br>
                            <div class="panel panel-default">
                            <div class="panel-body">
                                
                                                <address>
                                                <strong>TMS Group</strong><br>
                                                Avenida Principal 123<br>
                                                Ciudad, Provincia 00000<br>
                                                <abbr title="Phone">Tel:</abbr> 9XX 123 456
                                                </address>
                                                
                                                <address>
                                                <strong>Nombre Apellido</strong><br>
                                                <a href="mailto:#">nombre.apellido@ejemplo.com</a>
                                                </address>


                            </div>
                            </div>


				</div>



				
			</div> <!---fin tab- content ----->

		</div><!---fin content ----->










</div> <!-- container -->

</body>
</html>
';

// Page end
dol_fiche_end();










	}

var_dump($result);

// $product = new Product($db) ;
// $result = $product->fetch(3) ; //Tester $result pour vérifier que l'accès à la base s'est bien passé


// echo $product->label;






// $resql=$db->query("select * from llx_societe where rowid = 116");

//  if ($resql)
//  {
//          $num = $db->num_rows($resql);
//          $i = 0;
//          if ($num)
//          {
//                  while ($i < $num)
//                  {
//                          $obj = $db->fetch_object($resql);
//                          if ($obj)
//                          {
//                                  // You can use here results
//                                  print $obj->nom;
//                                  //print $obj->name_alias;
//                          }
//                          $i++;
//                  }
//          }
//  }else{

// 	 print "nada";
//  }




//print "<h1> aqui esta el cuerpo </h1>";


// End of page
//llxFooter();
$db->close();
