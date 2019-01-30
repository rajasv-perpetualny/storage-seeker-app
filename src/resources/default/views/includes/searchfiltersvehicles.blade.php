<div id="search-bar" class="">

    {!! Form::open( ['url' => config('host') . '/search', 'method' => 'get', 'id' => 'searchform'] ) !!}
        <input type="hidden" id="type" name="type" value="vehicles">

        <div class="panel panel-default panel-search">
            <div class="panel-heading">
                <h3 class="panel-title">Change location</h3>
            </div>
            <div class="panel-body">
                <fieldset>
                    <input type="hidden" id="location-id" name="location-id" value="24708895">
                    <div class="input-group">
                        <input type="text" class="form-control" id="location" name="location" value="{{ $location  }}" placeholder="Address, city, ZIP">
                        <span class="input-group-btn">
                            <input type="submit" id="search-button" class="btn btn-primary" value="Go">
                        </span>
                    </div>
                </fieldset>
            </div>
        </div>

        <fieldset class="unit-sizes">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span id="clear-sqft" class="pull-right">clear</span><h3 class="panel-title">Unit sizes</h3>
                </div>

                <div class="panel-body">
                    <p>Scroll over to view</p>
                    <div class="controls">
                        <label id="size200" class="radio" style="background-position: left 7px;">
                            <span class="unit-img" style="background-image:url({{ url('storage/images/size-guide/sizecar.png') }});"></span>
                            <span class="sizeguide">
                                <span class="top">
                                    <img src="{{ url('storage/images/size-guide/car.png') }}" width="178" height="151" alt="Picture of 10x20 Car Unit">
                                    <span class="sizeguide-title">15'</span>
                                    <span><strong>Compact Car</strong></span>
                                    <span>Will fill fit most compact cars.<p>&nbsp;</p></span>
                                </span>
                                <span class="sizeguidebot">
                                </span>
                            </span>
                            <input type="radio" name="sqft" value="150" {{ ($sqft=='150')? 'checked="checked"' : '' }} />
                            15'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size250" class="radio" style="background-position: left 7px;">
                            <span class="unit-img" style="background-image:url({{ url('storage/images/size-guide/sizecar.png') }});"></span>
                            <span class="sizeguide">
                                <span class="top">
                                    <img src="{{ url('storage/images/size-guide/car.png') }}" width="178" height="151" alt="Picture of 10x25 Car Unit">
                                    <span class="sizeguide-title">20'</span>
                                    <span><strong>SUV</strong></span>
                                    <span>Will fit most full-size cars, SUVs, or most Class B camping conversion vans</span>
                                </span>
                                <span class="sizeguidebot">
                                </span>
                            </span>
                            <input type="radio" name="sqft" value="200" {{ ($sqft=='200')? 'checked="checked"' : '' }} />
                            20'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size300" class="radio" style="background-position: left 7px;">
                            <span class="unit-img" style="background-image:url({{ url('storage/images/size-guide/sizeboat.png') }});"></span>
                            <span class="sizeguide">
                                <span class="top">
                                    <img src="{{ url('storage/images/size-guide/boat.png') }}" alt="Picture of 10x30 Boat Unit">
                                    <span class="sizeguide-title">25'</span>
                                    <span><strong>Ski Boat</strong></span>
                                    <span>Will fit smaller ski boats, travel trailers, or Class C RVs</span>
                                </span>
                                <span class="sizeguidebot">
                                </span>
                            </span>
                            <input type="radio" name="sqft" value="250" {{ ($sqft=='250')? 'checked="checked"' : '' }} />
                            25'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size350" class="radio" style="background-position: left 7px;">
                            <span class="unit-img" style="background-image:url({{ url('storage/images/size-guide/sizerv.png') }});"></span>
                            <span class="sizeguide">
                                <span class="top">
                                    <img src="{{ url('storage/images/size-guide/rv.png') }}" alt="Picture of 10x30 RV Unit">
                                    <span class="sizeguide-title">30'</span>
                                    <span><strong>Class C RV</strong></span>
                                    <span>Large enough for most ski boats, travel trailers, and Class C RVs</span>
                                </span>
                                <span class="sizeguidebot">
                                </span>
                            </span>
                            <input type="radio" name="sqft" value="300" {{ ($sqft=='300')? 'checked="checked"' : '' }} />
                            30'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size350" class="radio" style="background-position: left 7px;">
                            <span class="unit-img" style="background-image:url({{ url('storage/images/size-guide/sizerv.png') }});"></span>
                            <span class="sizeguide">
                                <span class="top">
                                    <img src="{{ url('storage/images/size-guide/rv.png') }}" alt="Picture of 10x30 RV Unit">
                                    <span class="sizeguide-title">35'</span>
                                    <span><strong>Class A Motorhome</strong></span>
                                    <span>Will fit medium Class A RVs or smaller 5th-wheel trailers</span>
                                </span>
                                <span class="sizeguidebot">
                                </span>
                            </span>
                            <input type="radio" name="sqft" value="350" {{ ($sqft=='350')? 'checked="checked"' : '' }} />
                            35'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size350" class="radio" style="background-position: left 7px;">
                            <span class="unit-img" style="background-image:url({{ url('storage/images/size-guide/sizerv.png') }});"></span>
                            <span class="sizeguide">
                                <span class="top">
                                    <img src="{{ url('storage/images/size-guide/rv.png') }}" alt="Picture of 10x30 RV Unit">
                                    <span class="sizeguide-title">40'</span>
                                    <span><strong>5th Wheel Trailer</strong></span>
                                    <span>Large enough for most 5th-wheel trailers and the very biggest RVs</span>
                                </span>
                                <span class="sizeguidebot">
                                </span>
                            </span>
                            <input type="radio" name="sqft" value="400" {{ ($sqft=='400')? 'checked="checked"' : '' }} />
                            40'
                        </label>
                    </div>
                   <!-- <input type="radio" name="length" value="-" id="clear-length-input" checked="checked"> -->
                    <input type="radio" name="sqft" value="0" id="clear-sqft-input" {!! request()->input('sqft') == 0 ? 'checked="checked"' : '' !!} />
                </div>
            </div>

        </fieldset>

        <fieldset id="sort-order">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Sort by</h3>
                </div>
                <div class="panel-body">
                    <div class="controls">
                        <label class="first radio"><input type="radio" name="order" value="default" {{ ($order=='default')? 'checked="checked"' : '' }} /> Recommended</label>
                        <label class="radio"><input type="radio" name="order" value="price" {{ ($order=='price')? 'checked="checked"' : '' }} /> Price</label>
                        <label class="radio"><input type="radio" name="order" value="distance" {{ ($order=='distance')? 'checked="checked"' : '' }} /> Distance</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset id="distance">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Max distance</h3>
                </div>
                <div class="panel-body">
                    <label class="first radio"><input type="radio" name="distance" value="5" {{ ($distance=='5')? 'checked="checked"' : '' }} /> 5 miles</label>
                    <label class="radio"><input type="radio" name="distance" value="15" {{ (empty($distance) || $distance=='15')? 'checked="checked"' : '' }} /> 15 miles</label>
                    <label class="radio"><input type="radio" name="distance" value="30" {{ ($distance=='30')? 'checked="checked"' : '' }} /> 30 miles</label>
                </div>
            </div>
        </fieldset>

        <fieldset id="amenities">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span id="clear-amenities" class="pull-right">clear</span>
                    <h3 class="panel-title">Space Type</h3>
                </div>
                <div class="panel-body">
                    <div class="controls">
                        <label class="first checkbox">
                            <input type="checkbox" id="amenities_covered" rel="tooltip" title="" {{ empty(request()->input('amenities')) ? '' : 'checked="checked"' }}
                                name="amenities[]" value="covered" data-original-title="Vehicle parking that has a permanent roof or cover. Some may also be indoor, fully enclosed, spaces with garage-style doors."> Covered
                            <i class="icon-info-sign"></i>
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>


        <input id="update-search-button" class="btn btn-primary btn-lg btn-block" type="submit" value="Update">

        <noscript>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="noscript-button">
                        <input type="submit" value="Update" />
                    </div>
                </div>
            </div>
        </noscript>
    {!! Form::close() !!}
</div>