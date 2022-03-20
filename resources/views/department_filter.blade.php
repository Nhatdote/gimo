<form action="{{ route('departments') }}" class="filter-form">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="parent_id">{{ __('Parent') }}</label>
                <select name="parent_id" class="form-control">
                    <option value="">{{ __('Select one') }}</option>
                    @foreach ($departments as $a)
                        <option value="{{ $a->id }}" @if (request()->parent_id == $a->id) selected @endif>
                            {{ $a->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
