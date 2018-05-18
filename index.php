<?php
include('includes/db.php');
include('functions/functions.php');
include('includes/header.php');
?>
<!-- banner -->
	<div class="banner">
		<div class="container">
			<div class="banner-info animated wow zoomIn" data-wow-delay=".5s">
				<h3>Free Online Shopping</h3>
				<h4>Up to <span>50% <i>Off/-</i></span></h4>
				<div class="wmuSlider example1">
					<div class="wmuSliderWrapper">
						<article style="position: absolute; width: 100%; opacity: 0;"> 
							<div class="banner-wrap">
								<div class="banner-info1">
									<p>T-Shirts + Formal Pants + Jewellery</p>
								</div>
							</div>
						</article>
						<article style="position: absolute; width: 100%; opacity: 0;"> 
							<div class="banner-wrap">
								<div class="banner-info1">
									<p>Toys + Furniture + Lighting + Watches</p>
								</div>
							</div>
						</article>
						<article style="position: absolute; width: 100%; opacity: 0;"> 
							<div class="banner-wrap">
								<div class="banner-info1">
									<p>Tops + Books & Media + Sports</p>
								</div>
							</div>
						</article>
					</div>
				</div>
					<script src="js/jquery.wmuSlider.js"></script> 
					<script>
						$('.example1').wmuSlider();         
					</script> 
			</div>
		</div>
	</div>
<!-- //banner -->

<div class="products">
	<div class="container">
		<div class="col-md-4 products-left">
			<div class="categories animated wow slideInUp" data-wow-delay=".5s">
				<h3>Categories</h3>
				<ul class="cate">
					<?php getCategories(); ?>
				</ul>
			</div>
			<div class="categories animated wow slideInUp" data-wow-delay=".5s">
				<h3>Brands</h3>
				<ul class="cate">
					<?php getBrands(); ?>
				</ul>
			</div>
		</div>
		<div class="col-md-8 products-right">
			<div class="products-right-grids-bottom">
				<?php addToCart(); ?>
				<?php getProducts(); ?>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>

<?php include('includes/footer.php'); ?>