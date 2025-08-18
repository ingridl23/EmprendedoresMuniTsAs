CREATE TABLE "Direccion" (
  "id" BIGINT GENERATED AS IDENTITY PRIMARY KEY,
  "ciudad" VARCHAR(255) NOT NULL,
  "localidad" VARCHAR(255) NOT NULL,
  "calle" VARCHAR(255) NOT NULL,
  "altura" INT(11) NOT NULL,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "Empleo" (
  "id" INT GENERATED AS IDENTITY PRIMARY KEY,
  "nombre" VARCHAR(255) NOT NULL,
  "asunto" VARCHAR(255) NOT NULL,
  "email" VARCHAR(255) NOT NULL,
  "telefono" VARCHAR(255),
  "edad" TINYINT(3) NOT NULL,
  "dni" INT(10) NOT NULL,
  "ciudad" VARCHAR(255) NOT NULL,
  "localidad" VARCHAR(255) NOT NULL,
  "formacion" VARCHAR(255) NOT NULL,
  "nombre_curso" VARCHAR(255) NOT NULL,
  "description" TEXT,
  "referencia_laboral" VARCHAR(255),
  "referencia_rubro" VARCHAR(255),
  "referencia_actividad" VARCHAR(255),
  "contratista" VARCHAR(255),
  "referencia_telefonica" VARCHAR(15) NOT NULL,
  "cud" TINYINT(1) NOT NULL,
  "dependencia" TINYINT(1) NOT NULL,
  "cv_path" VARCHAR(255),
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "Emprendedor" (
  "id" INT GENERATED AS IDENTITY PRIMARY KEY,
  "nombre" VARCHAR(255) NOT NULL,
  "descripcion" text NOT NULL,
  "categoria" VARCHAR(255) NOT NULL,
  "redes_id" BIGINT(20) NOT NULL,
  "direccion_id" BIGINT(20) NOT NULL,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "Failed_jobs" (
  "id" BIGINT(20) GENERATED AS IDENTITY PRIMARY KEY,
  "uuid" VARCHAR(255),
  "CONNECTION" text,
  "queue" text,
  "payload" longtext,
  "exception" longtext,
  "failed_at" TIMESTAMP
);

CREATE TABLE "Horario" (
  "id" BIGINT(20) GENERATED AS IDENTITY PRIMARY KEY,
  "dia" VARCHAR(255) NOT NULL,
  "hora_apertura" TIME,
  "hora_cierre" TIME,
  "participa_feria" TINYINT(1) NOT NULL,
  "cerrado" TINYINT(1) NOT NULL,
  "created_at" timestamp,
  "updated_at" TIMESTAMP,
  "emprendedor_id" BIGINT(20)
);

CREATE TABLE "Imagen" (
  "id" INT(10) GENERATED AS IDENTITY PRIMARY KEY,
  "emprendedor_id" BIGINT(20) NOT NULL,
  "url" VARCHAR(255) NOT NULL,
  "public_id" VARCHAR(255) NOT NULL,
  "created_at" timestamp,
  "updated_at" TIMESTAMP
);

CREATE TABLE "Migration" (
  "id" INT(10),
  "migration" VARCHAR(255),
  "batch" INT(11)
);

CREATE TABLE "Model_has_permissions" (
  "permission_id" BIGINT(20),
  "model_type" VARCHAR(255),
  "model_id" BIGINT(20)
);

CREATE TABLE "Model_has_roles" (
  "role_id" BIGINT(20),
  "model_type" VARCHAR(255),
  "model_id" BIGINT(20)
);

CREATE TABLE "Noticia" (
  "id" BIGINT(20) GENERATED AS IDENTITY PRIMARY KEY,
  "titulo" VARCHAR(255) NOT NULL,
  "descripcion" TEXT NOT NULL,
  "categoria" VARCHAR(255) NOT NULL,
  "imagen" VARCHAR(255) NOT NULL,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "Password_resets" (
  "email" VARCHAR(255) NOT NULL,
  "token" VARCHAR(255) NOT NULL,
  "created_at" timestamp
);

CREATE TABLE "Permissions" (
  "id" BIGINT(20) NOT NULL,
  "name" VARCHAR(255) NOT NULL,
  "guard_name" VARCHAR(255) NOT NULL,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "Personal_access_tokens" (
  "id" BIGINT(20) NOT NULL,
  "tokenable_type" VARCHAR(255) NOT NULL,
  "tokenable_id" BIGINT(20) NOT NULL,
  "name" VARCHAR(255) NOT NULL,
  "token" VARCHAR(64) NOT NULL,
  "abilities" TEXT,
  "last_used_at" TIMESTAMP,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "Red" (
  "id" BIGINT(20) GENERATED AS IDENTITY PRIMARY KEY,
  "instagram" VARCHAR(255),
  "facebook" VARCHAR(255),
  "whatsapp" BIGINT(20) NOT NULL,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "Rol" (
  "id" BIGINT(20) GENERATED AS IDENTITY PRIMARY KEY,
  "name" VARCHAR(255) NOT NULL,
  "guard_name" VARCHAR(255) NOT NULL,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "Rol_has_permissions" (
  "permission_id" BIGINT(20) GENERATED AS IDENTITY,
  "role_id" BIGINT(20) NOT NULL,
  PRIMARY KEY ("permission_id", "role_id")
);

CREATE TABLE "User" (
  "id" BIGINT(20) GENERATED AS IDENTITY PRIMARY KEY,
  "name" VARCHAR(255) NOT NULL,
  "email" VARCHAR(255) NOT NULL,
  "email_verified_at" TIMESTAMP,
  "password" VARCHAR(255) NOT NULL,
  "remember_token" VARCHAR(100) NOT NULL,
  "created_at" timestamp,
  "updated_at" timestamp
);

ALTER TABLE "Emprendedor" ADD FOREIGN KEY ("redes_id") REFERENCES "Red" ("id");

ALTER TABLE "Emprendedor" ADD FOREIGN KEY ("direccion_id") REFERENCES "Direccion" ("id");

ALTER TABLE "Horario" ADD FOREIGN KEY ("emprendedor_id") REFERENCES "Emprendedor" ("id");

ALTER TABLE "Imagen" ADD FOREIGN KEY ("emprendedor_id") REFERENCES "Emprendedor" ("id");

ALTER TABLE "Rol_has_permissions" ADD FOREIGN KEY ("permission_id") REFERENCES "Permissions" ("id");

ALTER TABLE "Rol_has_permissions" ADD FOREIGN KEY ("role_id") REFERENCES "Rol" ("id");

ALTER TABLE "Empleo" ADD FOREIGN KEY ("dni") REFERENCES "Empleo" ("edad");

ALTER TABLE "Failed_jobs" ADD FOREIGN KEY ("queue") REFERENCES "Failed_jobs" ("id");

ALTER TABLE "Model_has_roles" ADD FOREIGN KEY ("model_id") REFERENCES "Model_has_permissions" ("model_id");

ALTER TABLE "Empleo" ADD FOREIGN KEY ("nombre") REFERENCES "Empleo" ("edad");
