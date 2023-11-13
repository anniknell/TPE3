TOKEN:
    Para poder realizar acciones como POST, PUT o DELETE se requiere autenticacion por token.
    Endpoint api/user/token para solicitar el token
    Usuario: webadmin  Contraseña: admin
    Los datos deberan ser ingresados desde la seccion authorization de tipo Basic Auth. Al ingresarlos y enviar los datos, se obtendra el token, con el cual se debe ir al endpoint que requiera dicha autorización.
    Ejemplo: 
    Quiero intentar agregar un nuevo producto pero requiero de autorización para hacerlo. Voy a el endpoint indicado api/productos
    y en la parte de authorization ingreso el tipo Bearer Token, e ingreso la palabra Bearer seguido de el token obtenido previamente.


TABLA PRODUCTOS:

    Obtener todos los productos (GET):
        Descripción: Obtiene todos los productos disponibles en la tabla.
        Ruta: /productos
        Ejemplo:
            api/productos

    
    Obtener producto por ID (get):
        Descripción: Obtiene un producto en específico dado un ID.
        Ruta: /productos/:ID
        Ejemplo: 
            api/productos/12 (Va a traer el producto con el ID 12).


    Obtener productos ordenados ascendente o descendente (get):
        Descripción: Obtiene los productos de la tabla ordenados ascendentes o descendentes.
        Ruta: productos?order=:sentido
        Posibles sentidos:
        asc , desc
        Ejemplo:
        api/productos?order=asc


    Obtener productos ordenados por un campo (get):
        Descripción: Obtiene los productos ordenados por un campo, ya sea el ID del producto, su nombre, precio o descripción.
        Ruta: /productos?sort=:campo
        Posibles campos: 
        ProductoID, Nombre, Precio, Descripcion
        Ejemplo:
        api/productos?sort=Precio


    Obtener productos ordenados por campo ascendente o descendente (get):
        Descripción: Obtiene los productos ordenados ascendentes o descendentes por un campo, ya sea el ID del producto, su nombre, precio o descripción.
        Ruta: productos?sort=:campo&order=:sentido
        Posibles campos: 
        ProductoID, Nombre, Precio, Descripcion
        Posibles sentidos:
        asc , desc
        Ejemplo:
        api/productos?sort=Precio&order=desc


    Obtener productos filtrados (get):
        Descripción: Obtiene un producto segun el filtro que se haya colocado, por ejemplo, si quiero un productos que tenga de nombre "mochila" ingresaria lo siguiente:
            (api/productosfil?Nombre=Mochila)
        Ruta: /productosfil?:campo=:condicion
        Ejemplo: 
            api/productosfil?Nombre=Jean

    
    Agregar un nuevo producto (post):
        Descripción: Permite agregar un producto nuevo.
        Ruta: /productos
        Ejemplo:
        api/productos
        Body: {
        "Nombre": "Producto nuevo",
        "Precio": 1500.00,
        "Descripcion": "Hola",
        "CategoriaID": 2
        }


    Editar un producto (put):
        Descripción: Permite editar un producto ya existente.
        Ruta: /productos/:ID
        Ejemplo: 
        api/productos/12
        Body: {
        "Nombre": "Producto modificado",
        "Precio": 1400.00,
        "Descripcion": "Holaaa",
        "CategoriaID": 1
        }


TABLA CATEGORIAS:

    Obtener todas las categorias (get):
        Descripción: Obtiene todas las categorías disponibles en la tabla.
        Ruta: /categorias
        Ejemplo: 
        api/categorias

    Obtener una categoria segun su ID (get):
        Descripción: Obtiene una categoría en específico dado un ID.
        Ruta: /categorias/:ID
        Ejemplo:
        api/categorias/3

    Agregar una categoria (post):
        Descripción: Permite agregar una categoría nueva.
        Ruta: /categorias
        Ejemplo:
        api/categorias
        Body: {
        "Nombre": "Nueva categoría"
                    }


    Editar una categoria (put):
        Descripción: Permite editar una categoría ya existente.
        Ruta: /categorias/:ID
        Ejemplo:
        Ejemplo:
        api/categorias/4
        Body: {
        "Nombre": "Categoria modificada"
                    }
