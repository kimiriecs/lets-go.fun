{{--  @php /**@var \App\Models\BlogCategory $item*/ @endphp  --}}

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if ($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" id="post-edit" role="tablist">
                    <li class="nav-item" role="">
                        <a class="nav-link active" 
                            id="main-data-tab" 
                            data-toggle="tab" 
                            href="#main-data-panel" 
                            role="tab"
                            aria-controls="main-data-panel" 
                            aria-selected="true"
                            >
                            Основные данные</a>
                    </li>
                    <li class="nav-item" role="">
                        <a class="nav-link" 
                            id="add-data-tab" 
                            data-toggle="tab" 
                            href="#add-data-panel" 
                            role="tab"
                            aria-controls="add-data-panel" 
                            aria-selected="false"
                            >
                            Дополнительные данные
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="tab-сontent">
                    <div class="tab-pane fade show active" 
                            id="main-data-panel" 
                            role="tabpanel"
                            aria-labelledby="main-data-tab"
                            >
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input name="title" id="title" value="{{ $item->title }}" type="text" class="form-control"
                                placeholder="Заголовок" minlength="3" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="content_raw">Статья</label>
                            <textarea name="content_raw" id="content_raw" class="form-control" rows="15">
                                {{ old('content_raw', $item->content_raw) }}
                            </textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" 
                            id="add-data-panel" 
                            role="tabpanel"
                            aria-labelledby="add-data-tab"
                            >
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select name="category_id" id="category_id" class="form-control"
                                placeholder="Категория" required>

                                @foreach ($categoryList as $categoryOption)

                                <option value="{{ $categoryOption->id }}"
                                    @if ($categoryOption->id == $item->blog_category_id)
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
                            <label for="slug">Идентификатор</label>
                            <input name="slug" id="slug" value="{{ $item->slug }}" type="text" class="form-control"
                                placeholder="Идентификатор">
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <textarea name="excerpt" id="excerpt" class="form-control" rows="3">
                                {{ old('excerpt', $item->excerpt) }}
                            </textarea>
                        </div>
                        <div class="form-check">
                            
                            <input name="is_published" type="hidden" class="form-check-input" value="">

                            <input name="is_published" type="checkbox" value="{{ $item->is_published }}"
                                @if ($item->is_published)
                                    checked="checked"
                                @endif
                                >
                            <label class="form-check-label" for="is_published">Опубликовано</label>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>