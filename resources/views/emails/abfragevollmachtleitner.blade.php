<!DOCTYPE html>

<html>

<head>

    <title>$details['title']</title>

</head>

<body>

    <h1>{{ $details['title'] }}</h1>

    <p>Sehr
		@if($details['anrede']=='Frau')
			geehrte Frau
		@elseif($details['anrede']=='Herr')
			geehrter Herr
		@else
			geehrte Damen und Herren der
		@endif
		{{ $details['name'] }}!
	</p>
	<p>
		Vorweg darf ich mich für Ihr Interesse an unserer Kundenaktion „ENERGIEPOOL“ bedanken.
	</p>
	<p>Um Ihnen das Einsparungspotenzial <strong>unverbindlich</strong> aufzuzeigen, darf ich Sie bitten mir Ihre letzte Strom-Jahresabrechnung zukommen zu lassen.
	</p>
	<p>
		Sollte Ihnen die Zusendung nicht möglich sein, können Sie uns über den nachstehenden Link die Erlaubnis erteilen ein Rechnungsduplikat bei Ihrem aktuellen Lieferanten anzufordern.
	</p>
	<p>
		<a href="{{ route('costumers.signabfr', ['urlstr' => $details['url_abfragevollmacht']]) }}">Link zur Abfragevollmacht</a>
	</p>
	<p>
		noch Fragen?
	</p>
	<p>
		<a href="https://www.energiepool.at/energo-leitner">Fakten zum Energiepool</a>
    </p>
    <p>
		Wie geht es weiter?
	</p>
	<ul>
<li>Nach Erhalt Ihrer Abrechnung werden wir Ihnen ein <strong>unverbindliches Angebot</strong> mit der zu erzielenden jährlichen Einsparung zukommen lassen.</li>
<li>Erst dann entscheiden Sie, ob Sie von unserem Energiepool profitieren möchten.</li>
<li>Ab diesem Zeitpunkt kümmern wir uns Jahr für Jahr um einen günstigen Stromtarif für alle Poolmitglieder – <strong>ohne Aufwand, keine Bindung</strong></li>

	</ul>
	<p>
		Mit bestem Dank für Ihr Vertrauen,<br>
	</p>

	<p><br></p>

	<p>
	Siegfried Garabits<br>
	<br>
	F. Leitner Mineralöle GmbH<br>
	Kärntner Strasse 4<br>
	8020 Graz, Austria
	</p>
	<p>
	tel   +43 (0) 316 777 14<br>
	mail  s.garabits@leitner-mineraloele.at<br>
	web   www.leitner-mineraloele.at
	</p>
	<span style="font-size:10px;"><p>
	Diese Nachricht kann privilegierte, vertrauliche Informationen enthalten. Sofern Sie nicht der Adressat, ein Angestellter oder Vertreter des Adressaten sind, sind Sie nicht autorisiert, diese Nachricht, die angeschlossenen Dateien oder irgendeinen Teil davon zu lesen, zu drucken, zu speichern, zu kopieren, zu veröffentlichen oder weiterzugeben. Haben Sie diese Nachricht irrtümlich erhalten, bitte verständigen Sie uns umgehend per E-Mail und vernichten Sie alle erhaltenen oder allenfalls angefertigten Kopien (einschließlich elektronische) dieser Nachricht sowie deren Anlagen.</p>
	<p>
	This message is intended for the exclusive use of the addressee. It may contain confidential communication or may otherwise be privileged or confidential. If you are not the intended recipient, the recipient's agent or responsible for the delivery of this message to the intended recipient, you are hereby notified that you have received this message and / or attachments in error; any review, dissemination, distribution or copying of this message and / or attachments is strictly prohibited. If you have received this message and/or attachments in error, please notify us immediately by telephone or email and immediately delete this message and all its attachments.</p>
	<p style="color:green;">Please consider the environment before printing this email</p>
	</span>
</body>

</html>
