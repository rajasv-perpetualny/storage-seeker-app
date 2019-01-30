var markerType = "search";
function inherits(childCtor,parentCtor){function tempCtor(){};tempCtor.prototype=parentCtor.prototype;childCtor.superClass_=parentCtor.prototype;childCtor.prototype=new tempCtor();childCtor.prototype.constructor=childCtor;}
function MarkerLabel_(marker,crossURL,handCursorURL){this.marker_=marker;this.handCursorURL_=marker.handCursorURL;this.labelDiv_=document.createElement("div");this.labelDiv_.style.cssText="position: absolute; overflow: hidden;";this.eventDiv_=document.createElement("div");this.eventDiv_.style.cssText=this.labelDiv_.style.cssText;this.eventDiv_.setAttribute("onselectstart","return false;");this.eventDiv_.setAttribute("ondragstart","return false;");this.crossDiv_=MarkerLabel_.getSharedCross(crossURL);}
inherits(MarkerLabel_,google.maps.OverlayView);MarkerLabel_.getSharedCross=function(crossURL){var div;if(typeof MarkerLabel_.getSharedCross.crossDiv==="undefined"){div=document.createElement("img");div.style.cssText="position: absolute; z-index: 1000002; display: none;";div.style.marginLeft="-8px";div.style.marginTop="-9px";div.src=crossURL;MarkerLabel_.getSharedCross.crossDiv=div;}
    return MarkerLabel_.getSharedCross.crossDiv;};MarkerLabel_.prototype.onAdd=function(){var me=this;var cMouseIsDown=false;var cDraggingLabel=false;var cSavedZIndex;var cLatOffset,cLngOffset;var cIgnoreClick;var cRaiseEnabled;var cStartPosition;var cStartCenter;var cRaiseOffset=20;var cDraggingCursor="url("+this.handCursorURL_+")";var cAbortEvent=function(e){if(e.preventDefault){e.preventDefault();}
    e.cancelBubble=true;if(e.stopPropagation){e.stopPropagation();}};var cStopBounce=function(){me.marker_.setAnimation(null);};this.getPanes().overlayImage.appendChild(this.labelDiv_);this.getPanes().overlayMouseTarget.appendChild(this.eventDiv_);if(typeof MarkerLabel_.getSharedCross.processed==="undefined"){this.getPanes().overlayImage.appendChild(this.crossDiv_);MarkerLabel_.getSharedCross.processed=true;}
    this.listeners_=[google.maps.event.addDomListener(this.eventDiv_,"mouseover",function(e){if(me.marker_.getDraggable()||me.marker_.getClickable()){this.style.cursor="pointer";google.maps.event.trigger(me.marker_,"mouseover",e);}}),google.maps.event.addDomListener(this.eventDiv_,"mouseout",function(e){if((me.marker_.getDraggable()||me.marker_.getClickable())&&!cDraggingLabel){this.style.cursor=me.marker_.getCursor();google.maps.event.trigger(me.marker_,"mouseout",e);}}),google.maps.event.addDomListener(this.eventDiv_,"mousedown",function(e){cDraggingLabel=false;if(me.marker_.getDraggable()){cMouseIsDown=true;this.style.cursor=cDraggingCursor;}
        if(me.marker_.getDraggable()||me.marker_.getClickable()){google.maps.event.trigger(me.marker_,"mousedown",e);cAbortEvent(e);}}),google.maps.event.addDomListener(document,"mouseup",function(mEvent){var position;if(cMouseIsDown){cMouseIsDown=false;me.eventDiv_.style.cursor="pointer";google.maps.event.trigger(me.marker_,"mouseup",mEvent);}
        if(cDraggingLabel){if(cRaiseEnabled){position=me.getProjection().fromLatLngToDivPixel(me.marker_.getPosition());position.y+=cRaiseOffset;me.marker_.setPosition(me.getProjection().fromDivPixelToLatLng(position));try{me.marker_.setAnimation(google.maps.Animation.BOUNCE);setTimeout(cStopBounce,1406);}catch(e){}}
            me.crossDiv_.style.display="none";me.marker_.setZIndex(cSavedZIndex);cIgnoreClick=true;cDraggingLabel=false;mEvent.latLng=me.marker_.getPosition();google.maps.event.trigger(me.marker_,"dragend",mEvent);}}),google.maps.event.addListener(me.marker_.getMap(),"mousemove",function(mEvent){var position;if(cMouseIsDown){if(cDraggingLabel){mEvent.latLng=new google.maps.LatLng(mEvent.latLng.lat()-cLatOffset,mEvent.latLng.lng()-cLngOffset);position=me.getProjection().fromLatLngToDivPixel(mEvent.latLng);if(cRaiseEnabled){me.crossDiv_.style.left=position.x+"px";me.crossDiv_.style.top=position.y+"px";me.crossDiv_.style.display="";position.y-=cRaiseOffset;}
        me.marker_.setPosition(me.getProjection().fromDivPixelToLatLng(position));if(cRaiseEnabled){me.eventDiv_.style.top=(position.y+cRaiseOffset)+"px";}
        google.maps.event.trigger(me.marker_,"drag",mEvent);}else{cLatOffset=mEvent.latLng.lat()-me.marker_.getPosition().lat();cLngOffset=mEvent.latLng.lng()-me.marker_.getPosition().lng();cSavedZIndex=me.marker_.getZIndex();cStartPosition=me.marker_.getPosition();cStartCenter=me.marker_.getMap().getCenter();cRaiseEnabled=me.marker_.get("raiseOnDrag");cDraggingLabel=true;me.marker_.setZIndex(1000000);mEvent.latLng=me.marker_.getPosition();google.maps.event.trigger(me.marker_,"dragstart",mEvent);}}}),google.maps.event.addDomListener(document,"keydown",function(e){if(cDraggingLabel){if(e.keyCode===27){cRaiseEnabled=false;me.marker_.setPosition(cStartPosition);me.marker_.getMap().setCenter(cStartCenter);google.maps.event.trigger(document,"mouseup",e);}}}),google.maps.event.addDomListener(this.eventDiv_,"click",function(e){if(me.marker_.getDraggable()||me.marker_.getClickable()){if(cIgnoreClick){cIgnoreClick=false;}else{google.maps.event.trigger(me.marker_,"click",e);cAbortEvent(e);}}}),google.maps.event.addDomListener(this.eventDiv_,"dblclick",function(e){if(me.marker_.getDraggable()||me.marker_.getClickable()){google.maps.event.trigger(me.marker_,"dblclick",e);cAbortEvent(e);}}),google.maps.event.addListener(this.marker_,"dragstart",function(mEvent){if(!cDraggingLabel){cRaiseEnabled=this.get("raiseOnDrag");}}),google.maps.event.addListener(this.marker_,"drag",function(mEvent){if(!cDraggingLabel){if(cRaiseEnabled){me.setPosition(cRaiseOffset);me.labelDiv_.style.zIndex=1000000+(this.get("labelInBackground")?-1:+1);}}}),google.maps.event.addListener(this.marker_,"dragend",function(mEvent){if(!cDraggingLabel){if(cRaiseEnabled){me.setPosition(0);}}}),google.maps.event.addListener(this.marker_,"position_changed",function(){me.setPosition();}),google.maps.event.addListener(this.marker_,"zindex_changed",function(){me.setZIndex();}),google.maps.event.addListener(this.marker_,"visible_changed",function(){me.setVisible();}),google.maps.event.addListener(this.marker_,"labelvisible_changed",function(){me.setVisible();}),google.maps.event.addListener(this.marker_,"title_changed",function(){me.setTitle();}),google.maps.event.addListener(this.marker_,"labelcontent_changed",function(){me.setContent();}),google.maps.event.addListener(this.marker_,"labelanchor_changed",function(){me.setAnchor();}),google.maps.event.addListener(this.marker_,"labelclass_changed",function(){me.setStyles();}),google.maps.event.addListener(this.marker_,"labelstyle_changed",function(){me.setStyles();})];};MarkerLabel_.prototype.onRemove=function(){var i;this.labelDiv_.parentNode.removeChild(this.labelDiv_);this.eventDiv_.parentNode.removeChild(this.eventDiv_);for(i=0;i<this.listeners_.length;i++){google.maps.event.removeListener(this.listeners_[i]);}};MarkerLabel_.prototype.draw=function(){this.setContent();this.setTitle();this.setStyles();};MarkerLabel_.prototype.setContent=function(){var content=this.marker_.get("labelContent");if(typeof content.nodeType==="undefined"){this.labelDiv_.innerHTML=content;this.eventDiv_.innerHTML=this.labelDiv_.innerHTML;}else{this.labelDiv_.innerHTML="";this.labelDiv_.appendChild(content);content=content.cloneNode(true);this.eventDiv_.appendChild(content);}};MarkerLabel_.prototype.setTitle=function(){this.eventDiv_.title=this.marker_.getTitle()||"";};MarkerLabel_.prototype.setStyles=function(){var i,labelStyle;this.labelDiv_.className=this.marker_.get("labelClass");this.eventDiv_.className=this.labelDiv_.className;this.labelDiv_.style.cssText="";this.eventDiv_.style.cssText="";labelStyle=this.marker_.get("labelStyle");for(i in labelStyle){if(labelStyle.hasOwnProperty(i)){this.labelDiv_.style[i]=labelStyle[i];this.eventDiv_.style[i]=labelStyle[i];}}
    this.setMandatoryStyles();};MarkerLabel_.prototype.setMandatoryStyles=function(){this.labelDiv_.style.position="absolute";this.labelDiv_.style.overflow="hidden";if(typeof this.labelDiv_.style.opacity!=="undefined"&&this.labelDiv_.style.opacity!==""){this.labelDiv_.style.MsFilter="\"progid:DXImageTransform.Microsoft.Alpha(opacity="+(this.labelDiv_.style.opacity*100)+")\"";this.labelDiv_.style.filter="alpha(opacity="+(this.labelDiv_.style.opacity*100)+")";}
    this.eventDiv_.style.position=this.labelDiv_.style.position;this.eventDiv_.style.overflow=this.labelDiv_.style.overflow;this.eventDiv_.style.opacity=0.01;this.eventDiv_.style.MsFilter="\"progid:DXImageTransform.Microsoft.Alpha(opacity=1)\"";this.eventDiv_.style.filter="alpha(opacity=1)";this.setAnchor();this.setPosition();this.setVisible();};MarkerLabel_.prototype.setAnchor=function(){var anchor=this.marker_.get("labelAnchor");this.labelDiv_.style.marginLeft=-anchor.x+"px";this.labelDiv_.style.marginTop=-anchor.y+"px";this.eventDiv_.style.marginLeft=-anchor.x+"px";this.eventDiv_.style.marginTop=-anchor.y+"px";};MarkerLabel_.prototype.setPosition=function(yOffset){var position=this.getProjection().fromLatLngToDivPixel(this.marker_.getPosition());if(typeof yOffset==="undefined"){yOffset=0;}
    this.labelDiv_.style.left=Math.round(position.x)+"px";this.labelDiv_.style.top=Math.round(position.y-yOffset)+"px";this.eventDiv_.style.left=this.labelDiv_.style.left;this.eventDiv_.style.top=this.labelDiv_.style.top;this.setZIndex();};MarkerLabel_.prototype.setZIndex=function(){var zAdjust=(this.marker_.get("labelInBackground")?-1:+1);if(typeof this.marker_.getZIndex()==="undefined"){this.labelDiv_.style.zIndex=parseInt(this.labelDiv_.style.top,10)+zAdjust;this.eventDiv_.style.zIndex=this.labelDiv_.style.zIndex;}else{this.labelDiv_.style.zIndex=this.marker_.getZIndex()+zAdjust;this.eventDiv_.style.zIndex=this.labelDiv_.style.zIndex;}};MarkerLabel_.prototype.setVisible=function(){if(this.marker_.get("labelVisible")){this.labelDiv_.style.display=this.marker_.getVisible()?"block":"none";}else{this.labelDiv_.style.display="none";}
    this.eventDiv_.style.display=this.labelDiv_.style.display;};function MarkerWithLabel(opt_options){opt_options=opt_options||{};opt_options.labelContent=opt_options.labelContent||"";opt_options.labelAnchor=opt_options.labelAnchor||new google.maps.Point(0,0);opt_options.labelClass=opt_options.labelClass||"markerLabels";opt_options.labelStyle=opt_options.labelStyle||{};opt_options.labelInBackground=opt_options.labelInBackground||false;if(typeof opt_options.labelVisible==="undefined"){opt_options.labelVisible=true;}
    if(typeof opt_options.raiseOnDrag==="undefined"){opt_options.raiseOnDrag=true;}
    if(typeof opt_options.clickable==="undefined"){opt_options.clickable=true;}
    if(typeof opt_options.draggable==="undefined"){opt_options.draggable=false;}
    if(typeof opt_options.optimized==="undefined"){opt_options.optimized=false;}
    opt_options.crossImage=opt_options.crossImage||"http"+(document.location.protocol==="https:"?"s":"")+"://maps.gstatic.com/intl/en_us/mapfiles/drag_cross_67_16.png";opt_options.handCursor=opt_options.handCursor||"http"+(document.location.protocol==="https:"?"s":"")+"://maps.gstatic.com/intl/en_us/mapfiles/closedhand_8_8.cur";opt_options.optimized=false;this.label=new MarkerLabel_(this,opt_options.crossImage,opt_options.handCursor);google.maps.Marker.apply(this,arguments);}
