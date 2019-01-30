<? if($unit->facility->description){ ?>
    <h4>About <?=$unit->facility->name?></h4>
    <p class="expandable" itemprop="description"><?=nl2br($unit->facility->description)?></p>
<? } ?>