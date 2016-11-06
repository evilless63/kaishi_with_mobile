<div class="sidebar">
                <div class="productMenu">
                    <div class="productMenuHeader">Меню</div>
                    <ul>
                    <?php 
                    $arrayAclass = array('sushi', 'inari', 'rolls', 'hotrolls', 'set', 'gunkan', 'zakuski', 'pizza', 'drink');
                    $count = 0;
                    foreach ($categories as $categoryItem): ?>
                        <li>
                        <a class="<?php echo $arrayAclass[$count]; ?>" href="/category/<?php echo $categoryItem['id']; ?>"
                                           class="<?php if ($categoryId == $categoryItem['id']) echo 'catalogActive'; ?>">                                                                                    
                               <?php echo $categoryItem['name']; ?>
                        </a>
                        </li>
                    <?php 
                    $count++ ;   
                    endforeach; ?>   
                    </ul>
                </div>
                <div class="themeSets">
                    <div class="themeSetsHeader">
                        <a href="/thematic">Тематические наборы</a>
                    </div>
                    <?php foreach ($thematicCategories as $thematicItem): ?>
                    <div class="themeSetsBlock">
                        <div class="themeSetsBlockHeader">
                            <a href="/thematicItem/<?php echo $thematicItem['id']?>"><?php echo $thematicItem['name']?></a>
                        </div>
                        <a href="/thematicItem/<?php echo $thematicItem['id']?>" class="themeSetsBlockImage">
                            <div class="themeSetsBlockImageCover">
                                <span>Купить</span>
                            </div>
                            <img class="sidebarThematicImage" src="<?php echo Product::getThematicImage($thematicItem['id']); ?>" alt="<?php echo $thematicItem['name']?>">
                            <!-- <p><?php echo $thematicItem['cost']?></p> -->
                        </a>
                        <p class="themeSetsBlockDesc">
                            <?php echo mb_strimwidth($thematicItem['description'], 0, 65, "...");?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>