inherits(MarkerWithLabel,google.maps.Marker);MarkerWithLabel.prototype.setMap=function(theMap){google.maps.Marker.prototype.setMap.apply(this,arguments);this.label.setMap(theMap);};

var map;
var centerPoint;
var mapOptions = {
    zoom: 10,
    scrollwheel: false,
    navigationControl:{style:google.maps.NavigationControlStyle.DEFAULT},
    mapTypeId:google.maps.MapTypeId.ROADMAP
};
var highlightedMarker = null;
var infoWindow = null;
var markers = [];

var createMarkerIcon = function(hover, index) {

    var image;

    if(hover){
      image = "/storage/images/transparent.gif"
    }else{
      image = "/storage/images/transparent.gif"
    }

    var icon = new google.maps.MarkerImage(image,
        new google.maps.Size(30, 42), new google.maps.Point(0,0), new google.maps.Point(15, 42));

    return icon;
};
var createMarker = function(point, index) {
    var baseImage = "/storage/images/transparent.gif";
    var hoverImage = "/storage/images/transparent.gif";
    var shadowIcon = new google.maps.MarkerImage("/storage/images/map-markers/blank-shadow.gif", new google.maps.Size(30, 24), new google.maps.Point(0,0), new google.maps.Point(5, 23));

    var marker = new MarkerWithLabel({
        position: point,
        icon: createMarkerIcon(false,index),
        draggable: false,
        facilityId: index,
        labelAnchor: new google.maps.Point(9, 27),
        labelClass: "map-label marker-"+index // the CSS class for the label
    });

    google.maps.event.addListener(marker, 'mouseover', function () {
        $('#infobox').remove();
        showInfoBox(marker, index);
    });


    google.maps.event.addListener(marker, 'mouseout', function() {

    });

    return marker;
};
var showInfoBox = function(marker,index) {
    var map = marker.getMap();
    var bounds = map.getBounds();
    if(!bounds) return;

    if (null !== infoWindow) {
        infoWindow.close();
    }
    highlightMarker(index);

    infoWindow = new google.maps.InfoWindow({
        content: fetchInfoWindowContent(index)
    });

    infoWindow.open(map, marker);

    $('#infobox img.close-button').click(function(){
        $('#infobox').remove();
    });
}

