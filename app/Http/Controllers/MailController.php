<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Queueable, SerializesModels;
    public $nombre;
    public $correo;
    public $mensaje;
    public $asunto;
    public $archivo;
    public function __construct($nombre, $correo, $mensaje, $asunto, $archivo) 
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->mensaje = $mensaje;
        $this->asunto = $asunto;
        $this->archivo = $archivo;

        
    }
    public function index()
    {
        $email = new ContactMail('Alan','mago7410alan@gmail.com','Caducacon de documentos','Caducacion','nada');
        $email->attach(public_path('assets/images/Logo-utvt.png')); // Replace 'path_to_image.jpg' with the actual path to your image file
        $email->subject('Title in large letters');
        // $email->line('<a href="https://example.com">Link</a>');
        // $email->line('Text in smaller font');
        Mail::to('mago7410alan@gmail.com')->send($email);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
