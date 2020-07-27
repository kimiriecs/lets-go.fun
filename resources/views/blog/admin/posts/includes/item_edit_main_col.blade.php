{{--  @php /**@var \App\Models\BlogCategory $item*/ @endphp  --}}

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" id="category-edit" role="tablist">
                    <li class="nav-item" role="">
                        <a class="nav-link active" id="main-data-tab" data-toggle="tab" href="#main-data" role="tab"
                            aria-controls="main-data-panel" aria-selected="true">Основные данные</a>
                    </li>
                </ul>
                <div class="tab-content" id="main-data-tab-сontent">
                    <div class="tab-pane fade show active" id="main-data-panel" role="tabpanel"
                        aria-labelledby="main-data-tab">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input name="title" id="title" value="{{ $item->title }}" type="text" class="form-control"
                                placeholder="Заголовок" minlength="3" required>
                        </div>
                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input name="slug" id="slug" value="{{ $item->slug }}" type="text" class="form-control"
                                placeholder="Идентификатор">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Родитель</label>
                            <select name="parent_id" id="parent_id" class="form-control"
                                placeholder="Выберите категорию" required>

                                @foreach ($categoryList as $categoryOption)

                                <option value="{{ $categoryOption->id }}"
                                    @if ($categoryOption->id == $item->parent_id)
                                    selected
                                    @endif
                                    >
                                    {{--  {{ $categoryOption->id }}. {{ $categoryOption->title }}  --}}
                                    {{ $categoryOption->id_title }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание категории</label>
                            <textarea name="description" id="description" class="form-control" rows="3">
                                {{ old('description', $item->description) }}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>