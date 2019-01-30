<div id="slideshow" class="carousel slide">
    <ol class="carousel-indicators">
        <?php
        $i = 0;
        foreach($unit->facility->images as $image) {
    ?>
            <li data-target="#slideshow" data-slide-to="<?=$i?>"<?=($i==0)?' class="active"':''?>></li>
    <? 
            $i++;
        } 
    ?>
    </ol>
    <div class="carousel-inner">
<?
$i = 0;
foreach($unit->facility->images as $image){
    $i++;
    ?>
    <div class="item<?=($i==1)?' active':''?>">
<img src="{{$image}}" alt="<?=$unit->facility->name ?> - Photo <?=$i?>">
</div>
<?php } ?>
</div>

<a class="left carousel-control" href="#slideshow" data-slide="prev">
<span class="icon-prev"></span>
</a>
<a class="right carousel-control" href="#slideshow" data-slide="next">
<span class="icon-next"></span>
</a>
</div>