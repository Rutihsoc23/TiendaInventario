<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Importa el modelo
use Illuminate\Http\Request; // Importa la clase Request

class ProductoController extends Controller
{
    /**
     * Muestra una lista de los productos.
     * [cite_start]Cumple con: "Listar productos" [cite: 12] [cite_start]y "Filtrar y ordenar" [cite: 14]
     */
    public function index(Request $request)
    {
        // Inicia la consulta
        $query = Producto::query();

        // 1. Filtrado (por nombre)
        if ($request->filled('filtro_nombre')) {
            $query->where('nombre', 'like', '%' . $request->filtro_nombre . '%');
        }

        // 2. Ordenamiento (por nombre y precio)
        if ($request->filled('ordenar_por')) {
            $direccion = $request->get('direccion', 'asc'); // 'asc' o 'desc'
            if (in_array($request->ordenar_por, ['nombre', 'precio'])) {
                $query->orderBy($request->ordenar_por, $direccion);
            }
        } else {
            // Orden por defecto
            $query->orderBy('nombre', 'asc');
        }

        // Obtiene los productos
        $productos = $query->paginate(10); // Pagina los resultados

        // Devuelve la vista con los productos
        // (Debes crear esta vista: resources/views/productos/index.blade.php)
        return view('productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     * (Este método solo muestra la vista del formulario)
     */
    public function create()
    {
        // (Debes crear esta vista: resources/views/productos/create.blade.php)
        return view('productos.create');
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     * [cite_start]Cumple con: "Registrar nuevos productos" [cite: 11] [cite_start]y "Validaciones" [cite: 20]
     */
    public function store(Request $request)
    {
        // 1. Validación de los campos
        $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0|max:100', // Asumiendo %
            'cantidad_stock' => 'required|integer|min:0',
        ]);

        // 2. Crear el producto (usa $fillable del modelo)
        Producto::create($request->all());

        // 3. Redirigir a la lista con un mensaje de éxito
        return redirect()->route('productos.index')
                         ->with('success', '¡Producto creado exitosamente!');
    }

    /**
     * Muestra un producto específico.
     * (Opcional, útil para una página de "detalles")
     */
    public function show(Producto $producto)
    {
        // (Debes crear esta vista: resources/views/productos/show.blade.php)
        return view('productos.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto.
     * [cite_start]Cumple con: "Editar... productos" [cite: 13]
     */
    public function edit(Producto $producto)
    {
        // (Debes crear esta vista: resources/views/productos/edit.blade.php)
        // Laravel automáticamente encuentra el producto por su ID
        return view('productos.edit', compact('producto'));
    }

    /**
     * Actualiza un producto específico en la base de datos.
     * [cite_start]Cumple con: "Editar... productos" [cite: 13]
     */
    public function update(Request $request, Producto $producto)
    {
        // 1. Validación (similar a store)
        $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0|max:100',
            'cantidad_stock' => 'required|integer|min:0',
        ]);

        // 2. Actualizar el producto
        $producto->update($request->all());

        // 3. Redirigir
        return redirect()->route('productos.index')
                         ->with('success', '¡Producto actualizado exitosamente!');
    }

    /**
     * Elimina un producto de la base de datos.
     * [cite_start]Cumple con: "Eliminar productos" [cite: 13]
     */
    public function destroy(Producto $producto)
    {
        // 1. Eliminar el producto
        $producto->delete();

        // 2. Redirigir
        return redirect()->route('productos.index')
                         ->with('success', '¡Producto eliminado exitosamente!');
    }
}
