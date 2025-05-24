<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    /**
     * Función para listar todos los productos y devolver la vista con ellos
     */
    public function index()
    {
        $productos = Product::all();
        return view('showProducts', compact('productos'));
    }

    /**
     * Función para mostrar productos en la vista que cumplan ciertas condiciones.
     */
    public function showProduct()
    {
        // Traer todos los productos
        $productos = Product::inRandomOrder()->take(6)->get();

        // Traer las categorías padre con sus subcategorías
        $categoriasPadre = Category::with('children')->whereNull('padre_id')->take(3)->get();

        // Traer las subcategorías sin padre (Carnes, Verduras, etc.)
        $categoriasSinPadre = Category::whereNull('padre_id')->whereIn('nombre', ['Carnes', 'Verduras', 'Precocinados', 'Conservas'])->get();

        return view('index', [
            'productos' => $productos,
            'categoriasPadre' => $categoriasPadre,
            'categoriasSinPadre' => $categoriasSinPadre
        ]);
    }

    /**
     * Función para mostrar productos dependiendo la categoría.
     */
    public function showByCategory($id)
    {
        // Buscar la categoría
        $categoria = Category::findOrFail($id);
        $nombreCategoria = $categoria->nombre;

        // Coger las categorías padre con sus subcategorías
        $categoriasPadre = Category::with('children')->whereNull('padre_id')->take(3)->get();

        // Coger las subcategorías sin padre (Carnes, Verduras, etc.)
        $categoriasSinPadre = Category::whereNull('padre_id')->whereIn('nombre', ['Carnes', 'Verduras', 'Precocinados', 'Conservas'])->get();

        // Si tiene subcategorías es una categoría padre
        if ($categoria->children()->exists()) {
            // Obtener los ids de la categoría padre y sus hijos
            $idsCategorias = $categoria->children->pluck('id')->toArray();
            $idsCategorias[] = $categoria->id; // Incluir también la categoría padre

            // Obtener los productos de esas categorías
            $productos = Product::whereIn('categoria_id', $idsCategorias)->get();
        } else {
            // Si no tiene hijos, solo mostrar los productos de esa categoría
            $productos = Product::where('categoria_id', $categoria->id)->get();
        }

        return view('index', [
            'productos' => $productos,
            'categoria' => $categoria,
            'nombreCategoria' => $nombreCategoria,
            'categoriasPadre' => $categoriasPadre,
            'categoriasSinPadre' => $categoriasSinPadre
        ]);
    }

    /**
     * Función para mostrar la vista de crear un producto (pasándole las categorías)
     */
    public function create()
    {
        $categorias = Category::all();
        return view('editProduct', compact('categorias'));
    }

    /**
     * Función para validar la creación de un producto
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',

            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'imagen.max' => 'La imagen no debe superar los 2 MB.',

            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ]);

        $imagenPath = null;

        if ($request->hasFile('imagen')) { // Verifico si se ha subido un archivo con el nombre 'imagen'
            $imagen = $request->file('imagen'); // Obtengo el archivo de la petición
            $extension = $imagen->getClientOriginalExtension(); // Capturo la extensión del archivo (jpg, png, etc.)

            // Formateo el nombre para evitar espacios y convertirlo a minúsculas
            $nombreFormateado = strtolower(str_replace(' ', '_', $request->nombre));
            $nombreImagen = $nombreFormateado . '.' . $extension; // Genero el nombre final con la extensión

            // Muevo la imagen a la carpeta 'public/img' y la guardo con el nuevo nombre
            $imagen->move(public_path('img'), $nombreImagen);

            // Almaceno la ruta de la imagen para poder usarla después
            $imagenPath = 'img/' . $nombreImagen;
        }


        Product::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen_url' => $imagenPath,
            'categoria_id' => $request->categoria_id
        ]);

        return redirect()->route('showProducts')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Función para mostrar la vista de editar un producto (pasándole las categorías)
     */
    public function edit($id)
    {
        $producto = Product::findOrFail($id);
        $categorias = Category::all();

        return view('editProduct', compact('producto', 'categorias'));
    }

    /**
     * Función para validar la actualización de un producto
     */
    public function update(Request $request, $id)
    {
        $producto = Product::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',

            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'imagen.max' => 'La imagen no debe superar los 2 MB.',

            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ]);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $nombreFormateado = strtolower(str_replace(' ', '_', $request->nombre));
            $nombreImagen = $nombreFormateado . '.' . $extension;
            $imagen->move(public_path('img'), $nombreImagen);
            $producto->imagen_url = 'img/' . $nombreImagen;
        }

        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id
        ]);

        //Actualizar los cambios
        $producto->save();

        return redirect()->route('showProducts')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Función para borrar un producto
     */
    public function destroy($id)
    {
        $producto = Product::findOrFail($id);
        $producto->delete();

        return redirect()->route('showProducts')->with('success', 'Producto eliminado correctamente.');
    }

}
