<div id="search-bar" class="">
    {!! Form::open( ['url' => config('host') . '/search', 'method' => 'get'] ) !!}
        <input type="hidden" id="type" name="type" value="selfstorage" />

        <div class="panel panel-default panel-search">
            <div class="panel-heading">
                <h3 class="panel-title">Change location</h3>
            </div>
            <div class="panel-body">
                <fieldset>
                    <input type="hidden" id="location-id" name="location-id" value="24708895" />
                    <input type="hidden" id="include-ogf" name="include-ogf" value="0" />
                    <div class="input-group">
                        <input type="text" class="form-control" id="location" name="location" value="{{ $location }}" placeholder="Address, city, ZIP" />
                        <span class="input-group-btn"><input type="submit" id="search-button" class="btn btn-primary" value="Go" /></span>
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
                        <label id="size25" class="radio">
                            <span class="unit-img"></span>
                            <span class="sizeguide"><img src="{{url('storage/images/size-guide/sizeguide5x5.png')}}" width="364" height="227" alt="Picture of 5 by 5 Unit" /></span>
                            <input type="radio" name="sqft" value="25" {{ ($sqft=='25')? 'checked="checked"' : '' }} />
                            5' x 5'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size50" class="radio">
                            <span class="unit-img"></span>
                            <span class="sizeguide"><img src="{{url('storage/images/size-guide/sizeguide5x10.png')}}" width="364" height="227" alt="Picture of 5 by 10 Unit" /></span>
                            <input type="radio" name="sqft" value="50" {{ ($sqft=='50')? 'checked="checked"' : '' }} />
                            5' x 10'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size75" class="radio">
                            <span class="unit-img"></span>
                            <span class="sizeguide"><img src="{{url('storage/images/size-guide/sizeguide5x15.png')}}" width="364" height="227" alt="Picture of 5 by 15 Unit" /></span>
                            <input type="radio" name="sqft" value="75" {{ ($sqft=='75')? 'checked="checked"' : '' }} />
                            5' x 15'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size100" class="radio">
                            <span class="unit-img"></span>
                            <span class="sizeguide"><img src="{{url('storage/images/size-guide/sizeguide10x10.png')}}" width="364" height="227" alt="Picture of 10 by 10 Unit" /></span>
                            <input type="radio" name="sqft" value="100" {{ ($sqft=='100')? 'checked="checked"' : '' }} />
                            10' x 10'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size150" class="radio">
                            <span class="unit-img"></span>
                            <span class="sizeguide"><img src="{{url('storage/images/size-guide/sizeguide10x15.png')}}" width="364" height="227" alt="Picture of 10 by 15 Unit" /></span>
                            <input type="radio" name="sqft" value="150" {{ ($sqft=='150')? 'checked="checked"' : '' }} />
                            10' x 15'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size200" class="radio">
                            <span class="unit-img"></span>
                            <span class="sizeguide"><img src="{{url('storage/images/size-guide/sizeguide10x20.png')}}" width="364" height="227" alt="Picture of 10 by 20 Unit" /></span>
                            <input type="radio" name="sqft" value="200" {{ ($sqft=='200')? 'checked="checked"' : '' }} />
                            10' x 20'
                        </label>
                    </div>
                    <div class="controls">
                        <label id="size300" class="radio">
                            <span class="unit-img"></span>
                            <span class="sizeguide"><img src="{{url('storage/images/size-guide/sizeguide10x30.png')}}" width="364" height="227" alt="Picture of 10 by 30 Unit" /></span>
                            <input type="radio" name="sqft" value="300" {{ ($sqft=='300')? 'checked="checked"' : '' }} />
                            10' x 30'
                        </label>
                    </div>
                    <input type="radio" name="sqft" value="0" id="clear-sqft-input"  />
                </div>
        </fieldset>

        <fieldset id="sort-order">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Sort by</h3>
                </div>
                <div class="panel-body">
                    <div class="controls">
                        <label class="first radio"><input type="radio" name="order" value="default" {{ (empty($order) || $order=='default') ? 'checked="checked"' : '' }} /> Recommended</label>
                        <label class="radio"><input type="radio" name="order" value="price"  {{ ($order=='price')? 'checked="checked"' : '' }} /> Price</label>
                        <label class="radio"><input type="radio" name="order" value="distance"  {{ ($order=='distance')? 'checked="checked"' : '' }} /> Distance</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset id="amenities">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span id="clear-amenities" class="pull-right">clear</span>
                    <h3 class="panel-title">Amenities</h3>
                </div>
                <div class="panel-body">
                    <div class="controls">
                        <label class="first radio" id="amenities_climate_controlled" rel="tooltip" data-container="body" title="Heated and cooled storage units. Best for long-term storage or storing sensitive items such as musical instruments or electronics."><input type="radio" name="amenities" value="climate_controlled" {{ ($amenities=='climate_controlled')? 'checked="checked"' : '' }} /> Climate Control <i class="icon-info-sign"></i></label>
                        <label class="radio" id="amenities_drive_up" rel="tooltip" data-container="body" title="Units with exterior doors. These allow you to back your vehicle up to the unit for easier unloading when you move in."><input type="radio" name="amenities" value="drive_up" {{ ($amenities=='drive_up')? 'checked="checked"' : '' }}  /> Drive Up Access <i class="icon-info-sign"></i></label>
                        <label class="radio" id="amenities_twenty_four_hour_access" rel="tooltip" data-container="body" title="These locations allow you to access your storage unit 24 hours a day, even when the office is closed."><input type="radio" name="amenities" value="twenty_four_hour_access" {{ ($amenities=='twenty_four_hour_access')? 'checked="checked"' : '' }}  /> 24 Hour Access <i class="icon-info-sign"></i></label>
                        <label class="radio" id="amenities_wine" style="display:none;"><input type="radio" name="amenities" value="wine"  /> Wine Storage <i class="icon-info-sign"></i></label>
                        <input type="radio" name="amenities" value="" id="clear-amenities-input"  />
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
                    <label class="first radio"><input type="radio" name="distance" value="5"  {{ ($distance=='5')? 'checked="checked"' : '' }} /> 5 miles</label>
                    <label class="radio"><input type="radio" name="distance" value="15" {{ (empty($distance) || $distance=='15')? 'checked="checked"' : '' }} /> 15 miles</label>
                    <label class="radio"><input type="radio" name="distance" value="30" {{ ($distance=='30')? 'checked="checked"' : '' }}  /> 30 miles</label>
                </div>
            </div>
        </fieldset>

        <input id="update-search-button" class="btn btn-primary btn-lg btn-block" type="submit" value="Update" />
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
