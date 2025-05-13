<?php

namespace App\Http\Controllers;

use App\Http\errors\HandlerErrors;
use App\Http\Requests\contactRequest;
use App\Http\Requests\updateContact;
use App\Models\Contacto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $handlerErrors;

    public function __construct(HandlerErrors $handlerErrors)
    {
     $this->handlerErrors = $handlerErrors;
    }
    public function index() :JsonResponse
    {
        $contacts = Contacto::all();
        return response()->json($contacts,Response::HTTP_OK);
    }

    /**
     * Show the form for store a new resource.
     */
    public function store(contactRequest $request) :JsonResponse
    {
        try {
            $contact = Contacto::create($request->validated());
            return response()->json($contact, Response::HTTP_CREATED);
        }catch (\Exception $e){
            return $this->handlerErrors->handleError($e);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show( int $id) :JsonResponse
    {
        try {
            $find = Contacto::findOrFail($id);
            return  response()->json($find, Response::HTTP_OK);
        }catch (\Exception $e){
            return $this->handlerErrors->handleError($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
//    public function update(int $id, contactRequest $request) :JsonResponse
//    {
//        try {
//            $find = Contacto::findOrFail($id);
//        }
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id,updateContact $request) :JsonResponse
    {
        try {
            $find= Contacto::findOrFail($id);
            $find->update($request->validated());
            return response()->json($find, Response::HTTP_OK);
        }catch (\Exception $e){
            return $this->handlerErrors->handleError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $find = Contacto::findOrFail($id);
            $find->delete();
            return response()->json($find, Response::HTTP_OK);
        }catch (\Exception $e){
            return $this->handlerErrors->handleError($e);
        }
    }
}
