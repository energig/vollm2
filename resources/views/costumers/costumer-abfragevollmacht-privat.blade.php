<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

	<title>ENERGO Abfragevollmacht Privatkunden</title>

    <link href="{{ asset('css/print-vm.css') }}" rel="stylesheet">
    <!-- <link rel='stylesheet' type='text/css' href='css/print.css' media="print" /> -->
</head>

<body>
	<div id="page-wrap">

		<div id="identity">

            <div id="formtitle">
				<h2>&nbsp;</h2>
				<h2>Vollmacht/Auftrag</h2>
                <p>&nbsp;</p>
                <p>Mit dieser Vollmacht ermächtige/ermächtigen ich/wir (Vollmachtgeber)</p>

                <div class="section">
                    <table class="vmtable">
                        <tr>
                            <td><strong>Name</strong></td><td class="uline"> {{ $costumer->name }} </td>
                        </tr>
                        <tr>
                            <td><strong>Geb.-Dat.</strong></td><td class="uline"> {{ $costumer->geburtsdatum }} </td>
                        </tr>
                        <tr>
                            <td><strong>Adresse</strong></td><td class="uline"> {{ $costumer->adresse_strasse }}, {{ $costumer->adresse_plz }} {{ $costumer->adresse_stadt }}</td>
                        </tr>
                        <tr>
                            <td><strong>Mail</strong></td><td class="uline"> {{ $costumer->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Telefon</strong></td><td class="uline"> {{ $costumer->tel }}</td>
                        </tr>
                    </table>
                </div>
			</div>

            <div id="logo">
              <img id="image" src="{{ asset('images/20200710-logo-gruen-400.jpg') }}" alt="Energo Logo" />
            </div>

		</div>

		<div class="cleardiv margtop"></div>

		<div class="section just margtop smalltext80">
            <p>&nbsp;</p>
            <p>
                die ENERGO Energiedienstleistungen GmbH, FN 482457x, Hallerschloßstraße 3, 8010 Graz, zur Anforderung eines Datenauszuges
                im .xls- Format zu meinen/unseren GAS/STROM Anlagen bei dem jeweiligen Netzbetreiber/Energielieferanten bzw. ist es der
                ENERGO Energiedienstleistungen auch erlaubt in meinem/unserem Namen Kopien der letzjährigen Energieabrechnungen und Vertragswerke
                bei dem jeweiligen Netzbetreiber/Energielieferanten anzufordern, einzusehen und sich auf dem Postweg oder
                mittels Email zusenden zu lassen.
            </p>
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
