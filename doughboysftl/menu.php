<?php
$pagina = "menu";

include "conexion.php";
include "util.php";

$eslunchspecial = false;
$idcategoria = Limpiar($link, "GET", "c", 1);

if ($idcategoria > 100){
	$eslunchspecial = true;
	$idcategoria = $idcategoria - 100; 
}

function ConvertirNombre($valor){
	$valor = str_replace(" ", "", $valor);
	$valor = str_replace("&", "", $valor);
	$valor = strtolower($valor);
	return $valor;
}

function TraerCategoriasDeIngrediente($link, $idingrediente){
	$sql = "SELECT c.* FROM categorias c 
	INNER JOIN productos p ON p.id_categoria = c.id_categoria 
	INNER JOIN productos_ingredientes pi ON pi.id_producto = p.id_producto 
	WHERE pi.id_ingrediente = $idingrediente
	ORDER BY nombre ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$clases = "";
	while($row = mysqli_fetch_array($rs)) {
		$clases .= " " . ConvertirNombre($row["nombre"]);
	}
	return $clases;
}

function TraerCategoriasDeProducto($link, $idproducto){
	$sql = "SELECT c.* FROM categorias c 
	INNER JOIN productos p ON p.id_categoria = c.id_categoria 
	WHERE p.id_producto = $idproducto
	ORDER BY nombre ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$clases = "";
	while($row = mysqli_fetch_array($rs)) {
		$clases .= " " . ConvertirNombre($row["nombre"]);
	}
	return $clases;
}

