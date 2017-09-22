<!-- select from array -->
<div @include('crud::inc.field_wrapper_attributes') >


    {{--<label>{!! $field['label'] !!}</label>--}}

    <h2></h2>
    @include('crud::inc.field_translatable_icon')



		<?php xdebug_break()?>

    @foreach (reset($field['options']) as $k => $v)
        <hr>{{$k}} {{--時段名稱--}}
        <select
                name="{{ $v['name'] }}@if (isset($field['allows_multiple']) && $field['allows_multiple']==true)[]@endif"
                @include('crud::inc.field_attributes')
                @if (isset($field['allows_multiple']) && $field['allows_multiple']==true)multiple @endif
        >

            @if (isset($field['allows_null']) && $field['allows_null']==true)
                <option value="">-</option>
            @endif
            {{--$field['options'] 就是 $schedule--}}




            @if (count($field['options']))


                @foreach ($v['value'] as $key => $value)
                    <option value="{{ $key }}"
                            {{--@if (isset($field['value']) && ($key==$field['value'] || (is_array($field['value']) && in_array($key, $field['value'])))--}}
                                {{--|| ( ! is_null( old($field['name']) ) && old($field['name']) == $key))--}}
                            {{--selected--}}
                            {{--@endif--}}{{-- 日後 implement這塊！ 判斷是否之前的選擇～ --}}
                    >{{ $value['name'] }}</option>
                @endforeach
            @endif
        </select>
        {{-- HINT --}}
        @if (isset($field['hint']))
            <p class="help-block">{!! $field['hint'] !!}</p>
        @endif




    @endforeach


</div>




@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
        <!-- no styles -->
        <style>
            
            .rystyle{
                display: block;
            }
        </style>





    @endpush


    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <!-- no scripts -->
        <script>

            jQuery(document).ready(function($) {





            });

        </script>
    @endpush
@endif