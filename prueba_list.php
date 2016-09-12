<?php
/* Copyright (C) 2007-2015 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) ---Put here your own copyright and developer email---
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *   	\file       Descuentos/prueba_list.php
 *		\ingroup    Descuentos
 *		\brief      This file is an example of a php page
 *					Initialy built by build_class_from_table on 2016-09-07 15:18
 */

//if (! defined('NOREQUIREUSER'))  define('NOREQUIREUSER','1');
//if (! defined('NOREQUIREDB'))    define('NOREQUIREDB','1');
//if (! defined('NOREQUIRESOC'))   define('NOREQUIRESOC','1');
//if (! defined('NOREQUIRETRAN'))  define('NOREQUIRETRAN','1');
//if (! defined('NOCSRFCHECK'))    define('NOCSRFCHECK','1');			// Do not check anti CSRF attack test
//if (! defined('NOSTYLECHECK'))   define('NOSTYLECHECK','1');			// Do not check style html tag into posted data
//if (! defined('NOTOKENRENEWAL')) define('NOTOKENRENEWAL','1');		// Do not check anti POST attack test
//if (! defined('NOREQUIREMENU'))  define('NOREQUIREMENU','1');			// If there is no need to load and show top and left menu
//if (! defined('NOREQUIREHTML'))  define('NOREQUIREHTML','1');			// If we don't need to load the html.form.class.php
//if (! defined('NOREQUIREAJAX'))  define('NOREQUIREAJAX','1');
//if (! defined("NOLOGIN"))        define("NOLOGIN",'1');				// If this page is public (can be called outside logged session)

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
$limit = GETPOST("limit")?GETPOST("limit","int"):$conf->liste_limit;
$sortfield = GETPOST('sortfield','alpha');
$sortorder = GETPOST('sortorder','alpha');
$page = GETPOST('page','int');
if ($page == -1) { $page = 0; }
$offset = $limit * $page;
$pageprev = $page - 1;
$pagenext = $page + 1;
if (! $sortfield) $sortfield="t.rowid"; // Set here default search field
if (! $sortorder) $sortorder="ASC";

// Protection if external user
$socid=0;
if ($user->societe_id > 0)
{
    $socid = $user->societe_id;
	//accessforbidden();
}

// Initialize technical object to manage hooks. Note that conf->hooks_modules contains array
$hookmanager->initHooks(array('pruebalist'));
$extrafields = new ExtraFields($db);

// fetch optionals attributes and labels
$extralabels = $extrafields->fetch_name_optionals_label('Descuentos');
$search_array_options=$extrafields->getOptionalsFromPost($extralabels,'','search_');

// Load object if id or ref is provided as parameter
$object=new Prueba($db);
if (($id > 0 || ! empty($ref)) && $action != 'add')
{
	$result=$object->fetch($id,$ref);
	if ($result < 0) dol_print_error($db);
}

// Definition of fields for list
$arrayfields=array(
    
't.nombre'=>array('label'=>$langs->trans("Fieldnombre"), 'checked'=>1),

    
    //'t.entity'=>array('label'=>$langs->trans("Entity"), 'checked'=>1, 'enabled'=>(! empty($conf->multicompany->enabled) && empty($conf->multicompany->transverse_mode))),
    't.datec'=>array('label'=>$langs->trans("DateCreation"), 'checked'=>0, 'position'=>500),
    't.tms'=>array('label'=>$langs->trans("DateModificationShort"), 'checked'=>0, 'position'=>500),
    //'t.statut'=>array('label'=>$langs->trans("Status"), 'checked'=>1, 'position'=>1000),
);
// Extra fields
if (is_array($extrafields->attribute_label) && count($extrafields->attribute_label))
{
   foreach($extrafields->attribute_label as $key => $val) 
   {
       $arrayfields["ef.".$key]=array('label'=>$extrafields->attribute_label[$key], 'checked'=>$extrafields->attribute_list[$key], 'position'=>$extrafields->attribute_pos[$key], 'enabled'=>$extrafields->attribute_perms[$key]);
   }
}