function TraerIngredientesDeProducto($link, $idproducto){
	$sql = "SELECT i.* FROM ingredientes i 
	INNER JOIN productos_ingredientes pi ON pi.id_ingrediente = i.id_ingrediente 
	WHERE pi.id_producto = $idproducto
	ORDER BY nombre ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$clases = "";
	while($row = mysqli_fetch_array($rs)) {
		$clases .= " " . ConvertirNombre($row["nombre"]);
	}
	return $clases;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="M_Adnan">
<title>Doughboys Pizzeria and Italian Restaurant</title>

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/ionicons.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/lightbox.css" rel="stylesheet">
<link href="css/chosen.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/x-icon" href="images/icon.png" />
<!-- JavaScripts -->
<script src="js/modernizr.js"></script>

<!-- Online Fonts -->
<link href='https://fonts.googleapis.com/css?family=Alex+Brush' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300,600,600italic,700italic,100' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,300,800' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Miltonian+Tattoo" rel="stylesheet" type='text/css'>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<!-- Wrap -->
<div id="wrap"> 

<style>
.prodtitles { padding-left: 10px; width: 85px; text-align: right; }
.claseprecio { padding-left: 10px; width: 85px; text-align: right; }
</style>

<?php include "top.php"; ?>
<?php include "header.php"; ?>

	<!--======= HOME MAIN SLIDER =========-->
	
  <section class="home-slider" id="home">
    <!-- Slider Loader -->
    <div id="loader" class="hom-slie">
      <div class="tp-loader spinner0"> <span class="dot1"></span> <span class="dot2"></span> <span class="bounce1"></span> <span class="bounce2"></span> <span class="bounce3"></span> </div>
    </div>
    
    <!-- SLIDE Start -->
    <div class="tp-banner-container">
      <div class="tp-banner">
        <ul>
				<?php
					$nomcat = "";
					$sql = "SELECT * FROM categorias c ORDER BY id_tipo_categoria, orden, nombre ";
					$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
					$total = mysqli_num_rows($rs);
					
					$isch = false;
					
					$ticat = 0;
					
					while($row = mysqli_fetch_array($rs)) {
						if ($idcategoria == $row["id_categoria"]) { $nomcat = $row["nombre"]; }
					}
					
					$imgcat = "17.jpg";
					if (file_exists("images/categories/" . $idcategoria . ".jpg")) {
						$imgcat = $idcategoria . ".jpg";
					}
					?>
					
          <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
            <!-- MAIN IMAGE -->
						
            <img src="images/categories/<?php echo $imgcat; ?>" alt="<?php echo $nomcat; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            
            <!-- LAYER NR. 1 -->
            <div class="tp-caption font-alex sft tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="bottom" data-voffset="-80" 
                data-speed="800" 
                data-start="800" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
								style="z-index: 7; font-size:60px; color:#01826c; max-width: auto; max-height: auto; white-space: nowrap; text-shadow: 2px 2px 1px #fff;"
                >Our Menu</div>
            
            <!-- LAYER NR. 2 -->
            <div class="tp-caption sfb font-josefin font-bold tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="bottom" data-voffset="0" 
                data-speed="800" 
                data-start="1200" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.07" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
								style="z-index: 6; font-size:80px; color:#fff; text-transform:uppercase; white-space: nowrap; text-shadow: 2px 2px 2px #000;"
                ><?php echo $nomcat; ?></div>
            
          </li>
          <?php 
					//echo "EXXXXX: " . "images/categories/" . $idcategoria . "a.jpg";
					if (file_exists("images/categories/" . $idcategoria . "a.jpg")) { ?>
					<li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="off" > 
            <!-- MAIN IMAGE -->
						
            <img src="images/categories/<?php echo $idcategoria . "a.jpg"; ?>" alt="<?php echo $nomcat; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            
            <!-- LAYER NR. 1 -->
            <div class="tp-caption font-alex sft tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="-80" 
                data-speed="800" 
                data-start="800" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                style="z-index: 7; font-size:60px; color:#01826c; max-width: auto; max-height: auto; white-space: nowrap; text-shadow: 2px 2px 1px #fff;"
								>Our Menu</div>
            
            <!-- LAYER NR. 2 -->
            <div class="tp-caption sfb font-josefin font-bold tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="0" 
                data-speed="800" 
                data-start="1200" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.07" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                style="z-index: 6; font-size:80px; color:#fff; text-transform:uppercase; white-space: nowrap; text-shadow: 2px 2px 2px #000;"
								><?php echo $nomcat; ?></div>
            
          </li>
					<?php } ?>
        </ul>
      </div>
    </div>
  </section>

  <!-- Content -->
  <div id="content"> 
    
    <!-- Pizza Menu -->
    <section class="pizza-menu tri-white-top padding-top-30 padding-bottom-100" id="our-menu" style="background: #030303;">
      <div class="container"> 
        
        <!-- Heading Block 
        <div class="heading text-center"> <span>Pleasure of Choice</span>
          <h3>Our Menu</h3>
          <hr />
          <i class="fa fa-bookmark-o"></i>
				</div>
				-->

				<div class=" text-center filters" style="margin-bottom: 20px;">
					<select id="categorias">
						<?php
						$nomcat = "";
						$subtitcat = "";
						$desccat = "";
						$catsize1 = "";
						$catsize2 = "";
						$catsize3 = "";
						$catsize4 = "";
						$sql = "SELECT * FROM categorias c ORDER BY id_tipo_categoria, orden, nombre ";
						$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
						$total = mysqli_num_rows($rs);
						
						$isch = false;
						
						$ticat = 0;
						
						while($row = mysqli_fetch_array($rs)) {
							/*
							if ($ticat != $row["id_tipo_categoria"]){
								if ($ticat > 0){
								}
								$ticat = $row["id_tipo_categoria"];
							}
							$chked = "";
							if (!$isch){
								$chked = "is-checked";
								$isch = true;
								$idcat = $row["id_categoria"];
							}
							*/
							if ($idcategoria == $row["id_categoria"]) {
								$nomcat = $row["nombre"];
								$subtitcat = $row["subtitulo"];
								$desccat = $row["descripcion"];
								$catsize1 = $row["title_size_1"];
								$catsize2 = $row["title_size_2"];
								$catsize3 = $row["title_size_3"];
								$catsize4 = $row["title_size_4"];
							}
							?>
							<option value="menu-<?php echo LimpiarURL($row["nombre"]); ?>_<?php echo $row["id_categoria"]; ?>" <?php if ($idcategoria == $row["id_categoria"]) { echo "selected"; } ?>><?php echo $row["nombre"]; ?></option>
							<?php
						}
						?>
					</select>
					
					<?php if ($subtitcat != "") { ?>
					<h6 style="color: #f5d389;"><?php echo $subtitcat . ". " . $desccat; ?></h6>
					<?php } ?>
					<!--
					-->
				</div>
				<!--
				<div class="heading text-center filters gridingred" style="margin-bottom: 20px;">
					<div class="button-group js-radio-button-group" data-filter-group="color">
						<button class="grid-item ingrediente button any" id="any" data-filter="any">any</button>
						<?php
						$sql = "SELECT i.* FROM ingredientes i ORDER BY i.nombre ";
						$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
						while($row = mysqli_fetch_array($rs)) {
							$clases = TraerCategoriasDeIngrediente($link, $row["id_ingrediente"]);
							?>
							<button class="grid-item ingrediente button <?php echo $clases; ?>" id="<?php echo ConvertirNombre($row["nombre"]); ?>" data-filter="<?php echo ConvertirNombre($row["nombre"]); ?>"><?php echo $row["nombre"]; ?></button>
							<?php
						}
						?>
					</div>
				</div>
				-->
        <!-- Flavours -->
				
        <ul class="pizza-flavers grid" style="background-image: url('images/ybg.jpg');">
				  <?php
					if ($catsize1 != "" || $catsize2 != "" || $catsize3 != "" || $catsize4 != ""){
						?>
						<li class="grid-item">
							<div class="media-body">
								<div class="menu-tittle col-md-6">
									<h5 style="color: #00816b;"></h5>
									<span></span>
								</div>
								
								<?php if ($catsize4 != "") { ?>
								<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
									<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize4; ?></div>
								</div>
								<?php } ?>
								<?php if ($catsize3 != "") { ?>
								<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
									<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize3; ?></div>
								</div>
								<?php } ?>
								<?php if ($catsize2 != "") { ?>
								<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
									<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize2; ?></div>
								</div>
								<?php } ?>
								<?php if ($catsize1 != "") { ?>
								<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
									<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize1; ?></div>
								</div>
								<?php } ?>
							</div>
						</li>
						<?php
					}
					
					$sql = "SELECT p.*, p.nombre AS prod, p.descripcion AS catdesc, c.* 
					FROM productos p 
					INNER JOIN categorias c ON c.id_categoria = p.id_categoria 
					WHERE p.id_categoria = " . $idcategoria . " ORDER BY p.orden, p.nombre ";
					
					$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
					while($row = mysqli_fetch_array($rs)) {
						echo CreateProductDiv($idcategoria, $row);
					}
					?>
        </ul>
				
				<?php if ($idcategoria == 10 || $idcategoria == 9 || $idcategoria == 21 || $idcategoria == 22 || $idcategoria == 15) {
				$sql = "SELECT c.* FROM categorias c WHERE c.id_categoria IN (9, 21, 22, 15, 10) AND c.id_categoria <> $idcategoria ORDER BY c.orden, c.nombre ";
				
				$rsCg = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
				while($rwCg = mysqli_fetch_array($rsCg)) {
					$subtitcat = $rwCg["subtitulo"];
					if ($subtitcat != "") $subtitcat .= ". ";
					$subtitcat .= $rwCg["descripcion"];
					
					if ($rwCg["id_categoria"] == 22){
						?>
						<div><img src="images/lunch-sub-deals.jpg" class="img-responsive" /></div>
						<?php
					}
				?>
				
				<div style="text-align:center; font-family: 'Miltonian Tattoo', cursive; font-size: 30px; background-color: #030303; color: #fff; margin-top: 30px;"><?php echo $rwCg["nombre"]; ?></div>
				<?php if ($subtitcat != "") { ?>
					<h6 style="color: #f5d389;text-align:center; "><?php echo $subtitcat; ?></h6>
				<?php } ?>
				<!-- Flavours -->
        <ul class="pizza-flavers grid" style="background-image: url('images/ybg.jpg'); margin-top: 30px;">
          <?php
					$catsize1 = $rwCg["title_size_1"];
					$catsize2 = $rwCg["title_size_2"];
					$catsize3 = $rwCg["title_size_3"];
					$catsize4 = $rwCg["title_size_4"];
					?>
					<li class="grid-item">
						<div class="media-body">
							<div class="menu-tittle col-md-6">
								<h5 style="color: #00816b;"></h5>
								<span></span>
							</div>
							<?php if ($catsize4 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize4; ?></div>
							</div>
							<?php } ?>
							<?php if ($catsize3 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize3; ?></div>
							</div>
							<?php } ?>
							<?php if ($catsize2 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize2; ?></div>
							</div>
							<?php } ?>
							<?php if ($catsize1 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize1; ?></div>
							</div>
							<?php } ?>
						</div>
					</li>
					<?php
					$sql = "SELECT p.*, p.nombre as prod, p.descripcion as catdesc, c.* 
					FROM productos p 
					INNER JOIN categorias c ON c.id_categoria = p.id_categoria 
					WHERE p.id_categoria = " . $rwCg["id_categoria"] . " ORDER BY p.orden, p.nombre ";
					
					$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
					while ($row = mysqli_fetch_array($rs)) {
						echo CreateProductDiv($idcategoria, $row);
					}
					?>
				</ul>
				<?php } ?>
			<?php } else if ($idcategoria == 3 || $idcategoria == 4 || $idcategoria == 5 || $idcategoria == 12 || $idcategoria == 31 ) {
				
				$sql = "SELECT c.* FROM categorias c WHERE c.id_categoria IN (3,4,5,12,31) AND c.id_categoria <> $idcategoria ORDER BY c.orden, c.nombre ";
				
				$rsCg = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
				while($rwCg = mysqli_fetch_array($rsCg)) {
					$subtitcat = $rwCg["subtitulo"];
					if ($subtitcat != "") $subtitcat .= ". ";
					$subtitcat .= $rwCg["descripcion"];
				?>
				
				<div style="text-align:center; font-family: 'Miltonian Tattoo', cursive; font-size: 30px; background-color: #030303; color: #fff; margin-top: 30px;"><?php echo $rwCg["nombre"]; ?></div>
				<?php if ($subtitcat != "") { ?>
					<h6 style="color: #f5d389;text-align:center; "><?php echo $subtitcat; ?></h6>
				<?php } ?>
				<!-- Flavours -->
        <ul class="pizza-flavers grid" style="background-image: url('images/ybg.jpg'); margin-top: 30px;">
          <?php
					$catsize1 = $rwCg["title_size_1"];
					$catsize2 = $rwCg["title_size_2"];
					$catsize3 = $rwCg["title_size_3"];
					$catsize4 = $rwCg["title_size_4"];
					?>
					<li class="grid-item">
						<div class="media-body">
							<div class="menu-tittle col-md-6">
								<h5 style="color: #00816b;"></h5>
								<span></span>
							</div>
							<?php if ($catsize4 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize4; ?></div>
							</div>
							<?php } ?>
							<?php if ($catsize3 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize3; ?></div>
							</div>
							<?php } ?>
							<?php if ($catsize2 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize2; ?></div>
							</div>
							<?php } ?>
							<?php if ($catsize1 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize1; ?></div>
							</div>
							<?php } ?>
						</div>
					</li>
					<?php
					$sql = "SELECT p.*, p.nombre as prod, p.descripcion as catdesc, c.* 
					FROM productos p 
					INNER JOIN categorias c ON c.id_categoria = p.id_categoria 
					WHERE p.id_categoria = " . $rwCg["id_categoria"] . " ORDER BY p.orden, p.nombre ";
					
					$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
					while ($row = mysqli_fetch_array($rs)) {
						echo CreateProductDiv($idcategoria, $row);
					}
					?>
				</ul>
				<?php } ?>
			<?php } ?>
				
				
				<?php
				
				// Si es de alguna de las categorias de pizza, meto al final los toppings
				
				if ($idcategoria == 3 || $idcategoria == 4 || $idcategoria == 5 || $idcategoria == 12 || $idcategoria == 1 || $idcategoria == 2 || $idcategoria == 31) { ?>
				
				<div style="text-align:center; font-family: 'Miltonian Tattoo', cursive; font-size: 30px; background-color: #030303; color: #fff; margin-top: 30px;">Toppings for Pizza</div>
				
				<!-- Flavours -->
        <ul class="pizza-flavers grid" style="background-image: url('images/ybg.jpg'); margin-top: 30px;">
          <?php
					$catsize1 = "10\"";
					$catsize2 = "12\"";
					$catsize3 = "14\"";
					$catsize4 = "16\"";
					if ($idcategoria < 3) {
						$catsize1 = "SMALL";
						$catsize2 = "";
						$catsize3 = "MEDIUM";
						$catsize4 = "LARGE";
					}
					?>
					<li class="grid-item">
						<div class="media-body">
							<div class="menu-tittle col-md-6">
								<h5 style="color: #00816b;"></h5>
								<span></span>
							</div>
							<?php if ($catsize4 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize4; ?></div>
							</div>
							<?php } ?>
							<?php if ($catsize3 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize3; ?></div>
							</div>
							<?php } ?>
							<?php if ($catsize2 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize2; ?></div>
							</div>
							<?php } ?>
							<?php if ($catsize1 != "") { ?>
							<div class="pizza-price prodtitles hidden-xs hidden-sm visible-md visible-lg">
								<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $catsize1; ?></div>
							</div>
							<?php } ?>
						</div>
					</li>
					<?php
					$sql = "SELECT p.*, p.nombre as prod, p.descripcion as catdesc, c.* 
					FROM productos p 
					INNER JOIN categorias c ON c.id_categoria = p.id_categoria 
					WHERE p.id_categoria = 6 ORDER BY p.orden, p.nombre ";
					
					$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
					while($row = mysqli_fetch_array($rs)) {
						echo CreateProductDiv($idcategoria, $row);
					}
					?>
        </ul>
				
				<?php } ?>
				
				
      </div>
    </section>

    <?php include "promobox.php"; ?>
    
		<?php include "contact.php"; ?>
		<?php include "map.php"; ?>
    
  </div>
	<?php include "footer.php"; ?>
	
</div>
<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/own-menu.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<!-- SLIDER REVOLUTION 4.x SCRIPTS  --> 
<script type="text/javascript" src="rs-plugin/js/jquery.tp.t.min.js"></script> 
<script type="text/javascript" src="rs-plugin/js/jquery.tp.min.js"></script> 
<script src="js/main.js"></script> 
<script src="js/lightbox.js"></script> 

<!-- Begin Map Script
<sc ript src="https://maps.googleapis.com/maps/api/js?v=3.exp"></scri pt> 
<sc ript src="js/map.js"></scri pt>
--> 
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {

	//$("#categorias").chosen({width: "600px"});

	var ultimacat = "alfredocalzones";
	var ultimoing = ["any"];
	
	var isIE = (navigator.appName == 'Microsoft Internet Explorer');
	$(document.body).on(isIE ? "click" : "change", "#categorias", function() { //click focus
		window.location.href = $(this).val();
		//alert( $(this).val() );
		//alert( $(this).find('option:selected').val() );
		//alert( this.valu );
	});
	/*
	function FiltrarIngredientes(categoria){
		//Busco los ingredientes de esa categoria
		$('.ingrediente').each( function( i, ing ) {
			var $ing = $( ing );
			if ($ing.attr("data-filter") == "any"){
				$ing.show();
				$ing.addClass('is-checked');
			} else {
				if ($ing.hasClass(categoria)){
					$ing.show();
					$ing.removeClass('is-checked');
				} else {
					$ing.hide();
					$ing.removeClass('is-checked');
				}
			}
		
		});
	}
	*/
	function CambiarCategoria(ultcat, nuecat){
		//Busco los ingredientes de esa categoria
		$('#'+ ultcat).removeClass('is-checked');
		$('#'+ nuecat).addClass('is-checked');
	}
	
	function ArrayExists(arr, it){
		for (i = 0; i < arr.length; i++) {
			if (it == arr[i]) return true;
		}
		return false;
	}
	/*
	function FiltrarProductos(categoria, ingredientes){
		//Busco los ingredientes de esa categoria
		//$('.producto').show();
		$(".cantfind").hide();
		$('.producto').each( function( i, prod ) {
			var $prod = $( prod );
			
			if ($prod.hasClass(categoria)){
				$prod.show("slow");
				if (ArrayExists(ingredientes, "any")){
					$prod.show("slow");
				} else {
					var iLen, i;
					iLen = ingredientes.length;
					for (i = 0; i < iLen; i++) {
						if ($prod.hasClass(ingredientes[i])){
							// $prod.show("slow");
						} else {
							$prod.hide();
						}
					}
				}
			} else {
				$prod.hide();
			}
		
		});
		if ($('.producto:visible').length == 0){
			$(".cantfind").show();
		}
	}
	*/
	
	//Click de categoria
	$('.categoria').on( 'click', function() {
		//Traigo el nombre de esta categoria
		var nuevacat = $(this).attr("data-filter");
		CambiarCategoria(ultimacat, nuevacat);

		ultimacat = nuevacat;
		ultimoing = ["any"];
		//FiltrarIngredientes(ultimacat);
		//FiltrarProductos(ultimacat, ultimoing);
	});
	
	//Click de ingrediente
	$('.ingrediente').on( 'click', function() {
		//Traigo el nombre de esta categoria
		var nuevoing = $(this).attr("data-filter");

		if (nuevoing == "any"){
			ultimoing = ["any"];
			$('.ingrediente').removeClass('is-checked');
			$("#any").addClass('is-checked');
		} else {
			if (ArrayExists(ultimoing, "any")){
				$("#"+nuevoing).addClass('is-checked');
				$("#any").removeClass('is-checked');
				ultimoing = [nuevoing];
			} else {
				if (ArrayExists(ultimoing, nuevoing)){
					//existe, lo saco
					$(this).removeClass('is-checked');
					var index = ultimoing.indexOf(nuevoing);
					if (index > -1) {
						ultimoing.splice(index, 1);
					}
					if (ultimoing.length == 0) {
						ultimoing = ["any"];
						$("#any").addClass('is-checked');
					}
				} else {
					$(this).addClass('is-checked');
					ultimoing.push(nuevoing);
				}
			}
		}
		//FiltrarProductos(ultimacat, ultimoing);
	});
	
	//FiltrarIngredientes(ultimacat);
	//FiltrarProductos(ultimacat, ultimoing);
	
});
</script>
<style>

