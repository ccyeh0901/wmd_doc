<!-- SCHEDULE select from array -->
<div @include('crud::inc.field_wrapper_attributes') >


    {{--<label>{!! $field['label'] !!}</label>--}}

    <h2 class="day"></h2>
    @include('crud::inc.field_translatable_icon')

    <?php xdebug_break() ?>
    @foreach (reset($field['options']) as $k => $v)
        <hr>{{$v['title']}} {{--時段名稱--}}
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
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

        <script>

            jQuery(document).ready(function($) { //ryjs

                /*取得日期算出總共有幾天行程
                * 把div.sub_schedule  整個複製之後 修改 每個select 的name 以及 h2.day的內容*/

                //$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) { //切換tab的時候觸發



                $("#wmd_visit_period").change(function (e) { //當日期改變的時候，行程菜單也要跟著調整
                    /*
                    * 一開始後台會產生一個行程樣板，之後再根據你是新增還是修改來複製那個樣板，若是新增，就根據所選日期複製生成，
                    * 若是修改，就根據上次儲存內容來生成
                    *
                    * 新增：一開始陣列是空的，當設定或調整日期時，行程規劃會根據行程菜單來初始化
                    *
                    *
                    * 修改：一開始$schedule是有內容的，行程規劃，根據上次儲存內容生成，若日期修正就跟著修改...
                    *
                    *
                    * */
                    //$('input[name="wmd_visit_from"]').change(function(e){

                    var start = ($(this).val().split(' - ')[0]).split(' ')[0];
                    var end = ($(this).val().split(' - ')[1]).split(' ')[0]; // end - start returns difference in milliseconds

                    var date1 = new Date(start);
                    var date2 = new Date(end);
                    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                    diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    alert('共'+(diffDays+1)+'天，記得至行程規劃頁籤安排行程');

                    $('#tab_schedule > div').not(':first').remove();


                    for(i=0; i<diffDays; i++) {
                        //根據天數 複製行程樣板
//                        $(".sub_schedule").clone().append(To($("#tab_schedule"));)
                        $("#tab_schedule").append(function(){
                            return $("#tab_schedule").find('div').length==0?$(this).clone(): $("#tab_schedule").find('div:first').clone();
                        });
                    }

//                    date1.setDate( date1.getDate() + 1 );
//
//                    //修改第一天日期
//                    $('.sub_schedule h2.day').html(date1.toISOString().split('T')[0]);
//
//                    //將select name 後面加上日期
//
//
                    $('.sub_schedule').each(function( index ) { //選出每一天
                        $(this).find('select').each(function( index ) {
                            orig_name = this.getAttribute('name');
                            this.setAttribute('name', this.getAttribute('name').substr(0, orig_name.length-2)+date1.toISOString().split('T')[0] + '[]')

                        });

                    });

                });


            });

        </script>
    @endpush
@endif