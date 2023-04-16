CREATE SCHEMA `usuarios_web`;

CREATE TABLE `opciones` (
  `id` int(11) NOT NULL,
  `opcion` int(11) NOT NULL,
  `descripcion` varchar(10000) NOT NULL,
  `validacion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(10000) NOT NULL,
  `opcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `revision` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(10000) NOT NULL,
  `opcion` varchar(1000) NOT NULL,
  `validacion` varchar(10) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL,
  `token` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `resultados` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `nota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opcion` (`opcion`),
  ADD KEY `opcion_2` (`opcion`);

ALTER TABLE `revision`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`,`usuario`);

ALTER TABLE `revision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=628;

ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`opcion`) REFERENCES `opciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
ALTER TABLE `revision`
  ADD CONSTRAINT `revision_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;