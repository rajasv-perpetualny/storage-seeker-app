{!! Form::open( [ 'name'=>'reservation', 'url' => '/reservation/'.$spaceId, 'method' => 'post', 'id'=>'reservation_form'] ) !!}
<?php
/* *
{% if errors is not empty %}
<div class="errors">
    {% for error in errors %}
    <div class="error" role="alert"> {{ error }}</div>
    {% endfor %}
</div>
{% endif %}
/* */
?>

<div>
    <label class="control-label required" for="reservation_firstName">First name *</label>
    {!! Form::input('text', 'first_name', old('first_name'), array(
        'id' => 'reservation_firstName',
        'required' => 'required',
        'class' => 'form-control',
        'placeholder' => 'First Name',
    ) ) !!}
</div>

<div>
    <label class="control-label required" for="reservation_lastName">Last name *</label>
    {!! Form::input('text', 'last_name', old('last_name'), array(
        'id' => 'reservation_lastName',
        'required' => 'required',
        'class' => 'form-control',
        'placeholder' => 'Last Name',
    ) ) !!}
</div>

<div>
    <label class="control-label required" for="reservation_emailAddress">Email address *</label>
    {!! Form::input('text', 'email', old('email'), array(
        'id' => 'reservation_emailAddress',
        'required' => 'required',
        'class' => 'form-control',
        'placeholder' => 'Email Address',
    ) ) !!}
</div>

<div>
    <label class="control-label required" for="reservation_phoneNumber">Phone number *</label>
    {!! Form::input('text', 'phone', old('phone'), array(
        'id' => 'reservation_phoneNumber',
        'required' => 'required',
        'class' => 'form-control',
        'placeholder' => 'Phone Number',
    ) ) !!}
</div>

<div>
    <label class="control-label required" for="reservation_moveInDate">Estimated move in date *</label>
    {!! Form::input('date', 'move_in_date', is_null(old('move_in_date')) ? date('Y-m-d', time()) : old('move_in_date'), array(
        'id' => 'reservation_moveInDate',
        'required' => 'required',
        'class' => 'form-control',
        'min' => date('Y-m-d', time()),
        'max' => date('Y-m-d', $maxReservableDate),
    ) ) !!}
</div>

<div class="submit">
    {!! Form::button('Complete Reservation', array(
    'type' => 'submit',
    'id' => 'reservation_submit',
    'name' => 'submit',
    'class' => 'btn-default btn',
) ) !!}

</div>

<div class="required-indicator">
    <strong>* = required field</strong>
</div>

{!! Form::input('hidden', 'unitId', $spaceId, ['id'=>'reservation_unitId'] ) !!}
{{ csrf_field() }}

<script src="//cdn.jsdelivr.net/webshim/1.15.10/polyfiller.js"></script>
<script>
    webshims.polyfill('forms-ext');
    webshim.setOptions("forms-ext", {
        "date": {
            "startView": 2,
            "minView": 2,
            "openOnFocus": true
        },
        "widgets": {
            "calculateWidth":false
        }
    });
</script>

{!! Form::close() !!}
