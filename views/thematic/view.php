<?php include ROOT . '/views/layouts/header.php'; ?>

<main>
	<div class="mainWrap mainWrapAkcii container row toSpaceBetween">
	<?php include ROOT . '/views/layouts/sidebar.php'; ?>
		<div class="content akciiDesc">
			<h1 class="headerContent"><?php echo $thematic['name'];?></h1>
			<div class="akciiContent">
				<img src="<?php echo Product::getThematicImage($thematic['id']); ?>" alt="<?php echo $thematic['name']?>">
			</div>
			<div class="ContentDescPromo">
			<?php 
            $products = Product::getProdustsByIds(array_keys(json_decode($thematic['products'], true)));
            foreach ($products as $product):
            ?>
        		<div class="ContentDescPromoBlock" data-id="<?php echo $product['id']?>">
        			<img class="cartPaymentBlockMiscImg" src="<?php echo Product::getImage($product['id']); ?>" alt="<?php echo $product['name']; ?>">
					<div class="ContentDescPromoBlockHeader"><?php echo $product['name'];?></div>
					<div class="ContentDescPromoBlockDesc"><?php echo $product['description']; ?></div>
					<input type="hidden" value="<?php echo $product['price']?>">
				</div>
        	<?php endforeach;?>
				<div class="ContentDescPromoBlock1 ">
					<div class="ContentDescPromoBlockTocartThematic">
						<span>Заказать</span>
					</div>
				</div>
			</div>
			<div class="headerContent howItworks"><?php echo $thematic['name']?></div>
			<span class="headerContentDesc"><?php echo $thematic['description']?></span>
		</div>
	</div>
</main>

<?php include ROOT . '/views/layouts/footer.php'; ?>	