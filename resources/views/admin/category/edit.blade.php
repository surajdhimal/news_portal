<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Category Create</h4>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary">go back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.update', $category->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="nep_title">Enter Nepali Title <span class="text-danger">*</span></label>
                                <input type="text" name="nep_title" id="nep_title" class="form-control"
                                    value="{{ $category->nep_title }}">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="eng_title">Enter English Title <span class="text-danger">*</span></label>
                                <input type="text" name="eng_title" id="eng_title" class="form-control"
                                    value="{{ $category->eng_title }}">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="meta_keywords">Enter Meta Keywords (seperated by commas)</label>
                                <textarea name="meta_keywords" id="meta_keywords" class="form-control">
                                    {{ $category->meta_keywords }}
                                </textarea>
                            </div>

                            <div class="col-6 mb-2">
                                <label for="meta_description">Enter Meta Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control">
                                    {{ $category->meta_description }}
                                </textarea>
                            </div>

                            <div class="col-6 mb-2">
                                <label for="status">Change Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>In Active
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-success">Update Record</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{--
primary-blue
danger-red
success-green
info-skyblue
--}}
