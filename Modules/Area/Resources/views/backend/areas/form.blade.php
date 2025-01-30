<div class="row">
    <!-- Name Field -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'name';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "required";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

    <!-- Slug Field -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'slug';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

    <!-- Status Field -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'status';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select an option --";
            $required = "required";
            $select_options = \Modules\Area\Enums\AreaStatus::toArray(); // Assuming you have an Enum for status
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes(["$required"]) }}
        </div>
    </div>
</div>

<div class="row">
    <!-- Polygon Coordinates Field -->
    <div class="col-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'polygon_coords';
            $field_label = label_case('Draw Deliverable Area');
            $field_placeholder = $field_label;
            $required = "required";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->hidden($field_name)->attributes(["$required"]) }}
            @include ("$module_path.$module_name.includes.map") <!-- Include map for drawing area -->
        </div>
    </div>
    <!-- Postcode Fields (Optional) -->

    <div class="col-6 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'postcodes';
            $field_label = label_case('Postcodes');
            $field_placeholder = "Enter Postcodes separated by commas";
            $required = "";
            $postcodes = implode(', ', $data?$data->postcodes->pluck('postcode')->toArray():[]);
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->value($postcodes)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

<!-- Days of Operation (Checkboxes) -->
<div class="col-6 col-sm-4 mb-3">
    @foreach(['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'] as $day)
        
            <div class="form-group">
                <?php
                $field_label = label_case($day);
                $field_name = $day;
                $availability = $data?$data->availability()->where('day', strtoupper($day))->first():null;
                $checked = $availability ? $availability->available : false;
                ?>
                {{ html()->label($field_label, $field_name)->class('form-label') }}
                {{ html()->checkbox($field_name)->checked($checked) }}
            </div>
       
    @endforeach
</div>
</div>

<div class="row">
    <!-- Description Field -->
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'description';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>





<x-library.select2 />
