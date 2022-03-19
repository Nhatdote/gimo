<div class="col-md-4">
    <style>
        .field-list {
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 100%;
        }

        .field-list-item {
            border-bottom: 1px solid #ccc;
            padding: 12px;
        }

        .field-list-item:last-child {
            border-bottom: none;
        }

    </style>

    <div id="filter" class="mb-4">
        <div class="font-weight-bold">{{ __('Filters') }}</div>
    </div>

    <div id="export">
        <div class="font-weight-bold">{{ __('Select fields to export') }}</div>
        <div class="text-muted font-italic small">
            {{ __('Select fields in left panel, Drag and drop to sort fields') }}
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="field-list" id="field-left">
                    @foreach ($fields as $k => $f)
                        <div class="field-list-item" data-field="{{ $k }}">{{ $f['label'] }}</div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="field-list" id="field-right">

                </div>
            </div>
        </div>

        <button type="button" class="btn btn-outline-danger w-100 mt-3 d-flex align-items-center justify-content-center"
            id="export" data-model="{{ $model }}">
            <ion-icon name="download-outline" class="mr-1"></ion-icon>
            <span>{{ __('Export') }}</span>
        </button>
    </div>
</div>


<script>
    $('#field-right, #field-left').sortable();

    $('#field-left').on('click', '.field-list-item', function() {
        const $clone = $(this).clone(true, true);
        $(this).remove();

        $('#field-right').append($clone);
    });

    $('#field-right').on('click', '.field-list-item', function() {
        const $clone = $(this).clone(true, true);
        $(this).remove();

        $('#field-left').append($clone);
    });

    $('#export').on('click', function() {
        const fields = [];

        $('#field-right').children().each(function() {
            fields.push($(this).attr('data-field'));
        });

        if (!fields.length) {
            $('#field-left').children().each(function() {
                fields.push($(this).attr('data-field'));
            });
        }

        const model = $(this).attr('data-model');
        window.location.href = window.location.origin + '/export?object=' + model + '&fields=' + fields.join(
            ',');
    });
</script>
