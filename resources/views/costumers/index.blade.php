@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Kunden
					@can('add-costumers')
						<a href="{{ route('costumers.create') }}"><button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i></button></a>
					@endcan
				</div>
					<table class="table">
					  <thead>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">Name</th>
						  <th scope="col">E-Mail</th>
						  <th scope="col">Mail VM<br> Abfrage</th>
						  <th scope="col">Mail VM<br> Beitritt</th>
						  <th scope="col">Aktion</th>
						</tr>
					  </thead>
					  <tbody>



                <div class="card-body">
					@foreach ($costumers as $costumer)
							<tr>
							  <th scope="row">{{ $costumer->id }}</th>
							  <td><a href="{{ route('costumers.show', $costumer->id) }}">{{ $costumer->name }}</a></td>
							  <td>{{ $costumer->email }}</td>
							  <td>
									@can('edit-costumers')
										@if((!$costumer->abfragevollmacht_checked) and (!$costumer->vertretungsvollmacht_checked))
                                            <a href="{{ route('costumers.sendabfrvm', $costumer->id) }}">
                                                <button type="button" class="btn @if($costumer->email_abfragevollmacht_sent) btn-link @else btn-primary @endif float-left">
                                                    <i class="fas fa-paper-plane"></i>
                                                    <span style="font-size:50%;">{{ $costumer->email_abfragevollmacht_sent }}</span>
                                                </button>
                                            </a>
										@endif
									@endcan
							  </td>
							  <td>
									@can('edit-costumers')
										@if(!$costumer->vertretungsvollmacht_checked)
                                            <a href="{{ route('costumers.sendvertrvm', $costumer->id) }}">
                                                <button type="button" class="btn @if($costumer->email_vertretungsvollmacht_sent) btn-link @else btn-primary @endif float-left">
                                                    <i class="fas fa-paper-plane"></i>
                                                    <span style="font-size:50%;">{{ $costumer->email_vertretungsvollmacht_sent }}</span>
                                                </button>
                                            </a>
										@endif
									@endcan
							  </td>
							  <td>
									@can('edit-costumers')
										<a href="{{ route('costumers.edit', $costumer->id) }}"><button type="button" class="btn btn-primary float-left"><i class="fas fa-edit"></i></button></a>
									@endcan
									@can('delete-costumers')
									<form action="{{ route('costumers.destroy', $costumer->id) }}" method="POST" class="float-left">
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
