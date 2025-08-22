CREATE TABLE `Direccion` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `ciudad` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `altura` int NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `Empleo` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255),
  `edad` tinyint NOT NULL,
  `dni` int NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `formacion` varchar(255) NOT NULL,
  `nombre_curso` varchar(255) NOT NULL,
  `description` text,
  `referencia_laboral` varchar(255),
  `referencia_rubro` varchar(255),
  `referencia_actividad` varchar(255),
  `contratista` varchar(255),
  `referencia_telefonica` varchar(15) NOT NULL,
  `cud` tinyint NOT NULL,
  `dependencia` tinyint NOT NULL,
  `cv_path` varchar(255),
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `Emprendedor` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria_id` int NOT NULL,
  `redes_id` bigint NOT NULL,
  `direccion_id` bigint NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `Categoria` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `categoria` categoria_id NOT NULL
);

CREATE TABLE `Failed_jobs` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `uuid` varchar(255),
  `CONNECTION` text,
  `queue` text,
  `payload` longtext,
  `exception` longtext,
  `failed_at` timestamp
);

CREATE TABLE `Horario` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `dia` varchar(255) NOT NULL,
  `hora_apertura` time,
  `hora_cierre` time,
  `participa_feria` tinyint NOT NULL,
  `cerrado` tinyint NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp,
  `emprendedor_id` bigint
);

CREATE TABLE `Imagen` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `emprendedor_id` bigint NOT NULL,
  `url` varchar(255) NOT NULL,
  `public_id` varchar(255) NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `Migration` (
  `id` int,
  `migration` varchar(255),
  `batch` int
);

CREATE TABLE `Model_has_permissions` (
  `permission_id` bigint,
  `model_type` varchar(255),
  `model_id` bigint
);

CREATE TABLE `Model_has_roles` (
  `role_id` bigint,
  `model_type` varchar(255),
  `model_id` bigint
);

CREATE TABLE `Noticia` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `Password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp
);

CREATE TABLE `Permissions` (
  `id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `Personal_access_tokens` (
  `id` bigint NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `Red` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `instagram` varchar(255),
  `facebook` varchar(255),
  `whatsapp` bigint NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `Rol` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `Rol_has_permissions` (
  `permission_id` bigint AUTO_INCREMENT,
  `role_id` bigint NOT NULL
);

CREATE TABLE `User` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp
);

ALTER TABLE `Rol_has_permissions` COMMENT = 'Composite primary key in SQL is simulated here';

ALTER TABLE `Emprendedor` ADD FOREIGN KEY (`redes_id`) REFERENCES `Red` (`id`);

ALTER TABLE `Emprendedor` ADD FOREIGN KEY (`categoria_id`) REFERENCES `Categoria` (`id`);

ALTER TABLE `Emprendedor` ADD FOREIGN KEY (`direccion_id`) REFERENCES `Direccion` (`id`);

ALTER TABLE `Horario` ADD FOREIGN KEY (`emprendedor_id`) REFERENCES `Emprendedor` (`id`);

ALTER TABLE `Imagen` ADD FOREIGN KEY (`emprendedor_id`) REFERENCES `Emprendedor` (`id`);

ALTER TABLE `Rol_has_permissions` ADD FOREIGN KEY (`permission_id`) REFERENCES `Permissions` (`id`);

ALTER TABLE `Rol_has_permissions` ADD FOREIGN KEY (`role_id`) REFERENCES `Rol` (`id`);

ALTER TABLE `Empleo` ADD FOREIGN KEY (`dni`) REFERENCES `Empleo` (`edad`);

ALTER TABLE `Failed_jobs` ADD FOREIGN KEY (`queue`) REFERENCES `Failed_jobs` (`id`);

ALTER TABLE `Model_has_roles` ADD FOREIGN KEY (`model_id`) REFERENCES `Model_has_permissions` (`model_id`);

ALTER TABLE `Empleo` ADD FOREIGN KEY (`nombre`) REFERENCES `Empleo` (`edad`);
