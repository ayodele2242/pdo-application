<?php
include('../inc/admins.php');
require_once '../inc/cookie.php';








/*$result = mysqli_query($mysqli,"SELECT sum(amount_invested) as capital, sum(Amt_to_get) as returns from plans WHERE transId !=''");
$count = mysqli_num_rows($result);
$response = array();
while($row = mysqli_fetch_array($result))

{
$response = array(
array("y" => $row["capital"], "legendText" => "Total Capital", "label" => "Total Capital"),
array("y" => $row["returns"], "legendText" => "Total Returns", "label" => "Total Returns")
);

}*/





?>

<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		
		<meta name="description" content="Page with empty content" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<title>
			<?php 
			    
			    echo $web['storeName'] . ' - '. (isset($current_page)) ? ucwords(str_replace('_', ' ', $current_page)) : SITE_TITLE;
			    
		    ?>
		</title>
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="../assets/plugins/fullcalendar.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="../assets/plugins.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="../assets/prismjs/prismjs.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="../assets/css/style.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="../assets/header/base/light.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="../assets/header/menu/light.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="../assets/brand/dark.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="../assets/aside/dark.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="../assets/css/color.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/wizard-2.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/color_variance.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/table.css" rel="stylesheet" type="text/css" />
		<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="/metronic/theme/html/demo1/dist/assets/media/logos/favicon.ico" />
		<script src="https://kit.fontawesome.com/861c4e528f.js" crossorigin="anonymous"></script>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

		<style type="text/css">
			.relative{
				position: relative;
			}
			.iStatus{
				width: 100%;
				  height: 100%;
				  position: absolute;
				  background: rgba(255,255,255,.8);
				   display: flex;
				    justify-content: center;
				    align-items: center;
				  top: 0;
				  left: 0;
				   z-index: 10;

			}
			.hide{
				display: none;
			}
			.show{
				display: block;
			}
		</style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		