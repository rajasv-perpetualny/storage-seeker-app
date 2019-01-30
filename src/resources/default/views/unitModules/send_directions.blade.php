<? if(isset($unit->facility->canShowSms)){ ?>

<div class="facility-directions">
    <a data-toggle="modal" href="#directions-modal" class="btn btn-success">Send Directions To My Phone</a>
    <div class="clear"></div>
</div>

<form id="directions-modal" method="post" action="<?=url('_unit/directions')?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&#215;</button>
                <h4 class="modal-title">Send directions</h4>
            </div>
            <div class="modal-body form-horizontal">
                <p>Enter your phone number or email address to have directions sent to your phone.</p>
                
                <div class="control-group">
                    <label class="control-label">First Name</label>
                    <div class="controls">
                        <input type="text" name="first_name" />
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Last Name</label>
                    <div class="controls">
                        <input type="text" name="last_name" />
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Mobile Phone Number or Email Address</label>
                    <div class="controls">
                        <input type="text" name="phone_or_email" />
                    </div>
                </div>
            
                <p>We will never call you or share your phone number or email address. EVER.</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="unit_id" value="<?=$unit->getId()?>" />
                <img src="<?=$this->url->cdnUrl('images/global/loaders/small.gif')?>" width="16" height="16" alt="loading" class="hide" id="directions-modal-loading" />&nbsp;
                <a data-dismiss="modal" class="btn">Cancel</a>
                <input id="directions-submit" type="submit" value="Send Directions" class="btn btn-primary" />
            </div>
        </div>
    </div>
</form>

<? } ?>