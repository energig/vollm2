@extends('layouts.app')

@section('content')

<script> 
	function hideFields() {
		let selanrede = document.getElementById('anrede');
		let divuid = document.getElementById('divuid');
		let divgebdat = document.getElementById('divgebdat');
		let divtitvor = document.getElementById('divtitvor');
		let divtithin = document.getElementById('divtithin');
		
		switch (selanrede.value) {
			case 'Herr' : 
			case 'Frau' :
				divuid.style.display = 'none';
				divgebdat.style.display = 'flex';
				divtitvor.style.display = 'flex';
				divtithin.style.display = 'flex';
				break;
			case 'Firma' :
				divuid.style.display = 'flex';
				divgebdat.style.display = 'none';
				divtitvor.style.display = 'none';
				divtithin.style.display = 'none';
				break;				
		}
	}
</script> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				<div class="card-header">Vollmacht für Verbrauchs- und Abrechnungsdaten</div>

                <div class="card-body">
					
					<form action="{{ route('costumers.guestUpdate', $costumer->id) }}" method="POST">
						<div class="form-group row justify-content-md-center">			
                            <div class="col-md-10">
								<p>Ich/Wir erteile(n) der ENERGO Energiedienstleistungen GmbH, Ragnitzstraße 14, 8047 Graz, die Vollmacht, mich/uns gegenüber Dritten in allen
								Angelegenheiten zu vertreten, die notwendig sind, um Verbrauchs- und Abrechnungsdaten der letzten drei Jahre ab Vollmachtsausstellung von
								Energielieferanten, Versorgern und Netzbetreibern, gemäß § 81 Abs 4 ElWOG 2010 und § 126 Abs 5 GWG 2011, zu erhalten.</p>
								<p>Diese Vollmacht umfasst insbesondere, diesbezüglich Anfragen und Anträge zu stellen sowie die Verbrauchs- und Abrechnungsdaten und
								Zustellungen aller Art zu eigenen Handen anzunehmen.</p>
								<p>Die von Ihnen erteilte Vollmacht und Ihre Daten dienen <strong>ausschliesslich</strong> der Abfrage eines Duplikats Ihrer Energieabrechnung und der Erstellung eines <strong>unverbindlichen</strong> Angebots.</p>
							</div>
						</div>
						
						<hr>
						
						<div class="form-group row">
                            <label for="anrede" class="col-md-3 col-form-label text-md-right">Anrede</label>

                            <div class="col-md-6">
                                
								<select id="anrede" class="form-control @error('anrede') is-invalid @enderror" name="anrede" required onchange="hideFields()">
									<option value="Herr" {{ old('anrede', $costumer->anrede) == 'Herr' ? 'selected="selected"' : '' }}>Herr</option>
									<option value="Frau" {{ old('anrede', $costumer->anrede) == 'Frau' ? 'selected="selected"' : '' }}>Frau</option>
									<option value="Firma" {{ old('anrede', $costumer->anrede) == 'Firma' ? 'selected="selected"' : '' }}>Firma</option>
								</select>

                                @error('anrede')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>					
						
						<div id="divtitvor" class="form-group row">
                            <label for="titel_vorne" class="col-md-3 col-form-label text-md-right">Titel</label>

                            <div class="col-md-6">
                                <input id="titel_vorne" type="text" class="form-control @error('titel_vorne') is-invalid @enderror" name="titel_vorne" value="{{ old('titel_vorne', $costumer->titel_vorne) }}" autofocus>

                                @error('titel_vorne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>					

						<div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $costumer->name) }}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>					

						<div id="divtithin" class="form-group row">
                            <label for="titel_hinten" class="col-md-3 col-form-label text-md-right">Titel postfix</label>

                            <div class="col-md-6">
                                <input id="titel_hinten" type="text" class="form-control @error('titel_hinten') is-invalid @enderror" name="titel_hinten" value="{{ old('titel_hinten', $costumer->titel_hinten) }}">

                                @error('titel_hinten')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>					
						
						<div class="form-group row">
                            <label for="tel" class="col-md-3 col-form-label text-md-right">Telefon</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel', $costumer->tel) }}">

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>							

						<div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $costumer->email) }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>						

						<div id="divgebdat" class="form-group row">
                            <label for="geburtsdatum" class="col-md-3 col-form-label text-md-right">Geb.-Datum</label>

                            <div class="col-md-6">
                                <input id="geburtsdatum" type="text" class="form-control @error('geburtsdatum') is-invalid @enderror" name="geburtsdatum" value="{{ old('geburtsdatum', $costumer->geburtsdatum ? $costumer->geburtsdatum->format('d.m.Y') : null ) }}">

                                @error('geburtsdatum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	
						
						<div id="divuid" class="form-group row">
                            <label for="uid" class="col-md-3 col-form-label text-md-right">UID</label>

                            <div class="col-md-6">
                                <input id="uid" type="text" class="form-control @error('uid') is-invalid @enderror" name="uid" value="{{ old('uid', $costumer->uid) }}">

                                @error('uid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>							
						
						<hr>

						<div class="form-group row">
                            <label for="adresse_strasse" class="col-md-3 col-form-label text-md-right">Stra&szlig;e Nr.</label>

                            <div class="col-md-6">
                                <input id="adresse_strasse" type="text" class="form-control @error('adresse_strasse') is-invalid @enderror" name="adresse_strasse" value="{{ old('adresse_strasse', $costumer->adresse_strasse) }}">

                                @error('uid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	
						
						<div class="form-group row">
                            <label for="adresse_plz" class="col-md-3 col-form-label text-md-right">PLZ</label>

                            <div class="col-md-6">
                                <input id="adresse_plz" type="text" class="form-control @error('adresse_plz') is-invalid @enderror" name="adresse_plz" value="{{ old('adresse_plz', $costumer->adresse_plz) }}">

                                @error('uid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	
						
						<div class="form-group row">
                            <label for="adresse_stadt" class="col-md-3 col-form-label text-md-right">Ort</label>

                            <div class="col-md-6">
                                <input id="adresse_stadt" type="text" class="form-control @error('adresse_stadt') is-invalid @enderror" name="adresse_stadt" value="{{ old('adresse_stadt', $costumer->adresse_stadt) }}">

                                @error('adresse_stadt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	
						
						<hr>

						<div class="form-group row">
                            <label for="urspr_zaehlernummer" class="col-md-3 col-form-label text-md-right">Z&auml;hlernummern</label>

                            <div class="col-md-6">
                                <input id="urspr_zaehlernummer" type="text" class="form-control @error('urspr_zaehlernummer') is-invalid @enderror" name="urspr_zaehlernummer" value="{{ old('urspr_zaehlernummer', $costumer->urspr_zaehlernummer) }}">

                                @error('urspr_zaehlernummer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	

						<div class="form-group row">
                            <label for="urspr_energielieferant" class="col-md-3 col-form-label text-md-right">Energielieferant</label>

                            <div class="col-md-6">
                                <input id="urspr_energielieferant" type="text" class="form-control @error('urspr_energielieferant') is-invalid @enderror" name="urspr_energielieferant" value="{{ old('urspr_energielieferant', $costumer->urspr_energielieferant) }}">

                                @error('urspr_energielieferant')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	

						<hr>

						@if(!Auth::user())
							<div class="form-group row">
								<input id="unterschrift_base64" type="hidden" name="unterschrift_base64" value="{{ old('unterschrift_base64', $costumer->unterschrift_base64) }}" >
								<signature-component ref="signaturePad"></signature-component>
							</div>
							<hr>
						@endif

						@csrf
						{{ method_field('PUT') }}
						<div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right"></label>
							<div class="col-md-6">
								<button onclick="return app.clearPad();" type="submit" class="btn btn-primary">Absenden</button>								
							</div>
						</div>
						<script>
							hideFields();
						</script>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
