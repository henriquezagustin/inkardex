use `inkardexdb`;

-- --------------------------------------------------------

--
-- Consultas directas
--

SELECT * FROM `usuarios`;
SELECT count(t.`id`) as 'Total usuarios' FROM `usuarios` t;

SELECT * FROM `categorias`;
SELECT count(t.`id`) as 'Total categorias' FROM `categorias` t;

SELECT * FROM `productos`;
SELECT count(t.`id`) as 'Total productos' FROM `productos` t;

SELECT * FROM `ventas`;
SELECT count(t.`id`) as 'Total ventas' FROM `ventas` t;

-- --------------------------------------------------------

--
-- Consultas cruzadas
--

-- consultado la tabla productos

SELECT
	p.`id`, c.`nombre` as 'categoria', p.`nombre`, p.`cantidad` as 'existencia', p.`precio_venta` as 'valor'
	FROM `productos` p
    LEFT JOIN `categorias` c ON p.categoria_id = c.id;
    

-- filtrando la tabla productos por id

set @producto = 1;

SELECT
	p.`id`, c.`nombre` as 'categoria', p.`nombre`, p.`cantidad` as 'existencia', p.`precio_venta` as 'valor'
	FROM `productos` p
    LEFT JOIN `categorias` c ON p.categoria_id = c.id
    WHERE p.id = COALESCE(@producto, p.`id`);

-- consultando la tabla de ventas

SELECT
	v.`id`, p.`nombre`, v.`precio`, v.`fecha`
    FROM `ventas` v
    LEFT JOIN `productos` p ON v.`producto_id` = p.`id`;

-- consultando la tabla de ventas ordenada por fecha asc

SELECT
	v.`id`, p.`nombre`, v.`precio`, v.`fecha`
    FROM `ventas` v
    LEFT JOIN `productos` p ON v.`producto_id` = p.`id`    
    ORDER BY v.`fecha` ASC;

-- consultando las ventas registradas por usuario

SET @usuario = 2;

SELECT
	v.`id`, p.`nombre`, v.`precio`, v.`fecha`
    FROM `ventas` v
    LEFT JOIN `productos` p ON v.`producto_id` = p.`id`
    WHERE v.`usuario_id` = COALESCE(@usuario, v.`usuario_id`)
    ORDER BY v.`fecha` ASC;


