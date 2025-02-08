<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Company Edit</h4>
                    <a href="{{ route('admin.company.index') }}" class="btn btn-primary">go back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.company.update', $company->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="name">Enter Company Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $company->name }}">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="email">Enter Company Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" value="{{$company->email}}">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="phone">Enter Company Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{$company->phone}}">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="address">Enter Company Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" class="form-control" value="{{$company->address}}">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="facebook">Enter Facebook Link</label>
                                <input type="text" name="facebook" id="facebook" class="form-control" value="{{$company->facebook}}">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="youtube">Enter Youtube Link</label>
                                <input type="text" name="youtube" id="youtube" class="form-control" value="{{$company->youtube}}">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="logo">Enter Company Logo <span class="text-danger">*</span></label>
                                <input type="file" name="logo" id="logo" class="form-control">
                                <img src="{{asset($company->logo)}}" width="200" alt="">
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

