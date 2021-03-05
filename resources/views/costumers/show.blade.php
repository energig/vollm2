@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				<div class="card-header">
					Kunde {{ $costumer->name }} anzeigen
					@can('manage-users', Auth::user())
						<div class="float-right"><small class="text-muted">{{ $costumer->user->name . " | " . $costumer->created_at }}</small></div>
					@endif
				</div>

                <div class="card-body">

						<div class="form-group row">
                            <label for="anrede" class="col-md-3 col-form-label text-md-right">Anrede</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->anrede }}
							</div>
                        </div>


						<div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->titel_vorne . " " . $costumer->name . " " . $costumer->titel_hinten }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="tel" class="col-md-3 col-form-label text-md-right">Telefon</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->tel }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="E-Mail" class="col-md-3 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->email }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="geburtsdatum" class="col-md-3 col-form-label text-md-right">Geburtsdatum</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->geburtsdatum }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="uid" class="col-md-3 col-form-label text-md-right">UID</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->uid }}
							</div>
                        </div>

						<hr>

						<div class="form-group row">
                            <label for="adresse_strasse" class="col-md-3 col-form-label text-md-right">Strasse</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->adresse_strasse }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="adresse_plz" class="col-md-3 col-form-label text-md-right">PLZ</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->adresse_plz }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="adresse_stadt" class="col-md-3 col-form-label text-md-right">Ort</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->adresse_stadt }}
							</div>
                        </div>

						<hr>

						<div class="form-group row">
                            <label for="zaehlernummer" class="col-md-3 col-form-label text-md-right">Z&auml;hlernummer</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->urspr_zaehlernummer }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="urspr_energielieferant" class="col-md-3 col-form-label text-md-right">Energielieferant</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->urspr_energielieferant }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="info" class="col-md-3 col-form-label text-md-right">Information</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->info }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="info" class="col-md-3 col-form-label text-md-right">Ökostrom</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								@if ($costumer->pref_oekostrom)
									100% Ökostrom
								@else
									Keine Präferenz
								@endif
							</div>
                        </div>

						<hr>

						<div class="form-group row">
                            <label for="konto_inhaber" class="col-md-3 col-form-label text-md-right">Kontoinhaber</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->konto_inhaber }}
							</div>
                        </div>

						<div class="form-group row">
                            <label for="konto_iban" class="col-md-3 col-form-label text-md-right">IBAN</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								{{ $costumer->konto_iban }}
							</div>
                        </div>

						<hr>

						<div class="form-group row">
                            <label for="info" class="col-md-3 col-form-label text-md-right">Abfragevollmacht</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								@if ($costumer->abfragevollmacht_checked)
                                    <a href="{{ route('costumers.downloadDocument', [$costumer->id, 'abfragevollmacht']) }}"> Abfragevollmacht </a>
								@else
									nicht bestätigt
								@endif
							</div>
                        </div>

						<div class="form-group row">
                            <label for="info" class="col-md-3 col-form-label text-md-right">Vertretungsvollmacht</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								@if ($costumer->vertretungsvollmacht_checked)
                                    <a href="{{ route('costumers.downloadDocument', [$costumer->id, 'stammdatenblatt']) }}"> Stammdatenblatt </a>,
                                    <a href="{{ route('costumers.downloadDocument', [$costumer->id, 'vertretungsvollmacht']) }}"> Vertretungsvollmacht </a>
								@else
									nicht bestätigt
								@endif
							</div>
                        </div>

						<hr>

						<div class="form-group row">
                            <label for="unterschrift" class="col-md-3 col-form-label text-md-right">Unterschrift</label>

                            <div class="col-md-6 font-weight-bold col-form-label">
								<img width="250" src="{{ $costumer->unterschrift_base64 }}">
							</div>
						</div>
						<hr>

						<div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right"></label>
							<div class="col-md-6">
								<a href="{{ url()->previous() }}"><button type="button" class="btn btn-warning">Zur&uuml;ck</button></a>
							</div>
						</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
