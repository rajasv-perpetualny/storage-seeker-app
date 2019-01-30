<div id="slideshow" class="carousel slide">
    <ol class="carousel-indicators">
        <?
        $i = 0;
        foreach($facilityImages as $image){
        ?>
        <li data-target="#slideshow" data-slide-to="{{$i}}"<?=($i==0)?' class="active"':''?>></li>
        <?
        $i++;
        }
        ?>
    </ol>

    <div class="carousel-inner">
        <?
        $i = 0;
        foreach($facilityImages as $image){
        $i++;
        ?>
        <div class="item{{($i==1)?' active':''}}">
            <img itemprop="photo<?=($i==1) ? ' logo' : '' ?>" src="{{str_replace("medium", "large", $image)}}" alt="Photo {{$i}}">
        </div>
        <? } ?>
    </div>
    <a class="left carousel-control" href="#slideshow" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#slideshow" data-slide="next">
        <span class="icon-next"></span>
    </a>
</div>