/*******************************************************************
* ACTIONS
*
* Put here all code to do according to value of "action" parameter
********************************************************************/

$parameters=array();
$reshook=$hookmanager->executeHooks('doActions',$parameters,$object,$action);    // Note that $action and $object may have been modified by some hooks
if ($reshook < 0) setEventMessages($hookmanager->error, $hookmanager->errors, 'errors');

include DOL_DOCUMENT_ROOT.'/core/actions_changeselectedfields.inc.php';

if (GETPOST("button_removefilter_x") || GETPOST("button_removefilter.x") ||GETPOST("button_removefilter")) // All test are required to be compatible with all browsers
{
	
$search_nombre='';

	
	$search_date_creation='';
	$search_date_update='';
	$search_array_options=array();
}


if (empty($reshook))
{
	// Action to delete
	if ($action == 'confirm_delete')
	{
		$result=$object->delete($user);
		if ($result > 0)
		{
			// Delete OK
			setEventMessages("RecordDeleted", null, 'mesgs');
			header("Location: ".dol_buildpath('/Descuentos/list.php',1));
			exit;
		}
		else
		{
			if (! empty($object->errors)) setEventMessages(null,$object->errors,'errors');
			else setEventMessages($object->error,null,'errors');
		}
	}
}




/***************************************************
* VIEW
*
* Put here all code to build page
****************************************************/

llxHeader('','Modulo Descuentos','');

$form=new Form($db);

// Put here content of your page
$title = $langs->trans('Lista de Descuentos por producto');

// $product = new Product($db) ;
// $result = $product->fetch(3) ; //Tester $result pour vérifier que l'accès à la base s'est bien passé

// var_dump($product);
// echo $product->label;






$resql=$db->query("select * from llx_societe where rowid = 116");
 if ($resql)
 {
         $num = $db->num_rows($resql);
         $i = 0;
         if ($num)
         {
                 while ($i < $num)
                 {
                         $obj = $db->fetch_object($resql);
                         if ($obj)
                         {
                                 // You can use here results
                                 print $obj->nom;
                                 //print $obj->name_alias;
                         }
                         $i++;
                 }
         }
 }else{

	 print "nada";
 }

