@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Benutzer
					@can('add-users')
						<a href="{{ route('admin.users.create') }}"><button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i></button></a>
					@endcan
				</div>					
					<table class="table">
					  <thead>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">Name</th>
						  <th scope="col">E-Mail</th>
						  <th scope="col">Gruppen</th>
						  <th scope="col">Actions</th>
						</tr>
					  </thead>
					  <tbody>

                <div class="card-body">
					@foreach ($users as $user)
							<tr>
							  <th scope="row">{{ $user->id }}</th>
							  <td>{{ $user->name }}</td>
							  <td>{{ $user->email }}</td>
							  <td>{{ implode( ', ', $user->roles()->get()->pluck('name')->toArray() )}}</td>
							  <td>
									@can('edit-users')
										<a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left"><i class="fas fa-edit"></i></button></a>
									@endcan
									@can('delete-users')
									<form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="float-left">
										@csrf
										{{ method_field('DELETE') }}
										<button type="submit" class="btn btn-warning"><i class="fas fa-trash"></i></button></a>
									</form>
									@endcan
							  </td>
							</tr>
					@endforeach
					  </tbody>
					</table>
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
