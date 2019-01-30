<div class="form">
    {!! Form::open( ['url' => '/search', 'method' => 'post', 'id'=>'search_form'] ) !!}
    <div class="location">
        <div class="widget-wrapper">
            <div class="widget-label">
                Move-in details:
            </div>
            <div class="widget">
                <div class="input-group">
                    <label>Find self-storage near:</label>
                    <input id="search_location" name="location" required="required"
                           class="form-control user-success" value="{{$location}}" placeholder="Enter a location"
                           autocomplete="off" type="text">
                </div>
                <div class="input-group">
                    <label>Check-in date:</label>
                    <input id="search_moveInDate" name="moveInDate" min="{{date('Y-m-d')}}" class="form-control"
                           value="{{$moveInDate}}" type="date">
                    <i></i>
                </div>
                <span class="input-group-btn submit">
                        <button type="submit" id="search_search" name="search" class="btn-default btn">Search</button>
                    </span>

            </div>
        </div>
    </div>
    <div class="size">
        <div class="widget-wrapper">
            <div class="widget-label">
                Storage type/size:<br>
                <span>Hover over any size to get an example of what can fit.</span>
                <!-- <i data-toggle="popover"
                   data-placement="right"
                   data-trigger="hover"
                   title="Not sure what size you need?"
                   data-content="Hover over any size to get an example of what can fit.">
                </i> -->
            </div>
            <div class="widget">
                @php $typeStorage = $typeStorage != 'vehicles' ? 'storage' : 'vehicles' @endphp
                <div id="search_searchType">
                    <div class="radio">
                        <label class="required">
                            <input id="search_searchType_selfstorage" name="type" required="required" value="storage"
                                   {{$typeStorage != 'vehicles' ? 'checked="checked"' : '' }}
                                   type="radio"> Self Storage</label>
                    </div>
                    <div class="radio"><label class="required">
                            <input id="search_searchType_vehicles"
                                   name="type" required="required"
                                   value="vehicles"
                                   {{$typeStorage == 'vehicles' ? 'checked="checked"' : '' }}
                                   type="radio"> Car, RV &amp; Boat Storage</label>
                    </div>
                </div>
                <div class="size-button-wrapper">
                    <button {!! $sqft == 25 ? 'class="selected"' : '' !!}
                            data-size-value="25"
                            data-toggle="popover"
                            data-placement="right"
                            data-trigger="hover"
                            title="Small"
                            data-content="Select this if you are storing anything from boxes up to a studio apartment.">
                        <div class="small"></div>
                        Small
                    </button>

                    <button {!! $sqft == 100 ? 'class="selected"' : '' !!}
                            data-size-value="100"
                            data-toggle="popover"
                            data-placement="right"
                            data-trigger="hover"
                            title="Medium"
                            data-content="Select this if you are storing a 1 or 2 bedroom apartment.">
                        <div class="medium"></div>
                        Medium
                    </button>
                    <button {!! $sqft == 200 ? 'class="selected"' : '' !!}
                            data-size-value="200"
                            data-toggle="popover"
                            data-placement="left"
                            data-trigger="hover"
                            title="Large"
                            data-content="Select this if you are storing a 2 bedroom house or larger.">
                        <div class="large"></div>
                        Large
                    </button>
                </div>
            </div>
        </div>
    </div>
    <input id="search_squareFoot"  name="sqft"  value="{{ $sqft }}" type="hidden">
    <input id="search_sort"        name="order" value="{{ $order }}" type="hidden">

    <input id="search_page"                     name="page"                     type="hidden" value="1">
    <input id="search_source"                   name="source"                   type="hidden">
    <input id="search_filterClimateControlled"  name="filterClimateControlled"  type="hidden">
    <input id="search_filter24HourAccess"       name="filter24HourAccess"       type="hidden">
    <input id="search_filterDriveUpAccess"      name="filterDriveUpAccess"      type="hidden">
    {!! Form::close() !!}
</div>