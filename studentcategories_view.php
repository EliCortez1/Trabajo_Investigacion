<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/studentcategories.php");
	include("$currDir/studentcategories_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('studentcategories');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "studentcategories";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`studentcategories`.`id`" => "id",
		"`studentcategories`.`Name`" => "Name"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`studentcategories`.`id`',
		2 => 2
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`studentcategories`.`id`" => "id",
		"`studentcategories`.`Name`" => "Name"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`studentcategories`.`id`" => "ID",
		"`studentcategories`.`Name`" => "Name"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`studentcategories`.`id`" => "id",
		"`studentcategories`.`Name`" => "Name"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`studentcategories` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "studentcategories_view.php";
	$x->RedirectAfterInsert = "studentcategories_view.php?SelectedID=#ID#";
	$x->TableTitle = "
Categorías de estudiantes";
	$x->TableIcon = "resources/table_icons/blackboard_steps.png";
	$x->PrimaryKey = "`studentcategories`.`id`";

	$x->ColWidth   = array(  150);
	$x->ColCaption = array("Nombre");
	$x->ColFieldName = array('Name');
	$x->ColNumber  = array(2);

	// template paths below are based on the app main directory
	$x->Template = 'templates/studentcategories_templateTV.html';
	$x->SelectedTemplate = 'templates/studentcategories_templateTVS.html';
	$x->TemplateDV = 'templates/studentcategories_templateDV.html';
	$x->TemplateDVP = 'templates/studentcategories_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `studentcategories`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='studentcategories' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `studentcategories`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='studentcategories' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`studentcategories`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: studentcategories_init
	$render=TRUE;
	if(function_exists('studentcategories_init')){
		$args=array();
		$render=studentcategories_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: studentcategories_header
	$headerCode='';
	if(function_exists('studentcategories_header')){
		$args=array();
		$headerCode=studentcategories_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: studentcategories_footer
	$footerCode='';
	if(function_exists('studentcategories_footer')){
		$args=array();
		$footerCode=studentcategories_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>