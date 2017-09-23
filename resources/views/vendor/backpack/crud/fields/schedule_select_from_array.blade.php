<!-- SCHEDULE select from array -->
<div @include('crud::inc.field_wrapper_attributes') >


    {{--<label>{!! $field['label'] !!}</label>--}}

    <h2 class="day"></h2>
    @include('crud::inc.field_translatable_icon')

    @foreach (reset($field['options']) as $k => $v)
        <hr>{{$v['title']}} {{--時段名稱--}}
        <select
                name="sect{{$k}}@if (isset($field['allows_multiple']) && $field['allows_multiple']==true)[]@endif"
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


                //將行程菜單樣板抓過來後，只會有一天的行程， 順便幫他取上名字，加上名字

                update_schedule_menu($("#wmd_visit_period"));

                $("#wmd_visit_period").change(function (e) { //當日期改變的時候，行程菜單也要跟著調整
                    /*
                    * 一開始後台會產生一個行程樣板，之後再根據你是新增還是修改來複製那個樣板，若是新增，就根據所選日期複製生成，
                    * 若是修改，就根據上次儲存內容來生成
                    *
                    * 新增：一開始陣列是空的，當設定或調整日期時，行程規劃會根據行程菜單來初始化
                    * 修改：一開始$schedule是有內容的，行程規劃，根據上次儲存內容生成，若日期修正就跟著修改...
                    *       當調整日期時， 就整個打掉（留下第一個）重新產生行程菜單
                    * */

                    update_schedule_menu($(this));

//                    var start = ($(this).val().split(' - ')[0]).split(' ')[0];
//                    var end = ($(this).val().split(' - ')[1]).split(' ')[0]; // end - start returns difference in milliseconds
//
//                    var date1 = new Date(start);
//                    var date2 = new Date(end);
//                    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
//                    diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
//                    alert('共'+(diffDays+1)+'天，記得至行程規劃頁籤安排行程');
//
//                    $('#tab_schedule > div.sub_schedule').not(':first').remove(); //除了第一個 其他都移除，不行！
//
//
//                    for(i=0; i<diffDays; i++) {
//                        //根據天數 複製行程樣板
//                        $("#tab_schedule").append(function(){
//                            return $("#tab_schedule").find('div').length==0?$(this).clone(): $("#tab_schedule").find('div:first').clone();
//                        });
//                    }
//
//                    //將select name 前面加上日期 湊出來會是這樣：2017-09-01sect1[]
//                    $('.sub_schedule').each(function( index ) { //選出每一天
//
//                        date1.setDate( date1.getDate() + index ); //將日期往前加一天
//                        $(this).find('h2.day').html(date1.toISOString().split('T')[0]); // date1.toISOString().split('T')[0]： 2017-09-01 這樣的格式
//                        $(this).find('select').each(function( idx ) { //挑出每個時段
//                            orig_name = this.getAttribute('name');
//                            this.setAttribute('name', date1.toISOString().split('T')[0] + this.getAttribute('name'));
//                        });
//                    });

                });


            });

            function update_schedule_menu(period) {

                var start = (period.val().split(' - ')[0]).split(' ')[0];
                var end = (period.val().split(' - ')[1]).split(' ')[0]; // end - start returns difference in milliseconds

                var date1 = new Date(start);
                var date2 = new Date(end);
                var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                alert('共'+(diffDays+1)+'天，記得至行程規劃頁籤安排行程');

                $('#tab_schedule > div.sub_schedule').not(':first').remove(); //除了第一個 其他都移除，不行！


                for(i=0; i<diffDays; i++) {
                    //根據天數 複製行程樣板
                    $("#tab_schedule").append(function(){
                        return $("#tab_schedule").find('div').length==0?$(this).clone(): $("#tab_schedule").find('div:first').clone();
                    });
                }

                //將select name 前面加上日期 湊出來會是這樣：2017-09-01sect1[]
//                var tmp_date = new Date(date1);
                $('.sub_schedule').each(function( index ) { //選出每一天

                    var tmp_date = new Date(date1);
                    tmp_date.setDate( date1.getDate() + index ); //將日期往前加一天 setDate 會設定「日」的部分，從這個月開頭算起，若超過該月的範圍，就進到下個月去...
                    $(this).find('h2.day').html(tmp_date.toISOString().split('T')[0]); // tmp_date.toISOString().split('T')[0]： 2017-09-01 這樣的格式
                    $(this).find('select').each(function( idx ) { //挑出每個時段
                        orig_name = this.getAttribute('name');
                        var sect_pos = this.getAttribute('name').indexOf("sect");
                        this.setAttribute('name', tmp_date.toISOString().split('T')[0] + this.getAttribute('name').substr(sect_pos));
                    });
                });
            }

        </script>
    @endpush
@endif