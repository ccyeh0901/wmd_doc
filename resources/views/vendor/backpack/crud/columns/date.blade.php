{{-- localized date using jenssegers/date --}}
<?php xdebug_break()?>
<td data-order="{{ $entry->{$column['name']} }}">
    @if (!empty($entry->{$column['name']}))
	{{ Date::parse($entry->{$column['name']})->format(config('backpack.base.default_date_format')) }}
    @endif
</td>