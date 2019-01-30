<? if($unit->space->promotion) { ?>
    <p class="deal-text highlight"><?=$unit->space->promotion ?></p>
<? } ?>
<? if($unit->facility->showPhoneNumber) { ?>
<p class="deal-addendum">Reserve a storage unit online or call 
{{$unit->facility->trackedPhoneNumber}}
<?=($unit->space->promotion)?' to get this online special':'';?>.</p>
<? } ?>