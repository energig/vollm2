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
				<div class="card-header">Kundenstammdaten und Vollmacht ENERGO</div>

                <div class="card-body">
					
					<form action="{{ route('costumers.guestUpdateVertr', $costumer->id) }}" method="POST">
						<div class="form-group row justify-content-md-center">			
                            <div class="col-md-10">
								<p>Wir, die F. Leiter Mineralöle GmbH und ENERGO Energiedienstleistungen GmbH, kümmern uns gerne darum, Ihre Energielieferverträge jährlich zu einen der günstigsten Anbieter zu wechseln.
								Dadurch vermeiden wir auf Dauer schleichende Preissteigerungen.</p>
								<p>Um für Sie tätig werden zu können, setzen Sie bitte Ihre Daten in untenstehende Felder und bestätigen die Vollmacht durch Ihre Unterschrift. </p>
								
								<p>Unser Angebot ist <strong> jederzeit kündbar</strong> und die von Ihnen erteilte Vollmacht <strong>jederzeit widerrufbar</strong>. Ihre Daten werden ausnahmslos zur Verwaltung und Anmeldung Ihrer Anlagen sowie zur Rechnungslegung verwendet.</p>
								<p>Wir freuen uns auf eine gute Zusammenarbeit!</p>
								F. Leitner Mineralöle GmbH und ENERGO Energiedienstleistungen GmbH
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
                            <label for="titel_hinten" class="col-md-3 col-form-label text-md-right">Titel angeh.</label>

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
                            <label for="info" class="col-md-3 col-form-label text-md-right">Informationen (Z&auml;hlerst&auml;nde, etc)</label>

                            <div class="col-md-6">
								<textarea class="form-control @error('info') is-invalid @enderror" id="info" name="info" rows="3">{{ old('info', $costumer->info) }}</textarea>
                                @error('info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	

						<hr>

						<div class="form-group row">
                            <label for="pref_oekostrom" class="col-md-3 col-form-label text-md-right">100% &Ouml;kostrom</label>

                            <div class="col-md-6">
                                <input id="pref_oekostrom" type="checkbox" style="width:35px;" class="form-control @error('pref_oekostrom') is-invalid @enderror" name="pref_oekostrom" value="1" @if (old('unterschrift_base64', $costumer->unterschrift_base64)) checked @endif>

                                @error('pref_oekostrom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	

						<hr>

						<div class="form-group row">
                            <label for="konto_inhaber" class="col-md-3 col-form-label text-md-right">Kontoinhaber</label>

                            <div class="col-md-6">
                                <input id="konto_inhaber" type="text" class="form-control @error('konto_inhaber') is-invalid @enderror" name="konto_inhaber" value="{{ old('konto_inhaber', $costumer->konto_inhaber) }}">

                                @error('konto_inhaber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	

						<div class="form-group row">
                            <label for="konto_iban" class="col-md-3 col-form-label text-md-right">IBAN</label>

                            <div class="col-md-6">
                                <input id="konto_iban" type="text" class="form-control @error('konto_iban') is-invalid @enderror" name="konto_iban" value="{{ old('konto_iban', $costumer->konto_iban) }}">

                                @error('konto_iban')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	

						<hr>
						
						<div class="form-group row justify-content-md-center">			
                            <div class="col-md-10">
								<details>
									<summary>Vollmachtstext lesen</summary>
									<small><p>
									Mit dieser Vollmacht ermächtige/ermächtigen ich/wir (Vollmachtgeber) die ENERGO Energiedienstleistungen GmbH (FN 482457x , kurz ENERGO ), Ragnitzstraße 14, 8047 Graz, in meinem/
									unserem Namen und auf meine/unsere Rechnung Energielieferverträge für Strom und/oder Gas abzuschließen, zu kündigen, zu
									ändern und die hierzu notwendigen Vertragserklärungen sowie SEPA Lastschriftmandate abzugeben und zu unterfertigen sowie
									sämtliche Daten von Netzbetreibern/Energielieferanten anzufordern, Auskunft zu erhalten und die Datennutzungen beiNetzbetreibern/Energielieferanten zu widerrufen.
									</p>
									<p>
									Ich/Wir beauftrage /beauftragen ENERGO bis auf Widerruf für mich/uns die bestehenden Energielieferverträge für Strom und/
oder Gas mit am Markt günstigen Anbietern zu vergleichen und gegebenenfalls bei einem günstigeren Preis pro kWh den/die
bestehenden Vertrag/Verträge zu kündigen und bei einem günstigeren Anbieter einen neuen Liefervertrag in meinem/unserem
Namen und auf meine/unsere Rechnung abzuschließen.
									</p>
									<p>
									ENERGO wird dabei die Energielieferverträge für eine Laufzeit von maximal 12 Monaten abschließen und zumindest einmal
jährlich einen Preisvergleich mit anderen Anbietern am Markt oder eine diesbezügliche Ausschreibung durchführen.
									</p>
									<p>
Ich/Wir bin/sind in Kenntnis darüber, dass die ENERGO zum Beginn bzw . zur Durchführung ihrer Tätigkeit bei
bestehenden Lieferverträgen die aktuelle Jahresabrechnung des derzeitigen Energielieferanten in vollständigem Umfang
benötigt. ENERGO wird ihre Tätigkeit in der Gestalt ausüben, dass mir/uns aus der Kündigung oder Abänderung der
bestehenden Verträge kein wie immer gearteter Nachteil entsteht.									
									</p>
									<p>
Bei Neuanmeldungen wird ENERGO anhand der vom Kunden ausgewählten Kriterien über die Webseite der Energie -
Regulierungsbehörde (E-Control ) einen günstigen Anbieter wählen oder die Energieanlage des Kunden in der laufenden
Ausschreibung berücksichtigen .Wenn möglich präferiert ENERGO eine Gesamtrechnungslegung von Energie - und Netzkosten
sowie Steuern und Abgaben.									
									</p>
									<p>
Sollte ich/Sollten wir hinsichtlich der neu abgeschlossenen Energielieferverträge für Strom und/oder Gas von meinem/
unserem allenfalls zustehenden Rücktrittsrecht gemäß KSchG bzw. FAGG Gebrauch machen , gilt damit die gegenständliche
Vollmacht /der gegenständliche Auftrag als beendet und ich/wir verpflichte /verpflichten mich/uns ENERGO bei sonstigem
Schadenersatz unverzüglich von der Ausübung des Kündigungsrechtes per Einschreiben zu verständigen.									
									</p>
									
									<p>
Diese Vollmacht /dieser Auftrag kann jederzeit schriftlich per Einschreiben an ENERGO Energiedienstleistungen GmbH, 
Ragnitzstraße 14/7, 8047 Graz, widerrufen werden.									
									</p>
									
									<p>
									Ich/Wir bin/sind in Kenntnis darüber , dass durch den Widerruf dieser Vollmacht /dieses Auftrages die Verträge , welche in
meinem/unserem Namen mit dem jeweiligen Energielieferanten abgeschlossen wurden, nicht berührt werden.
									</p>
									
									<p>
Das Tätigwerden von ENERGO im Rahmen dieser Vollm acht/dieses Auftrages erfolgt für den Vollmachtgeber entgeltlich. ENERGO steht ein verbrauchsabhängiges 
Honorar zu. Das <strong>Honorar</strong> richtet sich nach dem Jahresverbrauch in Kilowattstunden und beträgt <strong>je Kilowattstunde netto 0,6ct bei Strom sowie netto 
0,35ct bei Gas (jeweils zuzügl . 20% USt.)</strong>. Das Honorar wird jährlich im Vorfeld mittels SEPA Mandat, nach Legung einer Akontorechnung , vom Konto 
des Kunden abgebucht. Grundlage für die Berechnung ist der vom Netzbetreiber vorgeschriebene, geschätzte Jahresverbrauch. Die Abrechnung und neue 
Vorschreibung des Honorars erfolgt jeweils Zug um Zug mit dem Einlangen von Abrechnungen der Energielieferanten anhand der enthaltenen Daten. 
Für das ENERGO zustehende Honorar wird ausdrücklich Wertbeständigkeit vereinbart . Als Maß zur Berechnung dient der seitens 
Statistik Austria monatlich verlautbarte Verbraucherpreisindex (VPI 2015) oder ein an seine Stelle tret end er Index.									
									</p>
									<p>
Für allfällige Streitigkeiten aus dieser Vollmacht/diesem Auftrag wird, sofern nicht zwingende gesetzliche Regeln entgegenstehen, als
Gerichtsstand Graz vereinbart. Es gilt österreichisches Recht.									
									</p>
									</small>
								</details>
							</div>
						</div>						
						

						<div class="form-group row justify-content-md-center">			
                            <div class="col-md-10">
								<details>
									<summary>SEPA-Mandat lesen</summary>
									<small>
									<p>
Ich ermächtige/Wir ermächtigen die ENERGO Energiedienstleistungen GmbH, Zahlungen von meinem/unserem Konto mittels SEPA-Lastschrift einzuziehen. 
Zugleich weise ich mein/unser Kreditinstitut an, die von ENERGO auf mein/unser Konto gezogenen SEPA-Lastschriften einzulösen. Ich kann/Wir können 
innerhalb von acht Wochen, beginnend mit dem Belastungsdatum, die Erstattung des belasteten Betrages verlangen. Es gelten dabei die mit
meinem/unserem Kreditinstitut vereinbarten Bedingungen. Die CreditorID von ENERGO lautet: AT08ZZZ00000059835
									</p>
									</small>
								</details>
							</div>
						</div>						
						
						<hr>

						<div class="form-group row">
							<input id="unterschrift_base64" type="hidden" name="unterschrift_base64" value="{{ old('unterschrift_base64', $costumer->unterschrift_base64) }}" >
							<signature-component ref="signaturePad"></signature-component>
							<div class="mx-auto col-md-8 justify-content-md-center">
								<small>
									<p class="text-center">
										<br>Mit meiner Unterschrift bestätige ich die Richtigkeit meiner Daten, sowie die Vollmacht und die Erteilung des SEPA-Mandats gelesen und verstanden zu haben.
									</p>
								</small>
							</div>
						</div>
						<hr>

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
