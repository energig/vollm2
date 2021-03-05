<?php

namespace App\Http\Controllers;

use App\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Gate;
use Auth;
use Mail;
use App\Mail\vollMail;
use App\Mail\vollVertrMail;

class CostumersController extends Controller
{

    public function __construct() {
		$this->middleware('auth', ['except' => ['guestUpdate', 'guestUpdateVertr', 'guestEdit', 'guestEditVertr']]);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $costumers = Costumer::all();

		return view('costumers.index')->with('costumers', $costumers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('costumers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validatedData = $request->validate([
		  'anrede' => ['required', 'string'],
		  'titel_vorne' => ['nullable','string'],
		  'name' => ['required', 'string'],
		  'titel_hinten' => ['nullable','string'],
		  'email' => ['required', 'email', 'unique:costumers'],
		  'tel' => ['nullable', 'regex:/^(\+|\d)[0-9 ]{7,16}$/'],
		  'geburtsdatum' => ['nullable', 'date_format:d.m.Y'],
		  'uid' => ['nullable'],
		  'adresse_strasse' => ['nullable', 'string'],
		  'adresse_plz' => ['nullable', 'string'],
		  'adresse_stadt' => ['nullable', 'string'],
		  'urspr_zaehlernummer' => ['nullable', 'string'],
		  'urspr_energielieferant' => ['nullable', 'string'],
		  'info' => ['nullable', 'string'],
		],
		[
			'required' => 'Bitte Daten einsetzen',
		]);

		if (!($validatedData['geburtsdatum'] == null)) {
			$validatedData['geburtsdatum'] = date_format(date_create_from_format('j.n.Y', $validatedData['geburtsdatum']), 'Y-m-d');
		}

		$validatedData['url_abfragevollmacht'] = Str::random(12);
		$validatedData['url_vertretungsvollmacht'] = Str::random(12);

		$costumer = Costumer::create($validatedData);

        Log::channel('costumer')->info('Costumer added.', ['Name' => $costumer->name]);

		$costumer->user()->associate(Auth::user());

		if ($costumer->save()) {
			$request->session()->flash('success', 'Kunde ' . $costumer->name . ' erstellt');
		} else {
			$request->session()->flash('error', 'Fehler beim Erstellen des Kunden ' . $costumer->name);
		}

		return redirect()->route('costumers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function show(Costumer $costumer)
    {
        return view('costumers.show')->with('costumer', $costumer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function edit(Costumer $costumer)
    {
		if (Gate::denies('edit-costumers')) {
			return redirect(route('costumers.index'));
		}

		return view('costumers.edit')->with('costumer', $costumer);
    }

    /**
     * Show the form for editing the specified resource via stored URL.
     * Use: Signing Abfragevollmacht
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guestEdit(Request $request)
    {
		$url_abfragevollmacht = $request->urlstr;

		if ($url_abfragevollmacht) {
			$costumer = Costumer::where('url_abfragevollmacht', $url_abfragevollmacht)->where('abfragevollmacht_checked', false)->first();

			if ($costumer) {
                Log::channel('costumer')->info('Link Abfragevollmacht used.', ['ID' => $costumer->id, 'Name' => $costumer->name]);

                return view('costumers.editAbfr')->with('costumer', $costumer);
			} else {
				return view('welcome');
			}

		}
    }

    /**
     * Show the form for editing the specified resource via stored URL.
     * Use: Signing Vertretungsvollmacht/Beitritt
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guestEditVertr(Request $request)
    {
		$url_vertretungsvollmacht = $request->urlstr;

		if ($url_vertretungsvollmacht) {
			$costumer = Costumer::where('url_vertretungsvollmacht', $url_vertretungsvollmacht)->where('vertretungsvollmacht_checked', false)->first();

			if ($costumer) {
                Log::channel('costumer')->info('Link Vertretungsvollmacht used.', ['ID' => $costumer->id, 'Name' => $costumer->name]);
				return view('costumers.editVertr')->with('costumer', $costumer);
			} else {
				return view('welcome');
			}

		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Costumer $costumer)
    {
		$validatedData = $request->validate([
		  'anrede' => ['required', 'string'],
		  'titel_vorne' => ['nullable','string'],
		  'name' => ['required', 'string'],
		  'titel_hinten' => ['nullable','string'],
		  'email' => ['nullable', 'email', 'unique:costumers,email,'.$costumer->id],
		  'tel' => ['nullable', 'regex:/^(\+|\d)[0-9 ]{7,16}$/'],
		  'geburtsdatum' => ['nullable', 'date_format:d.m.Y'],
		  'uid' => ['nullable'],
		  'adresse_strasse' => ['nullable', 'string'],
		  'adresse_plz' => ['nullable', 'string'],
		  'adresse_stadt' => ['nullable', 'string'],
		  'urspr_zaehlernummer' => ['nullable', 'string'],
		  'urspr_energielieferant' => ['nullable', 'string'],
		  'info' => ['nullable', 'string'],
		],
		[
			'geburtsdatum.date_format' => 'Bitte das Format 01.01.1970 verwenden',
			'required' => 'Setzen Sie bitte hier Ihre Daten ein',
			'required_if' => 'Setzen Sie bitte hier Ihre Daten ein',
			'required_unless' => 'Setzen Sie bitte hier Ihre Daten ein',
		]);

		if ($validatedData['geburtsdatum'] == null) {
			unset($validatedData['geburtsdatum']);
		} else
		{
			$validatedData['geburtsdatum'] = date_format(date_create_from_format('d.m.Y', $validatedData['geburtsdatum']), 'Y-m-d');
		}

		if ($costumer->update($validatedData)) {
			$request->session()->flash('success', 'Kunde ' . $costumer->name . ' aktualisiert');
		} else {
			$request->session()->flash('error', 'Fehler beim Aktualisieren des Kunden ' . $costumer->name);
		}

		return redirect()->route('costumers.index');
    }

    /**
     * Update the specified resource in storage.
     * from view called by guestEdit
	 * Use: Abfragevollmacht
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function guestUpdate(Request $request, Costumer $costumer)
    {
		// Update as guest via url_abfragevollmacht

		$validatedData = $request->validate([
		  'anrede' => ['required', 'string'],
		  'titel_vorne' => ['nullable','string'],
		  'name' => ['required', 'string'],
		  'titel_hinten' => ['nullable','string'],
		  'email' => ['required', 'email', 'unique:costumers,email,'.$costumer->id],
		  'tel' => ['required', 'regex:/^(\+|\d)[0-9 ]{7,16}$/'],
		  'geburtsdatum' => ['required_unless:anrede,==,Firma','nullable', 'date_format:d.m.Y'],
		  'uid' => ['required_if:anrede,==,Firma','nullable'],
		  'adresse_strasse' => ['required', 'string'],
		  'adresse_plz' => ['required', 'string'],
		  'adresse_stadt' => ['required', 'string'],
		  'urspr_zaehlernummer' => ['required', 'string'],
		  'urspr_energielieferant' => ['required', 'string'],
		  'unterschrift_base64' => ['required', 'string'],
		],
		[
			'geburtsdatum.date_format' => 'Bitte das Format 01.01.1970 verwenden',
			'required' => 'Setzen Sie bitte hier Ihre Daten ein',
			'required_if' => 'Setzen Sie bitte hier Ihre Daten ein',
			'required_unless' => 'Setzen Sie bitte hier Ihre Daten ein',
		]);

		if ($validatedData['geburtsdatum']) $validatedData['geburtsdatum'] = date_format(date_create_from_format('d.m.Y', $validatedData['geburtsdatum']), 'Y-m-d');

		$costumer->abfragevollmacht_checked = true;
		$costumer->update($validatedData);

        // create PDF Abfragevollmacht
        $costumer->createPDFvollmacht();

        Log::channel('costumer')->info('Form Abfragevollmacht filled.', ['ID' => $costumer->id, 'Name' => $costumer->name]);

		return view('costumers.guesteditsuccess')->with('costumer', $costumer);
    }

    /**
     * Update the specified resource in storage.
	 * Use: Vertretungsvollmacht
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function guestUpdateVertr(Request $request, Costumer $costumer)
    {
		// Update as guest via url_vertretungsvollmacht

		$validatedData = $request->validate([
		  'anrede' => ['required', 'string'],
		  'titel_vorne' => ['nullable','string'],
		  'name' => ['required', 'string'],
		  'titel_hinten' => ['nullable','string'],
		  'email' => ['required', 'email', 'unique:costumers,email,'.$costumer->id],
		  'tel' => ['required', 'regex:/^(\+|\d)[0-9 ]{7,16}$/'],
		  'geburtsdatum' => ['required_unless:anrede,==,Firma','nullable', 'date_format:d.m.Y'],
		  'uid' => ['required_if:anrede,==,Firma','nullable'],
		  'adresse_strasse' => ['required', 'string'],
		  'adresse_plz' => ['required', 'string'],
		  'adresse_stadt' => ['required', 'string'],
		  'urspr_zaehlernummer' => ['required', 'string'],
		  'info' => ['nullable', 'string'],
		  'pref_oekostrom' => ['nullable'],
		  'konto_inhaber' => ['required', 'string'],
		  'konto_iban' => ['required', 'regex:/^AT[a-zA-Z0-9]{2}\s?([0-9]{4}\s?){4}\s?/'],
		  'unterschrift_base64' => ['required', 'string'],
		],
		[
			'geburtsdatum.date_format' => 'Bitte das Format 01.01.1970 verwenden',
			'required' => 'Setzen Sie bitte hier Ihre Daten ein',
			'required_if' => 'Setzen Sie bitte hier Ihre Daten ein',
			'required_unless' => 'Setzen Sie bitte hier Ihre Daten ein',
			'accepted' => 'Bitte bestätigen',
		]);

        if ($validatedData['geburtsdatum']) $validatedData['geburtsdatum'] = date_format(date_create_from_format('d.m.Y', $validatedData['geburtsdatum']), 'Y-m-d');

		$costumer->vertretungsvollmacht_checked = true;
        $costumer->update($validatedData);

        // create PDF Vertretungsvollmacht and Stammdatenblatt
        $costumer->createPDFvollmacht();

        Log::channel('costumer')->info('Form Vertretungsvollmacht filled.', ['ID' => $costumer->id, 'Name' => $costumer->name]);

		return view('costumers.guesteditsuccess')->with('costumer', $costumer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Costumer $costumer)
    {
		if (Gate::denies('delete-costumers')) {
			return redirect(route('costumers.index'));
		}

		if ($costumer->delete()) {
			$request->session()->flash('success', 'Kunde ' . $costumer->name . ' entfernt');
		} else {
			$request->session()->flash('error', 'Fehler beim Entfernen des Kunden ' . $costumer->name);
		}

        Log::channel('costumer')->info('Costumer deleted.', ['ID' => $costumer->id, 'Name' => $costumer->name]);

		return redirect()->route('costumers.index');
    }

    /**
     * Send E-Mail for editing and signing Abfragevollmacht.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function sendAbfragevollmacht(Request $request, Costumer $costumer)
    {
		if (Gate::denies('manage-costumers')) {
			return redirect(route('costumers.index'));
		}

		$details['title'] = '';
		$details['anrede'] = $costumer->anrede;
		$details['name'] = $costumer->name;
		$details['url_abfragevollmacht'] = $costumer->url_abfragevollmacht;
		Mail::to($costumer->email)->send(new vollMail($details));

		if (Mail::failures()) {
			$request->session()->flash('error', 'Fehler beim Senden des Formulars an ' . $costumer->name);
		} else {
            $request->session()->flash('success', 'Formular Abfragevollmacht an ' . $costumer->name . ' versendet');

            $costumer->email_abfragevollmacht_sent++;
            $costumer->save();
            Log::channel('costumer')->info('Mail Abfragevollmacht sent to user.', ['ID' => $costumer->id, 'Name' => $costumer->name]);
		}

		return redirect()->route('costumers.index');
    }

    /**
     * Send E-Mail for editing and signing Vertretungsvollmacht.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Costumer  $costumer
     * @return \Illuminate\Http\Response
     */
    public function sendVertretungsvollmacht(Request $request, Costumer $costumer)
    {
		if (Gate::denies('manage-costumers')) {
			return redirect(route('costumers.index'));
		}

		$details['title'] = '';
		$details['anrede'] = $costumer->anrede;
		$details['name'] = $costumer->name;
		$details['url_vertretungsvollmacht'] = $costumer->url_vertretungsvollmacht;
		Mail::to($costumer->email)->send(new vollVertrMail($details));

		if (Mail::failures()) {
			$request->session()->flash('error', 'Fehler beim Senden des Formulars an ' . $costumer->name);
		} else {
			$request->session()->flash('success', 'Formular Vertretungsvollmacht an ' . $costumer->name . ' versendet');
            $costumer->email_vertretungsvollmacht_sent++;
            $costumer->save();
            Log::channel('costumer')->info('Mail Vertretungsvollmacht sent to user.', ['ID' => $costumer->id, 'Name' => $costumer->name]);
		}

		return redirect()->route('costumers.index');
    }

    /**
     * Download costumer documents specified by URL
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadDocument(Request $request)
    {
        $document = $request->document;
        $costumer = Costumer::where('id', $request->costumer)->first();
        $filename = "";

        if ($costumer) {
            switch ($document) {
                case "stammdatenblatt":
                    $filename = $costumer->file_01;
                    $saveas = 'kundenstammdatenblatt';
                    break;
                case "vertretungsvollmacht":
                    $filename = $costumer->file_02;
                    $saveas = 'vertretungsvollmacht';
                    break;
                case "abfragevollmacht":
                    $filename = $costumer->file_03;
                    $saveas = 'abfragevollmacht';
                    break;
            }
        }

        if ($filename) {
            $saveas .= '-' . trim(preg_replace('#\W+#', '_', $costumer->name), '_');
            $saveas .= '.' . pathinfo($filename, PATHINFO_EXTENSION);

            return Storage::download($filename, $saveas);
        }

        abort(404);
    }

    /**
     * Create all costumers documents
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createAllDocuments(Request $request)
    {
        $costumers = Costumer::all();

        foreach ($costumers as $costumer) {
            $costumer->createPDFvollmacht();
            $request->session()->flash('success', 'PDFs erstellt für ' . $costumer->name );
        }

		return redirect()->route('costumers.index');
    }

}
