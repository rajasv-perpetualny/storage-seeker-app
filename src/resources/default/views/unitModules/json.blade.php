<?
$unitTypes = array();
$unitSets = array();
$unitInfo = array();
/*
foreach ($facility->getStorageClasses() as $storageClass) {
    $unitSetTitle = 'units_' . str_replace(array("/", "'", ' '), array('','', '_'), $storageClass->getLabel());

    $unitTypes[] = array(
        'unitSet'     => $unitSetTitle,
        'type'        => $storageClass->getLabel(),
        'description' => $storageClass->getDescription(),
        'minPrice'    => $storageClass->getCheapestSpace()->getEffectivePrice(),
        'icon'        => $this->url->cdnUrl('images/global/size-guide/'.$storageClass->getImage().'-thumb.png')
    );

    $unitSets[$unitSetTitle] = array();

    foreach ($storageClass->getSpaces() as $space) {
        $unitSets[$unitSetTitle][] = (int)$space->getId();

        $unitInfo[$space->getId()] = array(
            'id'          => (int)$space->getId(),
            'dimensions'  => $space->stringDimensions(),
            'amenities'   => $space->stringAmenities(),
            'price'       => $space->getEffectivePrice(),
            'maxBookDays' => (int)$space->getMaxBookDays(),
            'icon'        => $this->url->cdnUrl('images/global/size-guide/'.$storageClass->getImage().'-thumb.png'),
            'url'         => $this->url->unitDetailsUrl($space)
        );
    }   
}

*/

?>

<script type="text/javascript">
    /* JSON for listings */
    var unitTypes = <?=json_encode($unitTypes)?>;
    var unitSets = <?=json_encode($unitSets)?>;
    var unitInfo = <?=json_encode($unitInfo)?>;
</script>
