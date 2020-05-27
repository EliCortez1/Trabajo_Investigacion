<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/students.php");
	include("$currDir/students_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('students');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "students";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`students`.`id`" => "id",
		"`students`.`FullName`" => "FullName",
		"`students`.`Gender`" => "Gender",
		"if(`students`.`DOB`,date_format(`students`.`DOB`,'%m/%d/%Y'),'')" => "DOB",
		"`students`.`Photo`" => "Photo",
		"`students`.`RegNo`" => "RegNo",
		"IF(    CHAR_LENGTH(`classes1`.`Name`), CONCAT_WS('',   `classes1`.`Name`), '') /* Class */" => "Class",
		"IF(    CHAR_LENGTH(`streams1`.`Name`), CONCAT_WS('',   `streams1`.`Name`), '') /* Stream */" => "Stream",
		"IF(    CHAR_LENGTH(`hostels1`.`Name`), CONCAT_WS('',   `hostels1`.`Name`), '') /* Hostel */" => "Hostel",
		"if(`students`.`DOJ`,date_format(`students`.`DOJ`,'%m/%d/%Y'),'')" => "DOJ",
		"IF(    CHAR_LENGTH(`studentcategories1`.`Name`), CONCAT_WS('',   `studentcategories1`.`Name`), '') /* Category */" => "Category",
		"IF(    CHAR_LENGTH(`sessions1`.`Year`) || CHAR_LENGTH(`sessions1`.`Term`), CONCAT_WS('',   `sessions1`.`Year`, ' :Term ', `sessions1`.`Term`), '') /* AcademicYear */" => "AcademicYear",
		"IF(    CHAR_LENGTH(`schoolmoney1`.`Total`), CONCAT_WS('',   `schoolmoney1`.`Total`), '') /* TotalFees */" => "TotalFees",
		"`students`.`AdvanceFees`" => "AdvanceFees",
		"`students`.`Balance`" => "Balance",
		"IF(    CHAR_LENGTH(`parents1`.`Name`) || CHAR_LENGTH(`parents1`.`Phone`), CONCAT_WS('',   `parents1`.`Name`, ' :Phone: ', `parents1`.`Phone`), '') /* Parent */" => "Parent"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`students`.`id`',
		2 => 2,
		3 => 3,
		4 => '`students`.`DOB`',
		5 => 5,
		6 => 6,
		7 => '`classes1`.`Name`',
		8 => '`streams1`.`Name`',
		9 => '`hostels1`.`Name`',
		10 => '`students`.`DOJ`',
		11 => '`studentcategories1`.`Name`',
		12 => 12,
		13 => '`schoolmoney1`.`Total`',
		14 => '`students`.`AdvanceFees`',
		15 => '`students`.`Balance`',
		16 => 16
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`students`.`id`" => "id",
		"`students`.`FullName`" => "FullName",
		"`students`.`Gender`" => "Gender",
		"if(`students`.`DOB`,date_format(`students`.`DOB`,'%m/%d/%Y'),'')" => "DOB",
		"`students`.`Photo`" => "Photo",
		"`students`.`RegNo`" => "RegNo",
		"IF(    CHAR_LENGTH(`classes1`.`Name`), CONCAT_WS('',   `classes1`.`Name`), '') /* Class */" => "Class",
		"IF(    CHAR_LENGTH(`streams1`.`Name`), CONCAT_WS('',   `streams1`.`Name`), '') /* Stream */" => "Stream",
		"IF(    CHAR_LENGTH(`hostels1`.`Name`), CONCAT_WS('',   `hostels1`.`Name`), '') /* Hostel */" => "Hostel",
		"if(`students`.`DOJ`,date_format(`students`.`DOJ`,'%m/%d/%Y'),'')" => "DOJ",
		"IF(    CHAR_LENGTH(`studentcategories1`.`Name`), CONCAT_WS('',   `studentcategories1`.`Name`), '') /* Category */" => "Category",
		"IF(    CHAR_LENGTH(`sessions1`.`Year`) || CHAR_LENGTH(`sessions1`.`Term`), CONCAT_WS('',   `sessions1`.`Year`, ' :Term ', `sessions1`.`Term`), '') /* AcademicYear */" => "AcademicYear",
		"IF(    CHAR_LENGTH(`schoolmoney1`.`Total`), CONCAT_WS('',   `schoolmoney1`.`Total`), '') /* TotalFees */" => "TotalFees",
		"`students`.`AdvanceFees`" => "AdvanceFees",
		"`students`.`Balance`" => "Balance",
		"IF(    CHAR_LENGTH(`parents1`.`Name`) || CHAR_LENGTH(`parents1`.`Phone`), CONCAT_WS('',   `parents1`.`Name`, ' :Phone: ', `parents1`.`Phone`), '') /* Parent */" => "Parent"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`students`.`id`" => "ID",
		"`students`.`Nombre Completo`" => "Nombre Completo",
		"`students`.`Género`" => "Género",
		"`students`.`Nacimiento`" => "Nacimiento",
		"`students`.`Nº Registro`" => "Nº Registro",
		"IF(    CHAR_LENGTH(`classes1`.`Name`), CONCAT_WS('',   `classes1`.`Name`), '') /* Clase */" => "Clase",
		"IF(    CHAR_LENGTH(`streams1`.`Name`), CONCAT_WS('',   `streams1`.`Name`), '') /* Desarrollo */" => "Desarrollo",
		"IF(    CHAR_LENGTH(`hostels1`.`Name`), CONCAT_WS('',   `hostels1`.`Name`), '') /* Dirección */" => "Dirección",
		"`students`.`Observación`" => "Observación",
		"IF(    CHAR_LENGTH(`studentcategories1`.`Name`), CONCAT_WS('',   `studentcategories1`.`Name`), '') /* Categoria */" => "Categoria",
		"IF(    CHAR_LENGTH(`sessions1`.`Year`) || CHAR_LENGTH(`sessions1`.`Term`), CONCAT_WS('',   `sessions1`.`Year`, ' :Term ', `sessions1`.`Term`), '') /* Año Escolar */" => "Año Escolar",
		"IF(    CHAR_LENGTH(`schoolmoney1`.`Total`), CONCAT_WS('',   `schoolmoney1`.`Total`), '') /* Ponerado */" => "Ponerado",
		"`students`.`Nota`" => "Nota",
		"`students`.`Balance`" => "Balance",
		"IF(    CHAR_LENGTH(`parents1`.`Name`) || CHAR_LENGTH(`parents1`.`Phone`), CONCAT_WS('',   `parents1`.`Name`, ' :Phone: ', `parents1`.`Phone`), '') /* Pariente */" => "Pariente"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`students`.`id`" => "id",
		"`students`.`FullName`" => "FullName",
		"`students`.`Gender`" => "Gender",
		"if(`students`.`DOB`,date_format(`students`.`DOB`,'%m/%d/%Y'),'')" => "DOB",
		"`students`.`RegNo`" => "RegNo",
		"IF(    CHAR_LENGTH(`classes1`.`Name`), CONCAT_WS('',   `classes1`.`Name`), '') /* Class */" => "Class",
		"IF(    CHAR_LENGTH(`streams1`.`Name`), CONCAT_WS('',   `streams1`.`Name`), '') /* Stream */" => "Stream",
		"IF(    CHAR_LENGTH(`hostels1`.`Name`), CONCAT_WS('',   `hostels1`.`Name`), '') /* Hostel */" => "Hostel",
		"if(`students`.`DOJ`,date_format(`students`.`DOJ`,'%m/%d/%Y'),'')" => "DOJ",
		"IF(    CHAR_LENGTH(`studentcategories1`.`Name`), CONCAT_WS('',   `studentcategories1`.`Name`), '') /* Category */" => "Category",
		"IF(    CHAR_LENGTH(`sessions1`.`Year`) || CHAR_LENGTH(`sessions1`.`Term`), CONCAT_WS('',   `sessions1`.`Year`, ' :Term ', `sessions1`.`Term`), '') /* AcademicYear */" => "AcademicYear",
		"IF(    CHAR_LENGTH(`schoolmoney1`.`Total`), CONCAT_WS('',   `schoolmoney1`.`Total`), '') /* TotalFees */" => "TotalFees",
		"`students`.`AdvanceFees`" => "AdvanceFees",
		"`students`.`Balance`" => "Balance",
		"IF(    CHAR_LENGTH(`parents1`.`Name`) || CHAR_LENGTH(`parents1`.`Phone`), CONCAT_WS('',   `parents1`.`Name`, ' :Phone: ', `parents1`.`Phone`), '') /* Parent */" => "Parent"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'Class' => 'Class', 'Stream' => 'Stream', 'Hostel' => 'Hostel', 'Category' => 'Category', 'AcademicYear' => 'AcademicYear', 'TotalFees' => 'TotalFees', 'Parent' => 'Parent');

	$x->QueryFrom = "`students` LEFT JOIN `classes` as classes1 ON `classes1`.`id`=`students`.`Class` LEFT JOIN `streams` as streams1 ON `streams1`.`id`=`students`.`Stream` LEFT JOIN `hostels` as hostels1 ON `hostels1`.`id`=`students`.`Hostel` LEFT JOIN `studentcategories` as studentcategories1 ON `studentcategories1`.`id`=`students`.`Category` LEFT JOIN `sessions` as sessions1 ON `sessions1`.`id`=`students`.`AcademicYear` LEFT JOIN `schoolmoney` as schoolmoney1 ON `schoolmoney1`.`id`=`students`.`TotalFees` LEFT JOIN `parents` as parents1 ON `parents1`.`id`=`students`.`Parent` ";
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
	$x->ScriptFileName = "students_view.php";
	$x->RedirectAfterInsert = "students_view.php?SelectedID=#ID#";
	$x->TableTitle = "Estudiante";
	$x->TableIcon = "resources/table_icons/group_add.png";
	$x->PrimaryKey = "`students`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Nombre", "Genero", "Nacimiento", "Foto", "Nº Registro", "Clases", "Desarrollo", "Dirección", "Observación", "Categoria", "Año Escolar", "Ponerado", "Nota", "Balance", "Pariente");
	$x->ColFieldName = array('FullName', 'Gender', 'DOB', 'Photo', 'RegNo', 'Class', 'Stream', 'Hostel', 'DOJ', 'Category', 'AcademicYear', 'TotalFees', 'AdvanceFees', 'Balance', 'Parent');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16);

	// template paths below are based on the app main directory
	$x->Template = 'templates/students_templateTV.html';
	$x->SelectedTemplate = 'templates/students_templateTVS.html';
	$x->TemplateDV = 'templates/students_templateDV.html';
	$x->TemplateDVP = 'templates/students_templateDVP.html';

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
		$x->QueryWhere="where `students`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='students' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `students`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='students' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`students`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: students_init
	$render=TRUE;
	if(function_exists('students_init')){
		$args=array();
		$render=students_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: students_header
	$headerCode='';
	if(function_exists('students_header')){
		$args=array();
		$headerCode=students_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: students_footer
	$footerCode='';
	if(function_exists('students_footer')){
		$args=array();
		$footerCode=students_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>