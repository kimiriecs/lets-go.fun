@php /**@var \App\Models\BlogCategory $item*/ @endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </div>
    </div>
</div>
@if ($item->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>
                            ID: {{ $item->id }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="created_at">Создана</label>
                        {{--  {{ dd($item) }}  --}}
                        <input name="created_at" id="created_at" value="{{ $item->created_at }}"
                            type="text"
                            class="form-control"
                            >
                    </div>
                    <div class="form-group">
                        <label for="updated_at">Обновлена</label>
                        <input name="updated_at" id="updated_at" value="{{ $item->updated_at }}"
                            type="text"
                            class="form-control"
                            >
                    </div>
                    <div class="form-group">
                        <label for="deleted_at">Удалена</label>
                        <input name="deleted_at" id="deleted_at" value="{{ $item->deleted_at }}"
                            type="text"
                            class="form-control"
                            >
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif