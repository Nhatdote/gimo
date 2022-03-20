<div class="col-md-8 list-items">
    <div class="table-responsive">
        <div class="font-weight-bold">
            <span>{{ request()->is('users') ? __('User list') : __('Department list') }}</span>
            <small class="font-weight-normal"> - {{ $items->total() . ' ' . __('records') }}</small>
        </div>
        <table class="table table-stripped table-bordered mt-2">
            <thead>
                <tr class="text-left">
                    @foreach ($fields as $f)
                        <th style="position: sticky; top: -1px; z-index: 2; background: white">{{ $f['label'] }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @if (!$items->count())
                    <tr class="text-center text-muted">
                        <td colspan="{{ count($fields) }}" class="py-5">{{ __('Data is not availble') }}
                        </td>
                    </tr>
                @else
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
                @endif

            </tbody>
        </table>
    </div>
    <div class="mt-3 d-flex justify-content-center">
        {!! $items->onEachSide(0)->links('vendor.pagination.bootstrap-4') !!}
    </div>
</div>
