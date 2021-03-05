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
		Vielen Dank für Ihr Interesse an unserem Energiepool.
	</p>
	<p>
		Die Firmen F. Leitner und ENERGO haben es sich zur Aufgabe gemacht, ihren Kunden gegenüber Energielieferanten bestmöglich zu vertreten bzw. dafür zu sorgen, diese individuell jährlich in einen der günstigsten Energielieferverträge Österreichs zu wechseln.

		Sollten Sie eine Anmeldung über ENERGO wünschen, geben Sie bitte unter folgendem Link Ihre Daten bekannt und bestätigen Sie die Vollmacht.

	<p>
		<a href="{{ route('costumers.signvertr', ['urlstr' => $details['url_vertretungsvollmacht']]) }}">Link zur Vertretungsvollmacht</a>
	</p>
	<p>
		Wenn Sie noch Informationen benötigen, finden Sie diese unter www.energiepool.at oder telefonisch bei ENERGO unter +43 (0) 720 516377. 	</p>
	</p>
	<p><br>
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
