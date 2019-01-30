<?php
//only show the office hours table if there is an entry available
if (is_array($unit->facility->officeHours)) {

 //TODO doesn't come but it is parseable. $openingHoursString = "Su ".date("G:i", strtotime($officeHours->getSunStart()))."-".date("G:i", strtotime($officeHours->getSunEnd())).", Mo ".date("G:i", strtotime($officeHours->getMonStart()))."-".date("G:i", strtotime($officeHours->getMonEnd())).", Tu ".date("G:i", strtotime($officeHours->getTueStart()))."-".date("G:i", strtotime($officeHours->getTueEnd())).", We ".date("G:i", strtotime($officeHours->getWedStart()))."-".date("G:i", strtotime($officeHours->getWedEnd())).", Th ".date("G:i", strtotime($officeHours->getThuStart()))."-".date("G:i", strtotime($officeHours->getThuEnd())).", Fr ".date("G:i", strtotime($officeHours->getFriStart()))."-".date("G:i", strtotime($officeHours->getFriEnd())).", Sa  ".date("G:i", strtotime($officeHours->getSatStart()))."-".date("G:i", strtotime($officeHours->getSatEnd()));
?>
    <div itemprop="openingHours" datetime="<? //=$openingHoursString ?>" class="facility-hours">
    <h2>Hours</h2>
        <h4>Office Hours</h4>
        <table class="hours">
            @foreach($unit->facility->officeHours as $oneOf)
            <tr>
                <th>{{strtolower(substr($oneOf, 0, 3))}}</th>
                <td>{{strtolower(substr($oneOf, 5, strlen($oneOf) - 5))}}</td>
            </tr>
            @endforeach
        </table>
    </div>
<?php
}

if (is_array($unit->facility->officeHours)) {
?>
    <div class="facility-hours">
        <h4>Access Hours</h4>
        <table class="hours">
            @foreach($unit->facility->officeHours as $oneOf)                       
            <tr>                                                                   
                <th>{{strtolower(substr($oneOf, 0, 3))}}</th>                      
                <td>{{strtolower(substr($oneOf, 5, strlen($oneOf) - 5))}}</td>     
            </tr>                                                                  
            @endforeach
        </table>
    </div>
<?php
}
?>