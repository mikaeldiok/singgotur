@extends('frontend.layouts.app')

@section('title') {{$$module_name_singular->name}}'s Profile @endsection

@section('content')

<div class="block-31" style="position: relative;">
  <div class="bg-primary header-bg"></div>
</div>

<section class="section-header text-white pb-7 pb-lg-11">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 pt-8 text-center">
                <h1 class="display-3 mt-4 mb-4">
                    {{$$module_name_singular->name}}
                    @auth
                    @if(auth()->user()->id == $$module_name_singular->id)
                    <small>
                        <a href="{{ route('frontend.users.profileEdit', $$module_name_singular->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </small>
                    @endif
                    @endauth
                </h1>
                <p class="lead">
                    Username: {{$$module_name_singular->username}}
                </p>
                @if ($$module_name_singular->email_verified_at == null)
                <p class="lead">
                    <a href="{{route('frontend.users.emailConfirmationResend', $$module_name_singular->id)}}">Confirm Email</a>
                </p>
                @endif

                @include('frontend.includes.messages')
            </div>
        </div>
    </div>
    <div class="pattern bottom"></div>
</section>
<section class="section section-lg line-bottom-light">
    <div class="container mt-n7 mt-lg-n12 z-2">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="card bg-white border-light shadow-soft flex-md-row no-gutters p-4">
                    <div class="col-md-6 col-lg-4">
                        <img class="img-fluid img-thumbnail" src="{{asset($user->avatar)}}" alt="{{$$module_name_singular->name}}">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between col-auto py-4 p-lg-5">

                        @if($userprofile->bio)
                        <h5 class="description">
                            {{$userprofile->bio}}
                        </h5>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <?php $fields_array = [
                                        [ 'name' => 'first_name' ],
                                        [ 'name' => 'last_name' ],
                                        // [ 'name' => 'email' ],
                                        // [ 'name' => 'mobile' ],
                                        [ 'name' => 'username' ],
                                        [ 'name' => 'gender' ],
                                        // [ 'name' => 'date_of_birth', 'type' => 'date'],
                                        [ 'name' => 'url_website', 'type' => 'url' ],
                                        // [ 'name' => 'url_facebook', 'type' => 'url' ],
                                        // [ 'name' => 'url_twitter', 'type' => 'url' ],
                                        // [ 'name' => 'url_linkedin', 'type' => 'url' ],
                                        // [ 'name' => 'profile_privecy' ],
                                        // [ 'name' => 'address' ],
                                        // [ 'name' => 'bio' ],
                                        // [ 'name' => 'login_count' ],
                                        // [ 'name' => 'last_login', 'type' => 'datetime' ],
                                        // [ 'name' => 'last_ip' ],
                                    ]; ?>
                                    @foreach ($fields_array as $field)
                                        <tr>
                                            @php
                                            $field_name = $field['name'];
                                            $field_type = isset($field['type'])? $field['type'] : '';
                                            @endphp

                                            <th>{{ __("labels.backend.users.fields.".$field_name) }}</th>

                                            @if ($field_name == 'date_of_birth' && $userprofile->$field_name != '')
                                            <td>
                                                @if(auth()->user()->id == $userprofile->user_id)
                                                {{ $userprofile->$field_name->isoFormat('LL') }}
                                                @else
                                                {{ $userprofile->$field_name->format('jS \\of F') }}
                                                @endif
                                            </td>
                                            @elseif ($field_type == 'date' && $userprofile->$field_name != '')
                                            <td>
                                                {{ $userprofile->$field_name->isoFormat('LL') }}
                                            </td>
                                            @elseif ($field_type == 'datetime' && $userprofile->$field_name != '')
                                            <td>
                                                {{ $userprofile->$field_name->isoFormat('llll') }}
                                            </td>
                                            @elseif ($field_type == 'url')
                                            <td>
                                                <a href="{{ $userprofile->$field_name }}" target="_blank">{{ $userprofile->$field_name }}</a>
                                            </td>
                                            @else
                                            <td>{{ $userprofile->$field_name }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push ("after-scripts")
<script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
@endpush

