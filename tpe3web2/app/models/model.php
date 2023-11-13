<?php
  require_once 'config.php';
    class Model {
        protected $db;
 
        function __construct() {
          $this->db = new PDO('mysql:host='. MYSQL_HOST.';charset=utf8', MYSQL_USER, MYSQL_PASS);
          if($this->db){
            $this->createDatabaseSiNoExiste();
            $this->db->exec('USE ' . MYSQL_DB);
            $this->deploy();
          }
          
        }

      function createDatabaseSiNoExiste() {
          $databaseName = MYSQL_DB;
          $query = "CREATE DATABASE IF NOT EXISTS `$databaseName` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
          $this->db->exec($query);
          
      }

        function deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();

            $meOJ2PSOLv1iU1lnr2U7yu0BQXWzBG='$meOJ2PSOLv1iU1lnr2U7yu0BQXWzBG';
            
            if(count($tables)==0) {
              $sql =<<<END
                -- Estructura de tabla para la tabla `categoria`
                --

                CREATE TABLE `categoria` (
                `CategoriaID` int(11) NOT NULL,
                `Nombre` varchar(255) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `categoria`
                --

                INSERT INTO `categoria` (`CategoriaID`, `Nombre`) VALUES
                (1, 'Partes de arriba'),
                (2, 'Partes de abajo'),
                (3, 'Calzado'),
                (4, 'Accesorios');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `producto`
                --

                CREATE TABLE `producto` (
                `ProductoID` int(11) NOT NULL,
                `Nombre` varchar(255) NOT NULL,
                `Descripcion` text DEFAULT NULL,
                `Precio` decimal(10,2) NOT NULL,
                `CategoriaID` int(11) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `producto`
                --

                INSERT INTO `producto` (`ProductoID`, `Nombre`, `Descripcion`, `Precio`, `CategoriaID`) VALUES
                (12, 'Holaaaaa', 'anlkgfniopñajmgkpmapignpiag', 2500.00, 4),
                (17, 'Jean Oxford', 'Negro, 38', 27000.00, 2),
                (18, 'Pantalón cargo', 'Crudo, 40', 27000.00, 2),
                (19, 'Mochila', 'Negro', 18000.00, 4),
                (20, 'Gorro beanie', 'Blanco', 15000.00, 4),
                (21, 'Zapatillas de lona', 'Rojo, 36', 30000.00, 3),
                (22, 'Mocasines', 'Marrón, 42', 35000.00, 3),
                (30, 'AAAAAAAAAAAAAA', 'Blanca, XS', 13131331.00, 3),
                (31, 'chau', 'Rojo, M', 131331.00, 3),
                (37, 'Buzo increible', 'Negro, 38', 27000.00, 1),
                (38, 'Buzo increible', 'Negro', 99999999.99, 1),
                (39, 'Buzo increible', 'Negro', 99999999.99, 1),
                (40, 'HOLAAAA', 'AZUL', 2700.00, 4);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `usuarios`
                --

                CREATE TABLE `usuarios` (
                `id` int(11) NOT NULL,
                `usuario` varchar(255) NOT NULL,
                `password` varchar(255) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `usuarios`
                --

                INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
                (1, 'annitaknell@hotmail.com', 'zsxvbbfd'),
                (5, 'anna', '1234567'),
                (6, 'admin', 'admin'),
                (7, 'webadmin', '$2y$10$meOJ2PSOLv1iU1lnr2U7yu0BQXWzBG/N3XN8kQAAc0cW4tFyajU/G');

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `categoria`
                --
                ALTER TABLE `categoria`
                ADD PRIMARY KEY (`CategoriaID`);

                --
                -- Indices de la tabla `producto`
                --
                ALTER TABLE `producto`
                ADD PRIMARY KEY (`ProductoID`),
                ADD KEY `CategoriaID` (`CategoriaID`);

                --
                -- Indices de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                ADD PRIMARY KEY (`id`),
                ADD UNIQUE KEY `email` (`usuario`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `categoria`
                --
                ALTER TABLE `categoria`
                MODIFY `CategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

                --
                -- AUTO_INCREMENT de la tabla `producto`
                --
                ALTER TABLE `producto`
                MODIFY `ProductoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

                --
                -- AUTO_INCREMENT de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `producto`
                --
                ALTER TABLE `producto`
                ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`CategoriaID`) REFERENCES `categoria` (`CategoriaID`),
                ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`CategoriaID`) REFERENCES `categoria` (`CategoriaID`) ON DELETE CASCADE;
                COMMIT;
                
              END;
              $this->db->query($sql);
          }
        }
    }