/* ---- button ---- */

#categorias{
	text-align: left;
	font-family: 'Miltonian Tattoo', cursive;
	font-size: 30px;
	background-color: #030303;
	color: #fff;
}

.chosen-container-single .chosen-single {
	border: 1px solid #030303;
	
	background-color: #030303;
  background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #030303), color-stop(50%, #030303), color-stop(52%, #030303), color-stop(100%, #030303));
  background: -webkit-linear-gradient(top, #030303 20%, #030303 50%, #030303 52%, #030303 100%);
  background: -moz-linear-gradient(top, #030303 20%, #030303 50%, #030303 52%, #030303 100%);
  background: -o-linear-gradient(top, #030303 20%, #030303 50%, #030303 52%, #030303 100%);
  background: linear-gradient(top, #030303 20%, #030303 50%, #030303 52%, #030303 100%);
	box-shadow: 0 0 3px #030303 inset, 0 1px 1px rgba(3, 3, 3, 0.1);
}

.chosen-container-single .chosen-single span {
	background-color: #030303;
	color: #c00;
}
.chosen-single{
	background-color: #030303;
}
.chosen-container{
	font-family: "Miltonian Tattoo", cursive;
	font-size: 36px;
	background-color: #030303;
}

.button {
  display: inline-block;
  padding: 0.1em 1.0em;
  background: #EEE;
  border: none;
  border-radius: 7px;
  background-image: linear-gradient( to bottom, hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.2) );
  color: #222;
  font-family: sans-serif;
  font-size: 16px;
  text-shadow: 0 1px white;
  cursor: pointer;
}

.button:hover {
  background-color: #0ccab3;
  text-shadow: 0 1px hsla(0, 0%, 100%, 0.5);
  color: #fff;
}

.button:active,
.button.is-checked {
  background-color: #017f70;
}

.button.is-checked {
  color: white;
  text-shadow: 0 -1px hsla(0, 0%, 0%, 0.8);
}

.button:active {
  box-shadow: inset 0 1px 10px hsla(0, 0%, 0%, 0.8);
}

/* ---- button-group ---- */

.button-group:after {
  content: '';
  display: block;
  clear: both;
}

.button-group .button {
  float: left;
  border-radius: 0.5em;
  margin-left: 0;
  margin-right: 1px;
}
/*
.button-group .button:first-child { border-radius: 0.5em 0 0 0.5em; }
.button-group .button:last-child { border-radius: 0 0.5em 0.5em 0; }
*/
/* ---- isotope ---- */

.grid {
 
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ui group */

.ui-group {
  display: inline-block;
}

.ui-group h3 {
  display: inline-block;
  vertical-align: top;
  line-height: 32px;
  margin-right: 0.2em;
  font-size: 16px;
}

.ui-group .button-group {
  display: inline-block;
  margin-right: 20px;
}

/* color-shape */

.color-shape {
  width: 70px;
  height: 70px;
  margin: 5px;
  float: left;
}
 
.color-shape.round {
  border-radius: 35px;
}
 
.color-shape.big.round {
  border-radius: 75px;
}
 
.color-shape.red { background: red; }
.color-shape.blue { background: blue; }
.color-shape.yellow { background: yellow; }
 
.color-shape.wide, .color-shape.big { width: 150px; }
.color-shape.tall, .color-shape.big { height: 150px; }
</style>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>

<?php

function CreateProductDiv($idcategoria, $row){
	//si no tengo nombre me voy
	if ($row["prod"] == "") return;
	?>
	<!-- Pizza Flavours -->
	<li class="grid-item producto">
		
		<!-- Pizza Tittles -->
		<div class="media-body">
			<div class="menu-tittle col-md-6">
				<h5><?php echo $row["prod"]; ?></h5>
				<span><?php echo $row["catdesc"]; ?></span>
				<?php if ($idcategoria == 21) { // $eslunchspecial && ?>
				<span style="color:red; background-color:yellow;padding: 0 2px 0 2px;white-space: nowrap;">Mon-Sun 11am to 4pm / All hot half subs served with steak fries. Add a cup of soup for $2.50</span>
				<?php } ?>
				<?php if ($idcategoria == 22) { // $eslunchspecial && ?>
				<span style="color:red; background-color:yellow;padding: 0 2px 0 2px;white-space: nowrap;">Mon-Sun 11am to 4pm / All cold half subs served with our garlicky pasta salad. Add a cup of soup for $2.50</span>
				<?php } ?>
				<?php if ($row["nuevo"] > 0) { ?>
				<!-- span style="color:red; background-color:yellow;padding: 0 2px 0 2px;white-space: nowrap;">new</span -->
				<?php } ?>
				<?php if ($row["special_offer"] > 0 && false) { ?>
				<span style="color:yellow; background-color:red;padding: 0 2px 0 2px;white-space: nowrap;">special offer</span>
				<?php } ?>
				<?php if ($row["can_serve_2"] > 0 && false) { ?>
				<span style="color:white;background-color:red;padding: 0 2px 0 2px;white-space: nowrap;">can serve 2</span>
				<?php } ?>
				<?php if ($row["huge_portions"] > 0 && false) { ?>
				<span style="color:white;background-color:green;padding: 0 2px 0 2px;white-space: nowrap;">huge portions</span>
				<?php } ?>
				<?php if ($row["dinning_room"] > 0 && false) { ?>
				<span style="color:white;background-color:purple;padding: 0 2px 0 2px;white-space: nowrap;">dine in only</span>
				<?php } ?>
				<?php if ($row["dine_in_take_out"] > 0 && false) { ?>
				<span style="color:white;background-color:black;padding: 0 2px 0 2px;white-space: nowrap;">dine in / take out</span>
				<?php } ?>
				<?php if ($row["small_by_request"] > 0) { ?>
				<!-- <span style="color:white;background-color:blue;padding: 0 2px 0 2px;white-space: nowrap;">smaller version available</span> -->
				<?php } ?>
			</div>
			<!-- Pizza Price -->
			<?php if ($row["size_4"] != "" && $row["size_4"] > 0) {
				$titulo = $row["tit_size_4"];
				if ($row["tit_size_4"] == ""){
					$titulo = $row["title_size_4"];
				}
				?>
			<div class="pizza-price claseprecio">
				<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;" class="visible-xs visible-sm hidden-md hidden-lg" ><?php echo $titulo; ?></div>
				$<?php echo $row["size_4"]; ?>
			</div>
			<?php } else if ($row["tit_size_4"] != "" || $row["title_size_4"] != "") { ?>
			<div class="pizza-price claseprecio">
				<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;" class="visible-xs visible-sm hidden-md hidden-lg" ></div>--
			</div>
			<?php } ?>
			<?php if ($row["size_3"] != "" && $row["size_3"] > 0) {
				$titulo = $row["tit_size_3"];
				if ($row["tit_size_3"] == ""){
					$titulo = $row["title_size_3"];
				}
				?>
			<div class="pizza-price claseprecio">
				<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;" class="visible-xs visible-sm hidden-md hidden-lg" ><?php echo $titulo; ?></div>
				$<?php echo $row["size_3"]; ?>
			</div>
			<?php } else if ($row["tit_size_3"] != "" || $row["title_size_3"] != "") { ?>
			<div class="pizza-price claseprecio">
				<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;" class="visible-xs visible-sm hidden-md hidden-lg" ></div>--
			</div>
			<?php } ?>
			<?php if ($row["size_2"] != "" && $row["size_2"] > 0) {
				$titulo = $row["tit_size_2"];
				if ($row["tit_size_2"] == ""){
					$titulo = $row["title_size_2"];
				}
				?>
			<div class="pizza-price claseprecio">
				<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;" class="visible-xs visible-sm hidden-md hidden-lg" ><?php echo $titulo; ?></div>
				$<?php echo $row["size_2"]; ?>
			</div>
			<?php } else if ($row["tit_size_2"] != "" || $row["title_size_2"] != "") { ?>
			<div class="pizza-price claseprecio">
				<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;" class="visible-xs visible-sm hidden-md hidden-lg" ></div>--
			</div>
			<?php } ?>
			<?php
			if ($row["size_1"] != "" && $row["size_1"] > 0) {
				$titulo = $row["tit_size_1"];
				if ($row["tit_size_1"] == ""){
					$titulo = $row["title_size_1"];
				}
				?>
			<div class="pizza-price claseprecio">
				<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;" class="visible-xs visible-sm hidden-md hidden-lg" ><?php echo $titulo; ?></div>
				$<?php echo $row["size_1"]; ?>
			</div>
			<?php } else if ($row["tit_size_1"] != "" || $row["title_size_1"] != "") { ?>
			<div class="pizza-price claseprecio">
				<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;" class="visible-xs visible-sm hidden-md hidden-lg" ></div>--
			</div>
			<?php } ?>
		</div>
	</li>
	<?php
}

?>