print"


	<header id='header' class='skel-layers-fixed'>
				<h1><a href='#'>Ion</a></h1>
				<nav id='nav'>
					<ul>
						<li><a href='index.html'>Home</a></li>
						<li><a href='left-sidebar.html'>Left Sidebar</a></li>
						<li><a href='right-sidebar.html'>Right Sidebar</a></li>
						<li><a href='no-sidebar.html'>No Sidebar</a></li>
						<li><a href='#' class='button special'>Sign Up</a></li>
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id='banner'>
				<div class='inner'>
					<h2>This is Ion</h2>
					<p>A free responsive template by <a href='http://templated.co'>TEMPLATED</a></p>
					<ul class='actions'>
						<li><a href='#content' class='button big special'>Sign Up</a></li>
						<li><a href='#elements' class='button big alt'>Learn More</a></li>
					</ul>
				</div>
			</section>

		<!-- One -->
			<section id='one' class='wrapper style1'>
				<header class='major'>
					<h2>Ipsum feugiat consequat</h2>
					<p>Tempus adipiscing commodo ut aliquam blandit</p>

					<input type='text'>
				</header>
				<div class='container'>
					<div class='row'>
						<div class='4u'>
							<section class='special box'>
								<i class='icon fa-area-chart major'></i>
								<h3>Justo placerat</h3>
								<p>Eu non col commodo accumsan ante mi. Commodo consectetur sed mi adipiscing accumsan ac nunc tincidunt lobortis.</p>
							</section>
						</div>
						<div class='4u'>
							<section class='special box'>
								<i class='icon fa-refresh major'></i>
								<h3>Blandit quis curae</h3>
								<p>Eu non col commodo accumsan ante mi. Commodo consectetur sed mi adipiscing accumsan ac nunc tincidunt lobortis.</p>
							</section>
						</div>
						<div class='4u'>
							<section class='special box'>
								<i class='icon fa-cog major'></i>
								<h3>Amet sed accumsan</h3>
								<p>Eu non col commodo accumsan ante mi. Commodo consectetur sed mi adipiscing accumsan ac nunc tincidunt lobortis.</p>
							</section>
						</div>
					</div>
				</div>
			</section>
			
		<!-- Two -->
			<section id='two' class='wrapper style2'>
				<header class='major'>
					<h2>Commodo accumsan aliquam</h2>
					<p>Amet nisi nunc lorem accumsan</p>
				</header>
				<div class='container'>
					<div class='row'>
						<div class='6u'>
							<section class='special'>
								<a href='#' class='image fit'><img src='images/pic01.jpg' alt='' /></a>
								<h3>Mollis adipiscing nisl</h3>
								<p>Eget mi ac magna cep lobortis faucibus accumsan enim lacinia adipiscing metus urna adipiscing cep commodo id. Ac quis arcu amet. Arcu nascetur lorem adipiscing non faucibus odio nullam arcu lobortis. Aliquet ante feugiat. Turpis aliquet ac posuere volutpat lorem arcu aliquam lorem.</p>
								<ul class='actions'>
									<li><a href='#' class='button alt'>Learn More</a></li>
								</ul>
							</section>
						</div>
						<div class='6u'>
							<section class='special'>
								<a href='#' class='image fit'><img src='images/pic02.jpg' alt='' /></a>
								<h3>Neque ornare adipiscing</h3>
								<p>Eget mi ac magna cep lobortis faucibus accumsan enim lacinia adipiscing metus urna adipiscing cep commodo id. Ac quis arcu amet. Arcu nascetur lorem adipiscing non faucibus odio nullam arcu lobortis. Aliquet ante feugiat. Turpis aliquet ac posuere volutpat lorem arcu aliquam lorem.</p>
								<ul class='actions'>
									<li><a href='#' class='button alt'>Learn More</a></li>
								</ul>
							</section>
						</div>
					</div>
				</div>
			</section>

		<!-- Three -->
			<section id='three' class='wrapper style1'>
				<div class='container'>
					<div class='row'>
						<div class='8u'>
							<section>
								<h2>Mollis ut adipiscing</h2>
								<a href='#' class='image fit'><img src='images/pic03.jpg' alt='' /></a>
								<p>Vis accumsan feugiat adipiscing nisl amet adipiscing accumsan blandit accumsan sapien blandit ac amet faucibus aliquet placerat commodo. Interdum ante aliquet commodo accumsan vis phasellus adipiscing. Ornare a in lacinia. Vestibulum accumsan ac metus massa tempor. Accumsan in lacinia ornare massa amet. Ac interdum ac non praesent. Cubilia lacinia interdum massa faucibus blandit nullam. Accumsan phasellus nunc integer. Accumsan euismod nunc adipiscing lacinia erat ut sit. Arcu amet. Id massa aliquet arcu accumsan lorem amet accumsan commodo odio cubilia ac eu interdum placerat placerat arcu commodo lobortis adipiscing semper ornare pellentesque.</p>
							</section>
						</div>
						<div class='4u'>
							<section>
								<h3>Magna massa blandit</h3>
								<p>Feugiat amet accumsan ante aliquet feugiat accumsan. Ante blandit accumsan eu amet tortor non lorem felis semper. Interdum adipiscing orci feugiat penatibus adipiscing col cubilia lorem ipsum dolor sit amet feugiat consequat.</p>
								<ul class='actions'>
									<li><a href='#' class='button alt'>Learn More</a></li>
								</ul>
							</section>
							<hr />
							<section>
								<h3>Ante sed commodo</h3>
								<ul class='alt'>
									<li><a href='#'>Erat blandit risus vis adipiscing</a></li>
									<li><a href='#'>Tempus ultricies faucibus amet</a></li>
									<li><a href='#'>Arcu commodo non adipiscing quis</a></li>
									<li><a href='#'>Accumsan vis lacinia semper</a></li>
								</ul>
							</section>
						</div>
					</div>
				</div>
			</section>	




















";

// Page end
//dol_fiche_end();
// End of page
llxFooter();
$db->close();
