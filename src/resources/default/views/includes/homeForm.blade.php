<div class="home">
    <div class="search">
        <div class="form">
            {!! Form::open( ['url' => '/search', 'method' => 'post'] ) !!}
            <div class="location">
                <div class="widget">
                    <label>Find self-storage near:
                        {!! Form::input('text', 'location', '', array(
                        'id' => 'search_location',
                        'required' => 'required',
                        'class' => 'form-control',
                        'placeholder' => 'Enter a location',
                        'autocomplete' => 'off'
                        ) ) !!}
                    </label>

                    <span class="input-group-btn submit" >
                        {!! Form::button('Find Units', array(
                        'type' => 'submit',
                        'id' => 'search_search',
                        'search[search]' => '',
                        'name' => 'search[search]',
                        'class' => 'form-control',
                        ) ) !!}
                    </span>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
