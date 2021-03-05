<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use PDF;

class Costumer extends Model
{
    use Notifiable;

	protected $guarded = [];
	protected $dates = ['geburtsdatum'];

    //protected $fillable = [];

    // Storage folder for storing PDFs (Vollmachten, etc.)
    const PDFFOLDER = 'odoopdf';

    public function user(){
		return $this->belongsTo('App\User');
    }

    /**
     * Delete costumer, remove associated files, if any
     *
     * @return parent::delete()
     */
    public function delete()
    {
        if ($this->file_01) {
            if (Storage::exists($this->file_01)) {
                Storage::delete($this->file_01);
            }
        }
        if ($this->file_02) {
            if (Storage::exists($this->file_02)) {
                Storage::delete($this->file_02);
            }
        }
        if ($this->file_03) {
            if (Storage::exists($this->file_03)) {
                Storage::delete($this->file_03);
            }
        }

        return parent::delete();
    }

    /**
     * Create a PDF for Abfragevollmacht or Vertretungsvollmacht and Stammdatenblatt, save on filesystem, save filename in object.
     *
     * @return string $pathtofile
     */
    public function createPDFvollmacht()
    {
        $pdfdir = Costumer::PDFFOLDER;

        if ($this->anrede == "Firma") {
            if ($this->vertretungsvollmacht_checked) {
                $pdf_ksd = PDF::loadView('costumers.costumer-stammdatenblatt-gewerbe', array('costumer' => $this));
                $pdf_vvm = PDF::loadView('costumers.costumer-vertretungsvollmacht-gewerbe', array('costumer' => $this));
            }
            if ($this->abfragevollmacht_checked) {
                $pdf_avm = PDF::loadView('costumers.costumer-abfragevollmacht-gewerbe', array('costumer' => $this));
            }
        } else {
            if ($this->vertretungsvollmacht_checked) {
                $pdf_ksd = PDF::loadView('costumers.costumer-stammdatenblatt-privat', array('costumer' => $this));
                $pdf_vvm = PDF::loadView('costumers.costumer-vertretungsvollmacht-privat', array('costumer' => $this));
            }
            if ($this->abfragevollmacht_checked) {
                $pdf_avm = PDF::loadView('costumers.costumer-abfragevollmacht-privat', array('costumer' => $this));
            }
        }

        if (isset($pdf_ksd) && isset($pdf_vvm)) {
            $pathtoksd = $pdfdir . '/' . uniqid() . '.pdf';
            $ksdwritten = Storage::put($pathtoksd, $pdf_ksd->output());
            $pathtovvm = $pdfdir . '/' . uniqid() . '.pdf';
            $vvmwritten = Storage::put($pathtovvm, $pdf_vvm->output());
        }

        if (isset($pdf_avm)) {
            $pathtoavm = $pdfdir . '/' . uniqid() . '.pdf';
            $avmwritten = Storage::put($pathtoavm, $pdf_avm->output());
        }

        if (isset($ksdwritten) && isset($vvmwritten)) {
            // Delete previous files, if exist
            if ($this->file_01) {
                if (Storage::exists($this->file_01)) {
                    Storage::delete($this->file_01);
                }
            }
            if ($this->file_02) {
                if (Storage::exists($this->file_02)) {
                    Storage::delete($this->file_02);
                }
            }

            $this->file_01 = $pathtoksd;
            $this->file_02 = $pathtovvm;
        }

        if (isset($avmwritten)){
            // Delete previous file, if exist
            if ($this->file_03) {
                if (Storage::exists($this->file_03)) {
                    Storage::delete($this->file_03);
                }
            }

            $this->file_03 = $pathtoavm;
        }

        // Save on success, return true
        if ((isset($ksdwritten) && isset($vvmwritten)) || (isset($avmwritten))) {
            $this->save();
            return true;
        }

        return false;
    }

}
