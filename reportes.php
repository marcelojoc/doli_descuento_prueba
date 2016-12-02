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
$vendedor = GETPOST('vendedor');
$myparam	= GETPOST('myparam','alpha');




$search_nombre=GETPOST('search_nombre','alpha');
echo($action);

$optioncss = GETPOST('optioncss','alpha');


// Protection if external user
$socid=0;
if ($user->societe_id > 0)
{
    $socid = $user->societe_id;
	accessforbidden();
}



 $morejs = array("/descuentos/js/angular.min.js","/descuentos/js/funciones.js");
$morecss = array("/descuentos/css/funciones.css", "/descuentos/css/pruebitas.css");


 llxHeader('','tu vieja','','','','',$morejs,$morecss,0,0,false); 

//llxHeader('','Modulo Descuentos','');

//dol_fiche_head();
?>



<body>




</body>
</html>


<?php
    //dol_fiche_end();
?>