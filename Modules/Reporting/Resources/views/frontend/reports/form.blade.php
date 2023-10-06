<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <?php
            $field_name = 'reporter';
            $field_lable = __("reporting::$module_name.$field_name");
            $field_placeholder = '';
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", 'aria-label'=>'Image']) }}
        </div>
    </div>
</div>
<div class="row">
    
<div class="col-lg-6">
        <div class="form-group">
            <?php
            $field_name = 'reporter_type';
            $field_lable = __("reporting::$module_name.$field_name");
            $field_placeholder = '--Silakan pilih--';
            $select_options = [
                'Orang Tua' => 'Orang Tua',
                'Murid' => 'Murid',
                'Other' => 'Other',
            ];
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <?php
            $field_name = 'reporter_email';
            $field_lable = __("reporting::$module_name.$field_name");
            $field_placeholder = '';
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", 'aria-label'=>'Image']) }}
            <small>Dapat dikosongkan</small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <?php
            $field_name = 'title';
            $field_lable = __("reporting::$module_name.$field_name");
            $field_placeholder = '';
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", 'aria-label'=>'Image']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <?php
            $field_name = 'category';
            $field_lable = __("reporting::$module_name.$field_name");
            $field_placeholder = '--Silakan Pilih--';
            $required = "required";
            $select_options = $options['category'];

            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <?php
            $field_name = 'content';
            $field_lable = __("reporting::$module_name.$field_name");
            $field_placeholder = 'silakan isi detail dengan selengkap-lengkapnya';
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", 'aria-label'=>'Image','rows'=>5]) }}
        </div>
    </div>
</div>

<!-- Select2 Library -->
<x-library.select2 />
<x-library.datetime-picker />

@push('after-styles')
<!-- File Manager -->
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@push ('after-scripts')

<!-- Date Time Picker & Moment Js-->
<script type="text/javascript">
$(function() {
    var date = moment("{{$$module_name_singular->birth_date ?? ''}}", 'YYYY-MM-DD').toDate();
    $('.datetime').datetimepicker({
        format: 'DD/MM/YYYY',
        date: date,
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar-alt',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'far fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'fas fa-times'
        }
    });
});

$(document).ready(function() {
        $('#skills').multiselect({
                enableFiltering: true,
            });

        $('#certificate').multiselect({
                enableFiltering: true,
            });
    });

</script>

@endpush