function highlightMarker(id) {
    if (null != highlightedMarker) {
        highlightedMarker.set('labelClass', 'map-label marker-' + id);
        highlightedMarker.setZIndex(google.maps.Marker.MAX_ZINDEX - 10);
    }

    highlightedMarker = markers[id];

    highlightedMarker.set('labelClass', 'map-label selected marker-' + id);
    highlightedMarker.setZIndex(google.maps.Marker.MAX_ZINDEX + 10);
}

function fetchInfoWindowContent(id) {
    let facility = this.jQuery('#facility-' + id);
    let details = facility.find('.details').clone();
    details.find('.call-now').remove();

    let detailsHtml = details.html();
    let image = facility.find('.image').html();
    return image + detailsHtml;
}

function initFacilityHover() {
    $('body.search li.facility').each((i, li) => {
        $(li).hover(() => {
            let id = $(li).attr('data-facility-id');
            showInfoBox(markers[id], id);
        });
    });
}

var initMaps = function(){
    map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
    centerPoint = new google.maps.LatLng(
       parseFloat(this.jQuery('#map-canvas').attr('data-lat')),
       parseFloat(this.jQuery('#map-canvas').attr('data-lng'))
    );
    map.setCenter(centerPoint);

    if (markerType == "search") {
        var points = [];
        for (var i = 0; i < listings.length; i++) {
            points[listings[i].facility_id] = new google.maps.LatLng(listings[i].latitude, listings[i].longitude);
            var marker = createMarker(points[listings[i].facility_id], listings[i].facility_id);
            marker.setMap(map);
            google.maps.event.addListener(marker, 'click', (e) => {
                window.location  = '/facility/' + highlightedMarker.facilityId;
            });
            markers[listings[i].facility_id] = marker;
        }
    }
    initFacilityHover();
    fitBounds();
    $("#map-container").show();
};

function fitBounds() {
    let bounds = new this.google.maps.LatLngBounds();
    markers.forEach(marker => {
        bounds.extend(marker.getPosition());
    });
    map.fitBounds(bounds);
}

$('#unit-page .nav-tabs a[href="#map"]').click(function(){
    initMaps();
});

$('#unit-page a[href="#map"]').on('shown.bs.tab', function (e) {
    initMaps();
});
if($('#map-canvas').is(':visible')) {
    initMaps();
}