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
            cursor: pointer;
        }

        .field-list-item:last-child {
            border-bottom: none;
        }

    </style>

    <div class="filter mb-4">
        <div class="font-weight-bold">{{ __('Filters') }}</div>

        <div class="mt-2">
            @if (request()->is('users'))
                @include('user_filter')
            @elseif (request()->is('departments'))
                @include('department_filter')
            @endif
        </div>
    </div>

    <div class="export mb-4">
        <div class="font-weight-bold">{{ __('Export') }}</div>
        <div class="text-muted font-italic small">
            {{ __('Select fields in left panel, Drag and drop to sort fields') }}
        </div>

        <div class="row mt-2">
            <div class="col-6">
                <div class="field-list" id="field-left">
                    @foreach ($fields as $k => $f)
                        <div class="field-list-item" data-field="{{ $k }}">{{ $f['label'] }}</div>
                    @endforeach
                </div>
            </div>
            <div class="col-6">
                <div class="field-list" id="field-right">

                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <input type="checkbox" class="export-with-filter" id="export-with-filter">
            <label for="export-with-filter"
                style="margin-bottom: 0; transform: translateY(-1px)">{{ __('Export with filters') }}</label>
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
        const model = $(this).attr('data-model');

        $('#field-right').children().each(function() {
            fields.push($(this).attr('data-field'));
        });

        if (!fields.length) {
            $('#field-left').children().each(function() {
                fields.push($(this).attr('data-field'));
            });
        }

        let url = window.location.origin + '/export?object=' + model + '&fields=' + fields.join(',');

        if ($('.export-with-filter').is(':checked')) {
            const $filter = $('.filter-form');

            url += '&' + $filter.serialize();
        }

        window.location.href = url;
    });


    var request = null;
    $('.filter-form input').on('keyup', function() {
        filter();
    });

    $('.filter-form select').on('change', function() {
        filter();
    })

    var filter = function(delay = false) {
        let $form = $('.filter-form');

        request = $.ajax({
                url: $form.attr('action') + '?' + $form.serialize(),
                type: 'get',
                dataType: 'json',
                data: {
                    ajax: 1,
                    filter: 1
                },
                beforeSend: function() {
                    if (request !== null) {
                        request.abort();
                    }
                },
            }).done(res => {
                if (res.status !== 1) {
                    alert('loading error...!');
                    return;
                }

                $('.list-items').replaceWith(res.html);
            })
            .fail(error => console.log(error));
    }
</script>
