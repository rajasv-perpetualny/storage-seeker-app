<div id="ad_penske" rel="tooltip" title="<? //=$siteBrandName?> customers save 10% on Penske truck rentals. Save an additional 10% on one-way rentals when you book online.">
    <h2 class="penske-rental-header-small"><img src="/storage/images/penske-logo.gif" alt="Penske" /><br /> Truck<br /> Rental</h2>
    <p><?=$unit->facility->name ?> rents Penske trucks at its facility.<br /><? (config('site.' . config('domain'). 'brandName')) ?> customers save 10%.<br /><a class="btn btn-primary" href="#penske-modal" data-toggle="modal">Rent Truck</a></p>
    <img id="ad_penske_pixel" src="<?='/_ad/i?pt=mid&tag=penske&pu='.urlencode("/{{config('domain')}}/unit/".$unit->space->spaceId).'&fid='.$unit->facility->id ?>" height="1" width="1" alt="" class="tracking-pixel" />
</div>
<form id="penske-modal" class="modal fade" action="{{config('host')}}/out/penske" method="get" target="_blank">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&#215;</button>
                <h4 class="modal-title">Rent a Truck</h4>
            </div>
            <div class="modal-body">
            <p><?=$unit->facility->name?> offers Penske truck rentals at their facility. <?=(config('site.' . config('domain'). 'brandName'))?> customers get 10% off all truck rentals and an additional 10% off one-way truck rentals.</p>
            <img src="/storage/images/pensketruck.jpg" alt="photo of Penske truck" style="float:right;" />
        
                <div id="penske-rental-type">
                
                    <div class="controls">
                        <label for="penske-rental-type-local" class="radio"><input type="radio" name="type" id="penske-rental-type-local" value="local" checked="checked" /> <strong>Local</strong></label>
                        <span style="color:#999;">Same pick-up/drop-off location</span>
                    </div>
                    <br />
                    
                    <div class="controls">
                        <label for="penske-rental-type-one-way" class="radio"><input type="radio" name="type" id="penske-rental-type-one-way" value="one-way" /> <strong>One-way</strong></label>
                        <span style="color:#999;">Different pick-up/drop-off location</span>
                    </div>
                    <br />
                </div>
                <div id="penske-pick-up-zip-code" class="hide">
                    <label><strong>Pick-Up Zip Code</strong></label><input type="text" name="zip" value="<?=$unit->facility->zip?>" />
                    <br /><br />
                </div>
                <label><strong>Pick-Up Date</strong></label><input type="text" name="date" min="<?=date('Y-m-d', strtotime('+1 day'))?>" max="<?=date('Y-m-d', strtotime('+180 day'))?>" value="<?=date('m/d/Y', time()+(60*60*24)) ?>" autocomplete="off" placeholder="MM/DD/YYYY" />
                
                <p>For same-day rentals and/or to reserve by phone, please call 888-622-6894.<br />Mention 'SpareFoot' to get a 10% discount</p>
            </div>
            <div class="modal-footer">
                <a href="" data-dismiss="modal" class="btn">Cancel</a>
                <input type="submit" class="btn btn-primary" value="Go to Penske Truck Rental" />
            </div>
        </div>
    </div>
</form>