<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

	<title>ENERGO Kundenstammdatenblatt Privatkunden</title>

    <link href="{{ asset('css/print-vm.css') }}" rel="stylesheet">
    <!-- <link rel='stylesheet' type='text/css' href='css/print.css' media="print" /> -->
</head>

<body>
	<div id="page-wrap">

		<div id="identity">

            <div id="formtitle">
				<h2>Kundenstammdatenblatt</h2>
				<p>Formular senden an: service@energiepool.at</p>
			</div>

            <div id="logo">
              <img id="image" src="{{ asset('images/20200710-logo-gruen-400.jpg') }}" alt="Energo Logo" />
            </div>

		</div>

		<div class="cleardiv"></div>

		<div class="section">
			<h4>Kundendaten / Lieferadresse</h4>
			<table class="normtable">
				<tr>
				  <th>Anrede</th>
				  <th>Titel v.N.</th>
				  <th>Vorname</th>
				  <th>Nachname</th>
				  <th>Titel h.N.</th>
				</tr>
				<tr class="norm-row">
				  <td class="anrede">{{ $costumer->anrede }}</td>
				  <td class="titelvn">{{ $costumer->titel_vorne }}</td>
				  <td class="vorname"><?php $nameparts = explode(" ",$costumer->name,2); if (count($nameparts)) echo $nameparts[0]; ?></td>
				  <td class="nachname"><?php if (count($nameparts) > 1) echo $nameparts[1]; ?></td>
				  <td class="titelnn">{{ $costumer->titel_hinten }}</td>
				</tr>
			</table>
			<table class="normtable">
				<tr>
				  <th>Straßenname, Nummer, Stock, Stiege, Tür</th>
				  <th>PLZ</th>
				  <th>Ort</th>
				  <th>Geburtsdatum</th>
				</tr>
				<tr class="norm-row">
				  <td class="strasse">{{ $costumer->adresse_strasse }}</td>
				  <td class="plz"{{ $costumer->adresse_plz }}></td>
				  <td class="ort">{{ $costumer->adresse_stadt }}</td>
				  <td class="gebdat">{{ date('d.m.Y', strtotime($costumer->geburtsdatum)) }}</td>
				</tr>
			</table>
			<table class="normtable">
				<tr>
				  <th>Telefonnummer</th>
				  <th>E-Mail-Adresse</th>
				</tr>
				<tr class="norm-row">
				  <td class="telemail">{{ $costumer->tel }}</td>
				  <td class="telemail">{{ $costumer->email }}</td>
				</tr>
			</table>
		</div>

		<div class="section">
			<h4>Rechnungsadresse, falls abweichend</h4>
			<table class="normtable">
				<tr>
				  <th>Straßenname, Nummer, Stock, Stiege, Tür</th>
				  <th>PLZ</th>
				  <th>Ort</th>
				</tr>
				<tr class="norm-row">
				  <td class="strasse2">&nbsp;</td>
				  <td class="plz2"></td>
				  <td class="ort2"></td>
				</tr>
			</table>
		</div>

		<div class="section">
			<h4>Stromanschluss</h4>
			<!-- &#9744; &#9746; -->
			<span class="smalltext">@if($costumer->pref_oekostrom) X @else O @endif Ökostrom</span>
			&nbsp;&nbsp;&nbsp;
			<span class="smalltext">@if($costumer->pref_strom_aut) X @else O @endif 100% Österreichisches Unternehmen</span>

			<table class="normtable">
				<tr>
				  <th>Netzbetreiber</th>
				  <th>Kundennummer Energielieferant</th>
				  <th>Bisheriger Energielieferant</th>
				</tr>
				<tr class="norm-row">
				  <td class="drittel">&nbsp;</td>
				  <td class="drittel"></td>
				  <td class="drittel">{{ $costumer->urspr_energielieferant }}</td>
				</tr>
			</table>
			<table class="normtable">
				<tr>
				  <th>Zählernummer</th>
				  <th>Zählerstand</th>
				  <th>Jahresverbrauch (kWh)</th>
				</tr>
				<tr class="norm-row">
				  <td class="drittel">{{ $costumer->urspr_zaehlernummer }}&nbsp;</td>
				  <td class="drittel"> @if($costumer->info) {{$costumer->info}} @endif </td>
				  <td class="drittel"></td>
				</tr>
				<tr class="norm-row">
				  <td class="drittel">&nbsp;</td>
				  <td class="drittel"></td>
				  <td class="drittel"></td>
				</tr>
			</table>
		</div>

		<div class="section">
			<h4>Gasanschluss</h4>
			<span class="smalltext">O wird nicht benötigt</span>

			<table class="normtable">
				<tr>
				  <th>Netzbetreiber</th>
				  <th>Kundennummer Energielieferant</th>
				  <th>Bisheriger Energielieferant</th>
				</tr>
				<tr class="norm-row">
				  <td class="drittel">&nbsp;</td>
				  <td class="drittel"></td>
				  <td class="drittel"></td>
				</tr>
			</table>
			<table class="normtable">
				<tr>
				  <th>Zählernummer</th>
				  <th>Zählerstand</th>
				  <th>Jahresverbrauch (kWh)</th>
				</tr>
				<tr class="norm-row">
				  <td class="drittel">&nbsp;</td>
				  <td class="drittel"></td>
				  <td class="drittel"></td>
				</tr>
			</table>
		</div>

		<div class="section">
			<h4>SEPA-Lastschriftmandat</h4>

			<table class="normtable">
				<tr>
				  <th>Kontoinhaber</th>
				  <th>IBAN</th>
				  <th>BIC</th>
				</tr>
				<tr class="norm-row">
				  <td class="drittel">{{ $costumer->konto_inhaber }}&nbsp;</td>
				  <td class="drittel">{{ $costumer->konto_iban }}</td>
				  <td class="drittel">{{ $costumer->konto_bic }}</td>
				</tr>
			</table>
		</div>

		<div class="section smalltext">
			Ich ermächtige/Wir ermächtigen die ENERGO Energiedienstleistungen GmbH, Zahlungen von meinem/unserem Konto mittels SEPA-Lastschrift einzuziehen.
			Zugleich weise ich mein/unser Kreditinstitut an, die von ENERGO auf mein/unser Konto gezogenen SEPA-Lastschriften einzulösen. Ich kann/Wir können
			innerhalb von acht Wochen, beginnend mit dem Belastungsdatum, die Erstattung des belasteten Betrages verlangen. Es gelten dabei die mit
			meinem/unserem Kreditinstitut vereinbarten Bedingungen. Die CreditorID von ENERGO lautet: AT08ZZZ00000059835
		</div>

		<div class="section">
			<table class="uschrifttable">
				<tr>
                    <td class="uschrift"><?php echo date('d.m.Y'); ?></td>
                    <td class="uschriftspace"></td>
                    <td class="uschrift"><img width="250" src="{{ $costumer->unterschrift_base64 }}"></td>
                  </tr>
                  <tr>
				  <td class="uschriftlabel">Datum</td>
				  <td class="uschriftspace"></td>
				  <td class="uschriftlabel">Unterschrift Kunde/Kundin</td>
				</tr>
			</table>
		</div>

		<div id="footer">
		  ENERGO Energiedienstleistungen GmbH | Ragnitzstraße 14/7, 8047 Graz | +43 (0) 720 516377 | service@energiepool.at | www.energiepool.at
		</div>

	</div>

</body>

</html>
