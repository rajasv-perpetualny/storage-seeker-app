<div class="home">
    <div class="search">
        <div class="form">
            {!! Form::open( ['url' => '/search', 'method' => 'post', 'id' => 'home-form'] ) !!}
            <div class="location">
                <div class="widget">
                    <div class="input-container">
                        {!! Form::input('text', '', '', array(
                        'id' => 'search_location',
                        'name' => 'location',
                        'required' => 'required',
                        'class' => 'form-control',
                        'placeholder' => 'Enter a city or zip code',
                        'autocomplete' => 'off',
                        'value' => ''
                        ) ) !!}
                    </div>
                    <div class="input-container input-button">
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
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
