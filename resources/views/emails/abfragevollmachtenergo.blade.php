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
		Vielen Dank für Ihr Interesse an unserem Energiepool!
	</p>
	<p>Wir von ENERGO haben es uns zur Aufgabe gemacht, unsere Kunden (Privatpersonen, Gewerbebetriebe und Hausverwaltungen) gegenüber Energielieferanten bestmöglich zu vertreten bzw. dafür zu sorgen, 
		diese individuell jährlich in einen der günstigsten Energielieferverträge Österreichs zu wechseln. 
	</p>
	<p>
		Um Ihnen Ihr mögliches Einsparungspotenzial aufzuzeigen, ersuchen wir Sie unter folgendem Link um Unterzeichnung der Vollmacht, damit wir die letzte Energieabrechnung von Ihrem derzeitigen Energielieferanten abfragen können.
	</p>
	<p>
		<a href="{{ route('costumers.signabfr', ['urlstr' => $details['url_abfragevollmacht']]) }}">Link zur Abfragevollmacht</a>
	</p>
	<p>		
		Wir werden Ihnen dann schnellstmöglich einen Tarifvergleich sowie unsere Unterlagen zum Poolbeitritt via E-Mail zukommen lassen. Sollten Sie sich in der Zwischenzeit nähere Informationen wünschen, finden Sie diese unter <a href="https://www.energiepool.at">www.energiepool.at</a>.   
	</p>
	<p>
		Mit bestem Dank für Ihr Vertrauen,<br>
		Ihre Energo Energiedienstleistungen GmbH
	</p>
	
	<p><br><br></p>
	
	<p>---</p>
	<p>
	ENERGO Energiedienstleistungen GmbH<br>
	Ragnitzstrasse 14<br>
	8047 Graz, Austria
	</p>
	<p>
	tel   +43 (0) 720 516377<br>
	mail  service@energiepool.at<br>
	web   www.energiepool.at
	</p>
	<span style="font-size:10px;"><p>
	Diese Nachricht kann privilegierte, vertrauliche Informationen enthalten. Sofern Sie nicht der Adressat, ein Angestellter oder Vertreter des Adressaten sind, sind Sie nicht autorisiert, diese Nachricht, die angeschlossenen Dateien oder irgendeinen Teil davon zu lesen, zu drucken, zu speichern, zu kopieren, zu veröffentlichen oder weiterzugeben. Haben Sie diese Nachricht irrtümlich erhalten, bitte verständigen Sie uns umgehend per E-Mail und vernichten Sie alle erhaltenen oder allenfalls angefertigten Kopien (einschließlich elektronische) dieser Nachricht sowie deren Anlagen.</p>
	<p>
	This message is intended for the exclusive use of the addressee. It may contain confidential communication or may otherwise be privileged or confidential. If you are not the intended recipient, the recipient's agent or responsible for the delivery of this message to the intended recipient, you are hereby notified that you have received this message and / or attachments in error; any review, dissemination, distribution or copying of this message and / or attachments is strictly prohibited. If you have received this message and/or attachments in error, please notify us immediately by telephone or email and immediately delete this message and all its attachments.</p>
	<p style="color:green;">Please consider the environment before printing this email</p>
	</span>	
</body>

</html>