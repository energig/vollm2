@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				<div class="card-header">Benutzer hinzuf&uuml;gen</div>

                <div class="card-body">
					
					<form action="{{ route('admin.users.store') }}" method="POST">
					
						<div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>						

						<div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>					
						

						<div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-right">Passwort</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('name') is-invalid @enderror" name="password" value="" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>					
						
						@csrf
						<div class="form-group row">
							<label for="roles" class="col-md-2 col-form-label text-md-right">Gruppen</label>
							<div class="col-md-6">
								@foreach($roles as $role)
									<div class="form-check">
										<input type="checkbox" name="roles[]" value="{{ $role->id }}">
										<label>{{ $role->name }} </label>
									</div>
								@endforeach
							</div>
						</div>
						<button type="submit" class="btn btn-primary">
							Hinzuf&uuml;gen
						</button>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
