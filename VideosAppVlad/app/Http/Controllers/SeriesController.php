<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    /**
     * Display a listing of the series.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $series = Series::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->paginate(10); // Use pagination here

        // Verificar si hay resultados después del filtro
        if ($series->isEmpty() && $search) {
            return redirect()->route('series.manage.index')->with('error', 'No se encontraron series con ese nombre.');
        }

        return view('series.manage.index', compact('series'));
    }

    /**
     * Display the specified series.
     */
    public function show(Series $series)
    {
        return view('series.show', compact('series'));
    }

    public function create()
    {
        return view('series.manage.create');
    }

    /**
     * Store a newly created series in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
        ]);

        // Guardar la imagen si se subió
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('series_images', 'public');
        }

        // Agregar el nombre del usuario autenticado
        $validatedData['user_name'] = Auth::user()->name;

        // Agregar la URL de la foto del usuario si está disponible
        $validatedData['user_photo_url'] = Auth::user()->profile_photo_url ?? null;

        // Crear la serie en la base de datos
        Series::create($validatedData);

        // Redirigir a series.manage.index con un mensaje de éxito
        return redirect()->route('series.manage.index')->with('success', 'Serie creada exitosamente.');
    }

}
