<form action="{{ route('users') }}" class="filter-form">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">{{ __('First name') }}</label>
                <input type="text" name="first_name" class="form-control" placeholder="First name..."
                    value="{{ request()->first_name }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">{{ __('Last name') }}</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last name..."
                    value="{{ request()->lastname }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="department_id">{{ __('Department') }}</label>
                <select name="department_id" class="form-control">
                    <option value="">{{ __('Select one') }}</option>
                    @foreach ($departments as $a)
                        <option value="{{ $a->id }}" @if ($a->id == request()->department_id) selected @endif>
                            {{ $a->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="verified">{{ __('Verified') }}</label>
                <select name="verified" class="form-control">
                    <option value="">{{ __('Select one') }}</option>
                    <option value="0" @if (request()->verified == 0) selected @endif>{{ __('No') }}</option>
                    <option value="1" @if (request()->verified == 1) selected @endif>{{ __('Yes') }}</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="active">{{ __('Status') }}</label>
                <select name="active" class="form-control">
                    <option value="">{{ __('Select one') }}</option>
                    <option value="0" @if (request()->active == 0) selected @endif>{{ __('Inactive') }}</option>
                    <option value="1" @if (request()->active == 1) selected @endif>{{ __('Active') }}</option>
                </select>
            </div>
        </div>
    </div>
</form>
