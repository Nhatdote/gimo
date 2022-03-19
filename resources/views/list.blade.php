<div class="col-md-8 h-100 d-flex flex-column">
    <div class="table-responsive flex-grow-1 border">
        <table class="table table-stripped">
            <tbody>
                <tr class="text-left">
                    @foreach ($fields as $f)
                        <th style="position: sticky; top: -1px; z-index: 2; background: white">{{ $f['label'] }}</th>
                    @endforeach
                </tr>
            </tbody>

            <tbody>
                @foreach ($items as $item)
                    <tr class="text-left">
                        @foreach ($fields as $k => $f)
                            <td>
                                @switch($f['type'])
                                    @case('date')
                                        {{ Carbon\Carbon::parse($item->$k)->format('H:i d/m/Y') }}
                                    @break

                                    @case('enum')
                                        {{ $f['display'][$item->$k] ?? '' }}
                                    @break

                                    @case('model')
                                        {{ $item[$f['relation']][$f['field']] ?? '' }}
                                    @break

                                    @default
                                        {{ $item->$k }}
                                @endswitch
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3 d-flex justify-content-center">
        {!! $items->links('vendor.pagination.bootstrap-4') !!}
    </div>
</div>
