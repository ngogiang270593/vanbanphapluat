<!DOCTYPE html>
<html lang="en">
<head>
  <title>Trợ Lý Ảo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <script type="text/javascript">
     $(document).ready(function(){
        $('#list_goithau').DataTable();
      });
      $(document).ready(function(){
        $('#list_find').DataTable();
      });
  </script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
   
    
    #baner {
    	height: 50px;
    	width: 120%;
    }
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<div class="banner">
					<img id="banner" src="<?php echo BASE_URL ?>/images/baner.jpg" id="image_banner">
			</div>