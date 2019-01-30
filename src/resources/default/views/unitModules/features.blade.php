<?php if (is_array($unit->facility->amenities)) { ?>
        
    <h4>Features</h4>
    <div id="amenities">
        <ul>
        <?php foreach ($unit->facility->amenities as $amenity) { ?>
            <li><?=$amenity?></li>
        <?php } ?>
        </ul>
    </div>
    
<?php } ?>