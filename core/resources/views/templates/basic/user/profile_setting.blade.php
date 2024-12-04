@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="card custom--card">
                    <div class="card-header card--header">
                        <h5 class="card-title">@lang('Profile Setting')</h5>
                    </div>
                    <div class="card-body">
                        <form class="register" action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <div class="dashboard-edit-profile__thumb mb-2">
                                    <div class="file-upload">
                                        <label class="edit-pen" for="update-photo"><i class="lar la-edit"></i></label>
                                        <input type="file" name="image" class="form-control form--control" id="update-photo" hidden="" accept=".jpg,.jpeg,.png">
                                    </div>
                                    <img id="upload-img" src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'), true) }}" alt="@lang('image')">
                                </div>
                                <div class="text-center">
                                    <span class="text-muted"> @lang('Supported Files:')
                                        <b>@lang('.jpg'), @lang('.jpeg'), @lang('.png')</b>
                                        @lang('Image will be resized into') <b>{{ getFileSize('userProfile') }}</b>@lang('px')
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('First Name')</label>
                                    <input type="text" class="form-control form--control" name="firstname" value="{{ $user->firstname }}" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('Last Name')</label>
                                    <input type="text" class="form-control form--control" name="lastname" value="{{ $user->lastname }}" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('E-mail Address')</label>
                                    <input class="form-control form--control" value="{{ $user->email }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('Mobile Number')</label>
                                    <input class="form-control form--control" value="{{ $user->mobile }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('Address')</label>
                                    <input type="text" class="form-control form--control" name="address" value="{{ @$user->address }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('State')</label>
                                    <input type="text" class="form-control form--control" name="state" value="{{ @$user->state }}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="form--label">@lang('Zip Code')</label>
                                    <input type="text" class="form-control form--control" name="zip" value="{{ @$user->zip }}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="form--label">@lang('City')</label>
                                    <input type="text" class="form-control form--control" name="city" value="{{ @$user->city }}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="form--label">@lang('Country')</label>
                                    <input class="form-control form--control" value="{{ @$user->country_name }}" disabled>
                                </div>
                            </div>
                            <button type="submit" class="cmn--btn w-100">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
